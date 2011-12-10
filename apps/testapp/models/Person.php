<?php namespace testapp;

class Person extends \pangolin\Model
{
	public $name = "";
	
	public function __construct($name)
	{
		parent::__construct();
		$this->name = $name;
	}
}