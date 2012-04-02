<?php namespace pangolin;

abstract class Field
{
	private $primarykey = False;
	private $foreignkey = null;
	private $nullable = True;
	private $autoincrement = False;
	
	private $name = null;
	private $value = null;
	
	public function __construct($options, $value)
	{
		if (isset($options["primarykey"])) $this->primarykey = $options["primarykey"];
		if (isset($options["foreignkey"])) $this->foreign = $options["foreignkey"];
		if (isset($options["nullable"])) $this->nullable = $options["nullable"];
		if (isset($options["autoincrement"])) $this->autoincrement = $options["autoincrement"];
		
		$this->value = $value;
	}
	
	public function getValue()
	{
		return $this->value;
	}
	
	public function setValue($value)
	{
		$this->value = $value;
	}

	public function renderInput()
	{
		return "";
	}

	public function SQLType()
	{
		return "";
	}

	public function renderSQLDef()
	{
		return "";
	}
}