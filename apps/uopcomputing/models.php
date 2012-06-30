<?php namespace uopcomputing;

class User extends \pangolin\Model
{
	public $name;
	public $email;
	public $password;
	//public $karma;

	public function __construct()
	{
		$this->name = new \pangolin\TextField(array(
			"maxlength" => 150,
			"order" => 1,
			"prettyname" => "Full name"), null);
		$this->email = new \pangolin\TextField(array(
			"maxlength" => 200,
			"order" => 2,
			"prettyname" => "Email address"), null);
		$this->password = new \pangolin\TextField(array(
			"maxlength" => 200,
			"order" => 3,
			"prettyname" => "Password hash"), null);

		parent::__construct();
	}
}