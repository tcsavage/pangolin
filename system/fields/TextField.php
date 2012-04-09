<?php namespace pangolin;

class TextField extends Field
{
	private $maxlength = 200;
	
	public function __construct($options, $value)
	{
		parent::__construct($options, $value);
		if (isset($options["maxlength"])) $this->maxlength = $options["maxlength"];
	}
	
	public function setValue($value)
	{
		if (strlen($value) > $this->maxlength)
		{
			return;
		}
		parent::setValue($value);
	}

	public function renderInput($attributes = null)
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
		return $out;
	}

	public function SQLType()
	{
		return "VARCHAR";
	}

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
