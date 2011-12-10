<?php namespace testapp;

class Person extends \pangolin\Model
{
	public $name;
	public $age;
	public $email;
	
	public function __construct($name, $age, $email)
	{
		$this->name = new \pangolin\TextField(array("maxlength" => 15), $name);
		$this->age = $age;
		$this->email = $email;
		
		parent::__construct();
	}
}