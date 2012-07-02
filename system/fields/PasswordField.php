<?php namespace pangolin;

/*
Password field class.

Defines a text field that represents an email address.
*/
class PasswordField extends Field
{
	// Maximum length.
	private $maxlength = 32;
	
	// Default constructor.
	public function __construct($options, $value)
	{
		// Set base attributes.
		parent::__construct($options, $value);

		// Set extended attributes.
		if (isset($options["maxlength"])) $this->maxlength = $options["maxlength"];
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

	// Hash value before saving.
	public function processForDB($value)
	{
		return md5($value);
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<input type="password" id="'.$this->name.'" name="'.$this->name.'"';
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
		$elems[] = $this->SQLType() . '(32)';
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		return implode(' ', $elems);
	}
}
