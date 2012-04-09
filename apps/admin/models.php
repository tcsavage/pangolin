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
		$this->password = new \pangolin\MD5Field();
		
		parent::__construct();
	}
}

class Config extends \pangolin\Model
{
	public $key;
	public $value;
	
	public function __construct()
	{
		$this->key = new \pangolin\TextField(array("maxlength" => 150), null);
		$this->value = new \pangolin\TextField(array("maxlength" => 200), null);
		
		parent::__construct();
	}
}