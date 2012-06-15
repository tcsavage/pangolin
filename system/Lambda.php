<?php namespace pangolin;

require_once("functional.php");

class Lambda
{
	private $anonymous;
	
	public function __construct($f)
	{
		$this->anonymous = $f;
	}
	
	public function __invoke()
	{
		$x = func_get_args();
		return call_user_func_array($this->anonymous, $x);
	}
}