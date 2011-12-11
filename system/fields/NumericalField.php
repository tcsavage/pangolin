<?php namespace pangolin;

class NumericalField extends Field
{
	private $min = null;
	private $max = null;
	private $step = 0;
	
	public function __construct($options, $value)
	{
		parent::__construct($options, $value);
		if (isset($options["min"])) $this->min = $options["min"];
		if (isset($options["max"])) $this->max = $options["max"];
		if (isset($options["step"])) $this->step = $options["step"];
	}
	
	public function setValue($value)
	{
		if (($this->min != null || $this->max != null) && $value >= $this->min && $value <= $this->max)
		{
			parent::setValue($value);
		}
	}
}
