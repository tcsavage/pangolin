<?php namespace pangolin;

class Router
{
	private $url = "";

	public function __construct($url, $routes)
	{
		$this->url = $url;
		$routes[$url]();
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
