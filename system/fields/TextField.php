<?php namespace pangolin;

/*
Test field class.

Defines a text field that is either a TEXT or VARCHAR depending on max length.
*/
class TextField extends Field
{
	// Maximum length of text.
	private $maxlength = null;
	
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

	// Renders HTML form control.
	// TODO: render textarea for fields over a certain length.
	public function renderInput($attributes = null)
	{
		if ($this->maxlength)
		{
			$out = '<input type="text" id="'.$this->name.'" name="'.$this->name.'"';
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
		}
		else
		{
			$out = '<textarea id="'.$this->name.'" name="'.$this->name.'"';
			if ($attributes)
			{
				$attrstrings = array();
				foreach ($attributes as $key => $value)
				{
					$attrstrings[] = "$key=\"$value\"";
				}
				$out .= implode(" ", $attrstrings);
			}
			$out .= '></textarea>';
		}
		return $out;
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return ($this->maxlength) ? "VARCHAR" : "LONGTEXT";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType() . (($this->maxlength) ? ('(' . $this->maxlength . ')') : '');
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		if ($this->autoincrement) $elems[] = 'AUTO_INCREMENT';
		if ($this->primarykey) $elems[] = ', PRIMARY KEY(' . $this->name . ')';
		return implode(' ', $elems);
	}
}
