<?php namespace pangolin;

/*
Enumerated type field class.

Defines an enumerated type that you can select.
*/
class EnumField extends Field
{
	private $options = array();

	// Default constructor.
	public function __construct($options, $value)
	{

		// Set base attributes.
		parent::__construct($options, $value);

		// Set extended attributes.
		if (isset($options["options"])) $this->options = $options["options"];

		if (empty($this->options))
		{
			throw new \Exception("No options defined for ".get_class());
		}
	}
	
	// Validate input before setting it.
	// TODO: move validation out into seperate function.
	public function setValue($value)
	{
		if (array_key_exists($value, $this->options))
		{
			parent::setValue($value);
		}
	}

	// Renders HTML form control.
	public function renderInput($attributes = null)
	{
		$out = '<select id="'.$this->name.'" name="'.$this->name.'"';
		if ($attributes)
		{
			$attrstrings = array();
			foreach ($attributes as $key => $value)
			{
				$attrstrings[] = "$key=\"$value\"";
			}
			$out .= implode(" ", $attrstrings);
		}
		$out .= '>';
		foreach ($this->options as $id => $name)
		{
			$out .= '<option value="'.$id.'">'.$name.'</option>';
		}
		$out .= '</select>';
		return $out;
	}

	// Returns type for SQL representation.
	public function SQLType()
	{
		return "ENUM";
	}

	// Generates full SQL definition for defining a column.
	public function renderSQLDef()
	{
		$vals = array();
		foreach (array_keys($this->options) as $id)
		{
			$vals[] = "'$id'";
		}

		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType()."(".implode(", ", $vals).")";
		return implode(' ', $elems);
	}
}
