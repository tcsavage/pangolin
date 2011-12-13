<?php namespace pangolin;

class Router
{
	private $url = "";
	
	public function __construct($url, $routes)
	{
		$this->url = rtrim($url,"/");
		foreach ($routes as $pattern => $action)
		{
			$regex = $pattern;
			if (preg_match("~" . $regex . "~", $this->url))
			{
				$action();
				return;
			}
		}
		echo("No match");
	}
	
	public function getUrl()
	{
		return $this->url;
	}
	
	public function getUrlElms()
	{
		return explode("/", $this->url);
	}
}
