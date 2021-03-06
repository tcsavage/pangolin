<?php namespace pangolin;

/*
Boolean field class.

Defines a Boolean field stored as TINYINT rendered as a checkbox.
*/
class BoolField extends Field
{
	// Maximum length of text.
	private $maxlength = 1;
	
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
		parent::setValue($value != "0");
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<input type="checkbox" id="'.$this->name.'" name="'.$this->name.'"';

		if ($this->getValue())
		{
			$out .= ' checked="checked"';
		}

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
		return "TINYINT";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType() . '(' . $this->maxlength . ')';
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		if ($this->autoincrement) $elems[] = 'AUTO_INCREMENT';
		if ($this->primarykey) $elems[] = ', PRIMARY KEY(' . $this->name . ')';
		return implode(' ', $elems);
	}
}
