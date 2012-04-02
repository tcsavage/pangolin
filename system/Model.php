<?php namespace pangolin;

// Base class formodels.
abstract class Model
{
	// Stores all the model properties. Facilitates magic.
	private $properties = array();
	
	// Ros ID.
	public $id;
	
	// Constructor. Has magic properties.
	public function __construct()
	{
		// Grab all the variables defined in the class and loop over them.
		$properties = get_object_vars($this);
		foreach ($properties as $name => $value)
		{
			// We are only interested in the properties of child classes.
			if ($name != "properties")
			{
				// Add the property to the array.
				$this->properties[$name] = $value;
				
				// Unset it so we can use __get and __set.
				unset($this->$name);
			}
		}
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
	
	private static function tableName()
	{
		$classname = get_called_class();
		$nsarray = explode("\\", $classname);
		$tablename = end($nsarray);
		return strtolower($tablename);
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
		$results = $query->run();
		
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
		$tablename = self::tableName();
		$classname = get_called_class();
		$query = new SQLQuery($tablename);
		$query->where(array("id" => $id));
		$results = $query->run();
		if (!$results)
		{
			return False;
		}
		else
		{
			$model = new $classname();
			foreach ($results[0] as $field => $value)
			{
				$model->$field = $value;
			}
			return $model;
		}
	}
}