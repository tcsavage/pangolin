<?php namespace pangolin;

/*
Date field field class.

Defines a date field - should be handled natively or with shim.
*/
class DateField extends Field
{	
	// Default constructor.
	public function __construct($options, $value)
	{
		// Set base attributes.
		parent::__construct($options, $value);
	}
	
	// Validate input before setting it.
	// TODO: move validation out into seperate function.
	public function setValue($value)
	{
		parent::setValue($value);
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<input type="date" id="'.$this->name.'" name="'.$this->name.'"';
		if ($attributes)
		{
			$attrstrings = array();
			foreach ($attributes as $key => $value)
			{
				$attrstrings[] = "$key=\"$value\"";
			}
			$out .= implode(" ", $attrstrings);
		}
		$out .= '/>';
		return $out;
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return "DATE";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType();
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		return implode(' ', $elems);
	}
}
