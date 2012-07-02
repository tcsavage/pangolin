<?php namespace pangolin;

/*
Field base class.

Defined the basis for all types of which models are comprised.
Fields are essentially wrappers around values that provide extra information for: generating SQL statements, building HTML displays and forms, and validating input.
*/
abstract class Field
{
	// Defines the order in which fields are displayed in tables and forms
	public $order = -1;

	// True if field is prirary key (probably only used for automatic id field).
	public $primarykey = False;

	// True if value can be null.
	public $nullable = True;

	// True if field auto-increments (probably only used for automatic id field and when using only one database server).
	public $autoincrement = False;
	
	// The name of the field's variable. Used to name HTML elements, SQL columns etc.
	public $name = null;

	// Human readable name used when rendering tables, form controls, etc.
	public $prettyname = null;

	// Human readable text displayed next to form elements to guide users.
	public $helptext = null;

	// The actual value of the field.
	private $value = null;
	
	// Default constructor. Sets properties from provided array.
	public function __construct($options, $value)
	{
		if (isset($options["order"])) $this->order = $options["order"];
		if (isset($options["primarykey"])) $this->primarykey = $options["primarykey"];
		if (isset($options["nullable"])) $this->nullable = $options["nullable"];
		if (isset($options["autoincrement"])) $this->autoincrement = $options["autoincrement"];
		if (isset($options["prettyname"])) $this->prettyname = $options["prettyname"];
		if (isset($options["helptext"])) $this->helptext = $options["helptext"];
		
		$this->value = $value;
	}
	
	// Returns value.
	public function getValue()
	{
		return $this->value;
	}
	
	// Sets value.
	public function setValue($value)
	{
		$this->value = $value;
	}

	// Validate input.
	public function validate($value)
	{
		return true;
	}

	// Process data before saving to database.
	public function processForDB($value)
	{
		return $value;
	}

	// Process data from database.
	public function processFromDB($value)
	{
		return $value;
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		return "";
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return "";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		return "";
	}
}