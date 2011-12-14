<?php namespace pangolin;

class Database
{
	private $config;
	private $link;
	
	private static $links = array();
	
	public function __construct($config)
	{
		$this->config = $config;
	}
	
	public function connect()
	{
		$this->link = mysql_connect($this->config["host"], $this->config["user"], $this->config["pass"]);
		self::$links[] = $this->link;
		if (!$this->link)
		{
			die('Could not connect: ' . mysql_error());
		}
		mysql_select_db($this->config["name"]);
	}
	
	public function disconnect()
	{
		mysql_close($this->link);
		foreach(self::$links as $key => $value)
		{
			if ($value == $this->link) unset(self::$links[$key]);
		}
	}
	
	public static function disconnectAll()
	{
		foreach(self::$links as $link)
		{
			mysql_close($link);
		}
	}
}