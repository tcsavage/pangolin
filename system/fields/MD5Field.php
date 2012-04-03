<?php namespace pangolin;

class MD5Field extends TextField
{
	private $maxlength = 32;
	
	public function __construct()
	{
		parent::__construct(null, null);
		if (isset($options["maxlength"])) $this->maxlength = $options["maxlength"];
	}
}
