<?php namespace pangolin;

class Router
{
	private static $url = "";
	private static $segments;
	private static $subdomains;
	private static $actionvars = array();
	
	public static function route($routes, $patternPrefix = null, $appName = null)
	{
		debugMsg("Starting router...");
		debugMsg("URL: $url");
		debugMsg("Routes: $routes");
		debugMsg("Pattern Prefix: $patternPrefix");
		debugMsg("App name: $appName");

		// Test route segment.
		if (self::$url == "" || self::$url == $patternPrefix)
		{
			Template::addTemplateDir(ROOT . "/apps/$appName/templates");
			if ($appName)
			{
				$action = "\\$appName\\".$routes[""];
				$action();
			}
			else
			{
				$routes[""]();
			}
			return;
		}
		
		// For each route pattern...
		foreach ($routes as $pattern => $action)
		{
			if ($patternPrefix) { $pattern = $patternPrefix . "/" . $pattern; }
			if ($appName) { $action = $appName . "\\" . $action ; }
			debugMsg("Pattern: $pattern, Action: $action");
			// Grab pattern segments.
			$patternsegments = explode("/", $pattern);
			if (!$patternsegments[0]) { $patternsegments = array_shift($patternsegments); }

			if (count($patternsegments) > count(self::$segments))
			{
				debugMsg("Pattern segments longer than URL");
			}
			else
			{
				debugMsg("Pattern segments: " . print_r($patternsegments, True));
				
				$regex = "";
				
				// For each segment...
				foreach ($patternsegments as $i => $seg)
				{
					debugMsg("Pattern segment $i: $seg");

					// See if it's a variable.
					if (preg_match("~^\{.*\}$~", $seg))
					{
						debugMsg("Pattern segment $seg looks like a variable");
						$varname = substr($seg, 1, strlen($seg)-2);
						self::$actionvars[$varname] = self::$segments[$i];
						$seg = ".*";
					}
					$regex .= "/" . $seg;
				}
				$regex = substr($regex, 1);
				debugMsg("Regex: $regex");
				if (preg_match("~^" . $regex . "$~", self::$url) || is_array($action))
				{
					if (is_array($action))
					{
						debugMsg("Using sub routes ($pattern)...\n");
						$r = new Router($url, $action, $pattern, $patternsegments[0]); // Replace this with a better way...
					}
					else
					{
						$appAction = explode("\\", $action);
						debugMsg("Matched");
						debugMsg("App action: " . print_r($appAction, True));
						Template::addTemplateDir(ROOT . "/apps/$appAction[0]/templates");
						$action(self::$actionvars);
					}
					return;
				}
				else
				{
					debugMsg("Regex failed");
				}
			}
		}
		debugMsg("No match");
	}

	public static function setup($url)
	{
		// Grab subdomain.
		$parsedUrl = parse_url($_SERVER['HTTP_HOST']);
		if (isset($parsedUrl['host']))
		{
			$d = explode('.', $parsedUrl['host']);
			self::$subdomains = array_slice($d, 0, count($d) - 2 );
		}
		else
		{
			self::$subdomains = null;
		}

		debugMsg("Subdomain: " . print_r(self::$segments, True));
		
		// Tidy url and grab segments as array.
		self::$url = rtrim($url,"/");
		self::$segments = explode("/", self::$url);

		debugMsg("URL: self::$url");
		debugMsg("Segments: " . print_r(self::$segments, True));
	}
	
	public static function getUrl()
	{
		return self::$url;
	}
	
	public static function getUrlElms()
	{
		return self::$segments;
	}
}
