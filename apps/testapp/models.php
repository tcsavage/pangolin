<?php namespace testapp;

class Person extends \pangolin\Model
{
	public $name;
	public $age;
	public $email;
	//public $tidbits;
	
	public function __construct()
	{
		$this->name = new \pangolin\TextField(array("maxlength" => 150), null);
		$this->age = new \pangolin\NumericalField(array("min" => 0, "step" => 1), null);
		$this->email = new \pangolin\TextField(array("maxlength" => 200), null);
		//$this->tidbits = new \pangolin\TextArray(array("maxsize" => 10, "fields" => array("maxlength" => 150)), null);
		
		parent::__construct();
	}
}