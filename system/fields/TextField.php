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
}
