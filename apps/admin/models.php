<?php namespace admin;

class User extends \pangolin\Model
{
	public $username;
	public $email;
	public $password;
	
	public function __construct()
	{
		$this->username = new \pangolin\TextField(array(
			"order" => 1,
			"maxlength" => 150,
			"prettyname" => "Username",
			"helptext" => "The username used to log onto the site."
		), null);

		$this->email = new \pangolin\TextField(array(
			"order" => 2,
			"maxlength" => 200,
			"prettyname" => "Email Address"
		), null);
		$this->password = new \pangolin\PasswordField();
		
		parent::__construct();
	}
}

class Config extends \pangolin\Model
{
	public $k;
	public $v;
	
	public function __construct()
	{
		$this->k = new \pangolin\TextField(array(
			"maxlength" => 150,
			"prettyname" => "Key",
			"order" => 1
		), null);
		$this->v = new \pangolin\TextField(array(
			"maxlength" => 200,
			"prettyname" => "Value",
			"order" => 2
		), null);
		
		parent::__construct();
	}
}
