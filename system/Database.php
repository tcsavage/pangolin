<?php namespace pangolin;

class Database
{
	private $config;
	public $link;
	
	private static $links = array();
	
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	public function connect()
	{
		foreach ( $this->config as $key => $value ) { $$key = $value; } // Get all the config vars out of the array.
		try
		{
			$this->link = new \PDO("$engine:host=$host;dbname=$name", $user, $pass);
			self::$links[] = $this->link;
			$this->link->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
			die("Connection to database failed: " . $e->getMessage());
		}
	}
	
	public function disconnect()
	{
		$this->link = null;
	}
	
	public static function disconnectAll()
	{
		foreach(self::$links as $link)
		{
			$link = null;
		}
	}
}