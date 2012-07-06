<?php namespace pangolin;

/*
Email field class.

Defines a text field that represents an email address.
*/
class EmailField extends Field
{
	// Maximum length of email address.
	private $maxlength = 256;
	
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
		if ($this->maxlength && strlen($value) > $this->maxlength)
		{
			return;
		}
		parent::setValue($value);
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<input type="email" id="'.$this->name.'" name="'.$this->name.'"';
		
		if ($this->getValue())
		{
			$out .= ' value="'.$this->getValue().'"';
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
		return "VARCHAR";
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
