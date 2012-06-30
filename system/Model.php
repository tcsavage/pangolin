<?php namespace pangolin;

function property_comparison_function($a, $b)
{
	if ($b->order == -1) { return -1; }
	if ($a->order == $b->order)
	{
		return 0;
	}
	return ($a->order < $b->order) ? -1 : 1;
}

/*
Base class for models.
*/
abstract class Model
{
	// Stores all the model properties. Facilitates magic.
	private $properties = array();
	
	// Row ID.
	public $id;
	
	// Constructor. Has magic properties.
	public function __construct()
	{
		$this->id = new \pangolin\NumericalField(array("autoincrement" => True, "primarykey" => True, "order" => 0), null);

		// Grab all the variables defined in the class and loop over them.
		$properties = get_object_vars($this);
		unset($properties['properties']);
		uasort($properties, '\pangolin\property_comparison_function');
		foreach ($properties as $name => $value)
		{
			// We are only interested in the properties of child classes.
			if ($name != "properties")
			{
				// Add the property to the array.
				$this->properties[$name] = $value;
				$this->properties[$name]->name = $name;
				if (!$this->properties[$name]->prettyname) $this->properties[$name]->prettyname = $name;
				//$this->properties[$name]->name = ($this->properties[$name]->prettyname) ? $this->properties[$name]->prettyname : $name;
				
				// Unset it so we can use __get and __set.
				unset($this->$name);
			}
		}
		//echo(var_dump($this));
	}

	public function __toString()
	{
		return "Model : ".self::name()." : ".$this->id;
	}
	
	// Grabs properties.
	public function __set($name, $value)
	{
		if ($this->properties[$name] instanceof Field)
		{
			$this->properties[$name]->setValue($value);
		}
		else
		{
			$this->properties[$name] = $value;
		}
	}
	
	// Sets properties.
	public function __get($name)
	{
		if (array_key_exists($name, $this->properties))
		{
			if ($this->properties[$name] instanceof Field)
			{
				return $this->properties[$name]->getValue();
			}
			else
			{
				return $this->properties[$name];
			}
		}
		
		$trace = debug_backtrace();
		trigger_error(
			'Undefined property via __get():	' . $name .
			' in ' . $trace[0]['file'] .
			' on line ' . $trace[0]['line'],
			E_USER_NOTICE);
		return null;
	}

	// Get field properties.
	public static function getColumnMetadata($onlyvisible = false)
	{
		$classname = self::name();
		$dummy = new $classname;
		return ($onlyvisible) ? filter($dummy->properties, $checkfun = function($col) { return is_subclass_of($col, "\\pangolin\\Field"); }) : $dummy->properties;
	}

	// Get invisible fields.
	public static function getInvisibleColumns()
	{
		$classname = self::name();
		$dummy = new $classname;
		return (filter($dummy->properties, $f = function($col) { return get_class($col) == "pangolin\\ForeignArray"; }));
	}

	// Get column names.
	public function getColumns()
	{
		return array_keys($this->properties);
	}

	// Static get columns.
	public static function getColumnsS()
	{
		$classname = self::name();
		$dummy = new $classname;
		return $dummy->getColumns();
	}

	// Get pretty column names.
	public function getPrettyColumnNames()
	{
		$out = array();
		foreach ($this->properties as $key => $column)
		{
			$out[] = ($column->prettyname) ? $column->prettyname : $key;
		}
		return $out;
	}

	// Static get pretty column names.
	public static function getPrettyColumnNamesS()
	{
		$classname = self::name();
		$dummy = new $classname;
		return $dummy->getPrettyColumnNames();
	}

	// Get name of the model.
	public static function name()
	{
		return get_called_class();
	}
	
	// Get the model's table name.
	private static function tableName()
	{
		$classname = get_called_class();
		$tablename = str_replace("\\", "_", $classname);
		return strtolower($tablename);
	}

	// Save as new in database.
	public function create()
	{
		global $db;
		$tablename = self::tableName();
		$query = new SQLQuery($db);
		$query = $query->insert($tablename);
		foreach ($this->properties as $key => $value)
		{
			if ($key != "id" && is_subclass_of($value, "\\pangolin\\Field"))
				$query->value($key, $value->getValue());
		}
		$query->run();
	}

	// Build a SQL statement for creating the model's table.
	public static function buildSQLCreate()
	{
		global $db;
		$classname = get_called_class();
		$tempObj = new $classname();
		$tablename = self::tableName();
		$columns = array();
		foreach ($tempObj->properties as $property)
		{
			if (is_subclass_of($property, "\\pangolin\\Field")) $columns[] = $property->renderSQLDef();
		}
		$query = new SQLQuery($db);
		$query = $query->createTable($tablename, $columns);

		return $query;
	}
	
	// Get all fields from the database.
	public static function getAll($except = null)
	{
		global $db;
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($db);
		$query = $query->selectAll()->from($tablename);
		$query->run();
		$results = $query->fetchAll();
		
		$list = new ObjectList();
		
		foreach ($results as $row)
		{
			$model = new $classname();
			foreach ($row as $field => $value)
			{
				$model->$field = $value;
				// If the field is a foreign key, replace the value with the object it points to.
				if (get_class($model->properties[$field]) == get_class(new ForeignField()))
				{
					if (in_array($field, $except))
					{
						$model->$field = null;
					}
					else
					{
						$foreignModel = $model->properties[$field]->getModel();
						$model->$field = $foreignModel::getId($model->$field);
					}
				}
			}

			// For foreign array fields.
			$invisible = $model::getInvisibleColumns();
			foreach ($invisible as $name => $column)
			{
				$m = $column->getModel();
				$elems = $m::getWhere(array($column->getField() => $model->id));
				$model->$name = $elems;
			}

			//die(print_r($model, true));
			$list[] = $model;
		}
		
		return $list;
	}

	// Count all fields in the database.
	public static function countAll()
	{
		global $db;
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($db);
		$query = $query->countAll()->from($tablename);
		$query->run();
		$results = $query->fetchAll();
		return intval($results[0]['COUNT(*)']);
	}
	
	// Get all fields conditionally.
	public static function getWhere($where)
	{
		global $db;
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($db);
		$query = $query->selectAll()->from($tablename);
		$query->where($where);
		$results = $query->fetchAll();
		if (!$results)
		{
			return False;
		}
		else
		{
			$list = new ObjectList();
			foreach ($results as $result)
			{
				$model = new $classname();
				foreach ($result as $field => $value)
				{
					$model->$field = $value;
					// If the field is a foreign key, replace the value with the object it points to.
					if (get_class($model->properties[$field]) == get_class(new ForeignField()))
					{
						$foreignModel = $model->properties[$field]->getModel();
						$model->$field = $foreignModel::getId($model->$field);
					}
				}
			}
			$list[] = $model;
			return $list;
		}
	}
	
	// Get field with specified id.
	public static function getId($id)
	{
		global $db;
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($db);
		$query = $query->selectAll()->from($tablename)->where("id", $id);
		$result = $query->fetch();
		if (!$result)
		{
			return False;
		}
		else
		{
			$model = new $classname();
			foreach ($result as $field => $value)
			{
				$model->$field = $value;
				// If the field is a foreign key, replace the value with the object it points to.
				if (get_class($model->properties[$field]) == get_class(new ForeignField()))
				{
					$foreignModel = $model->properties[$field]->getModel();
					$model->$field = $foreignModel::getId($model->$field);
				}
			}
			return $model;
		}
	}
}