<?php namespace pangolin;

class Router
{
	private $url = "";
	private $segments;
	private $subdomain;
	private $actionvars = array();
	
	public function __construct($url, $routes)
	{
		// Grab subdomain.
		$d = explode('.', $_SERVER['HTTP_HOST']);
		$this->subdomain = $d[0];
		
		// Tidy url and grab segments as array.
		$this->url = rtrim($url,"/");
		$this->segments = explode("/", $this->url);
		
		if ($this->url == "")
		{
			$routes[""]();
			return;
		}
		
		// For each route pattern...
		foreach ($routes as $pattern => $action)
		{
			// Grab pattern segments.
			$patternsegments = explode("/", $pattern);
			
			$regex = "";
			
			// For each segment...
			foreach ($patternsegments as $i => $seg)
			{
				if (count($this->segments) < $i)
				{
					echo("Break");
					break;
				}

				if ($seg != $this->segments[$i])
				{
					break;
				}

				// See if it's a variable.
				if (preg_match("~^\{.*\}$~", $seg))
				{
					$varname = substr($seg, 1, strlen($seg)-2);
					$this->actionvars[$varname] = $this->segments[$i];
					$seg = ".*";
				}
				$regex .= "/" . $seg;
			}
			$regex = substr($regex, 1);
			if (preg_match("~^" . $regex . "$~", $this->url))
			{
				$appAction = explode("\\", $action);
				Template::addTemplateDir(ROOT . "/$appAction[1]/templates");
				$action($this->actionvars);
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
		return $this->segments;
	}
}
