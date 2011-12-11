<?php namespace testapp;

class Person extends \pangolin\Model
{
	public $name;
	public $age;
	public $email;
	
	public function __construct($name, $age, $email)
	{
		$this->name = new \pangolin\TextField(array("maxlength" => 150), $name);
		$this->age = new \pangolin\NumericalField(array("min" => 0, "step" => 1), $age);
		$this->email = new \pangolin\TextField(array("maxlength" => 200), $email);
		
		parent::__construct();
	}
}
