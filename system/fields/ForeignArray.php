<?php namespace pangolin;

/*
Field that represents an array of instances of other models.
Not actually represented in the database.
*/
class ForeignArray
{
	private $model = "";
	private $field = "";
	public $value = null;
	
	public function __construct($options, $value = null)
	{
		if (isset($options["model"])) $this->model = $options["model"];
		else throw new \Exception("Expected model ref");
		if (isset($options["field"])) $this->field = $options["field"];
		else throw new \Exception("Expected field ref");

		$this->value = $value;
	}

	// Return the foreign model class name.
	public function getModel()
	{
		return $this->model;
	}

	// Return the foreign field name.
	public function getField()
	{
		return $this->field;
	}
}