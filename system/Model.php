<?php namespace pangolin;

// Base class formodels.
abstract class Model
{
	// Stores all the model properties. Facilitates magic.
	private $properties = array();
	
	// Row ID.
	public $id;
	
	// Constructor. Has magic properties.
	public function __construct()
	{
		$this->id = new \pangolin\NumericalField(array("autoincrement" => True, "primarykey" => True), null);

		// Grab all the variables defined in the class and loop over them.
		$properties = get_object_vars($this);
		foreach ($properties as $name => $value)
		{
			// We are only interested in the properties of child classes.
			if ($name != "properties" && $name != "id")
			{
				// Add the property to the array.
				$this->properties[$name] = $value;
				$this->properties[$name]->name = ($this->properties[$name]->prettyname) ? $this->properties[$name]->prettyname : $name;
				
				// Unset it so we can use __get and __set.
				unset($this->$name);
			}
		}

		// Add id to the beginning.
		array_unshift($this->properties, $this->id);
		$this->properties[0]->name = 'id';
		unset($this->id);
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

	public static function getColumnMetadata()
	{
		$classname = self::name();
		$dummy = new $classname;
		return $dummy->properties;
	}

	public function getColumns()
	{
		return array_keys($this->properties);
	}

	public static function getColumnsS()
	{
		$classname = self::name();
		$dummy = new $classname;
		return $dummy->getColumns();
	}

	public function getPrettyColumnNames()
	{
		$out = array();
		foreach ($this->properties as $key => $column)
		{
			$out[] = ($column->prettyname) ? $column->prettyname : $key;
		}
		return $out;
	}

	public static function getPrettyColumnNamesS()
	{
		$classname = self::name();
		$dummy = new $classname;
		return $dummy->getPrettyColumnNames();
	}

	public static function name()
	{
		return get_called_class();
	}
	
	private static function tableName()
	{
		$classname = get_called_class();
		$tablename = str_replace("\\", "_", $classname);
		return strtolower($tablename);
	}

	public static function buildSQLCreate()
	{
		global $db;
		$classname = get_called_class();
		$tempObj = new $classname();
		$tablename = self::tableName();
		$columns = array();
		foreach ($tempObj->properties as $property)
		{
			$columns[] = $property->renderSQLDef();
		}
		$query = new SQLQuery($db);
		$query = $query->createTable($tablename, $columns);

		return $query;
	}
	
	public static function getAll()
	{
		global $db;
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($db);
		$query = $query->selectAll()->from($tablename);
		$results = $query->fetchAll();
		
		$list = new ObjectList();
		
		foreach ($results as $row)
		{
			$model = new $classname();
			foreach ($row as $field => $value)
			{
				$model->$field = $value;
			}
			$list[] = $model;
		}
		
		return $list;
	}
	
	public static function getWhere($where)
	{
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($tablename);
		$query->where($where);
		$results = $query->fetchAll();
		
		$list = new ObjectList();
		
		foreach ($results as $row)
		{
			$model = new $classname();
			foreach ($row as $field => $value)
			{
				$model->$field = $value;
			}
			$list[] = $model;
		}
		
		return $list;
	}
	
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
			}
			return $model;
		}
	}
}