<?php namespace pangolin;

class NumericalField extends Field
{
	private $min = null;
	private $max = null;
	private $step = null;
	
	public function __construct($options, $value)
	{
		parent::__construct($options, $value);
		if (isset($options["min"])) $this->min = $options["min"];
		if (isset($options["max"])) $this->max = $options["max"];
		if (isset($options["step"])) $this->step = $options["step"];
	}
	
	public function setValue($value)
	{
		if (($this->min === null || $value >= $this->min) && ($this->max === null || $value <= $this->max))
		{
			parent::setValue($value);
		}
	}

	public function renderInput($attributes = null)
	{
		$out = '<input type="number" id="'.$this->name.'" name="'.$this->name.'"';
		if (isset($this->min)) $out .= ' min="'.$this->min.'"';
		if (isset($this->max)) $out .= ' max="'.$this->max.'"';
		if (isset($this->step)) $out .= ' step="'.$this->step.'"';
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
		return "INT";
	}

	public function renderSQLDef()
	{
		$elems = array();
		$elems[] = $this->name;
		$elems[] = $this->SQLType() . '(11)';
		$elems[] = ($this->nullable) ? 'DEFAULT NULL' : 'NOT NULL';
		if ($this->autoincrement) $elems[] = 'AUTO_INCREMENT';
		if ($this->primarykey) $elems[] = ', PRIMARY KEY(' . $this->name . ')';
		return implode(' ', $elems);
	}
}
