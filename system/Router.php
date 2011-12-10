<?php namespace pangolin;

class Router
{
	private $url = "";

	public function __construct($url)
	{
		$this->url = $url;
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