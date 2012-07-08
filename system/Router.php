<?php namespace pangolin;

class Router
{
	private static $url;
	private static $segments;
	private static $subdomains;
	private static $actionvars = array();

	/**
	 * Sets up the router with URL data.
	 * Keeping this seperate allows for functionality to happen between setup and actual routing.
	 */
	public static function setup(string $url)
	{
		debugMsg("Setting up router...");

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

		debugMsg("URL segments: ".print_r(self::$segments, true));
	}

	/**
	 * Tries to work out what function to call given the request URL.
	 * Returns a function reference or throws an exception.
	 */
	public static function route(array $routes, $unconsumed = null)
	{
		if (self::$url === null)
		{
			throw new \Exception("Router not ready");
		}

		if ($unconsumed === null)
		{
			$unconsumed = self::$segments;
		}
		
		debugMsg("Routing on: ".print_r($unconsumed, true));
		debugMsg("Routing with: ".print_r($routes, true));

		if (count($unconsumed) == 0 || $unconsumed[0] == "")
		{
			debugMsg("Nothing to consume");
			if (is_array($routes[""]))
			{
				return self::route($routes[""], $unconsumed);
			}
			else
			{
				return self::handle($routes[""]);
			}
		}
		else
		{
			debugMsg("Testing routes");
			foreach ($routes as $pattern => $action)
			{
				$vars = self::testPattern($pattern, $action, $unconsumed);

				if ($vars != false && !is_array($action))
				{
					return self::handle($action, $vars);
				}
				elseif ($vars == "handled")
				{
					return "handled";
				}
			}

			if (is_array($routes['']))
			{
				return self::route($routes[''], $unconsumed);
			}

			throw new \Exception("No matching route pattern");
		}
	}

	/**
	 * Tests a route pettern to see if it matches the URL.
	 * Returns an array of vars on match. False if no match.
	 */
	public static function testPattern(string $pattern, $action, array $urlsegments)
	{
		debugMsg("Testing pattern: ".$pattern);
		debugMsg("Action: ".$action);

		// Regular expression to match variable segments. Subpattern 1 is the name of the variable.
		$varregex = "~^\{(.*)\}$~";

		// Array of variables.
		$vars = array();

		// Get an array of pattern segments. We will look at each segment individually.
		$patternsegments = explode("/", $pattern);
		debugMsg("Pattern segments: ".print_r($patternsegments, true));

		// If action is an array and the length of the pattern and url arrays don't match, we can return right now.
		if (!is_array($action) && count($patternsegments) != count($urlsegments))
		{
			debugMsg("Non-array action with non-matching pattern and url segment counts");
			return false;
		}

		// For each pattern segment...
		foreach ($patternsegments as $k => $ps)
		{
			$matches = null;

			// Compare it to the analogous URL segment.
			if ($ps == $urlsegments[$k])
			{
				// If it matches, we can move onto the next one.
				continue;
			} // Otherwise we'll see if it looks like a variable placeholder.
			elseif (preg_match($varregex, $ps, $matches))
			{
				// It matches so we'll create a key with the variables name in the $vars array, and set its value to whatever is in the URL at this point.
				$vars[$matches[1]] = $urlsegments[$k];
			} // Nothing matches so we can give up and move on.
			else
			{
				debugMsg("Non-matching pattern segment");
				return false;
			}
		}

		debugMsg("Pattern matches");

		// We're done processing the pattern. At this point, there may still be unconsumed URL segments.
		// If $action is an array we can pass it and the unconsumed URL segments to route() again.
		// Otherwise there isn't a pattern matching this URL and we can return false.

		if (is_array($action))
		{
			debugMsg("Checking for subroutes in array");
			return self::route($action, array_slice($urlsegments, count($patternsegments)));
		}
		else if (count($patternsegments) == count($urlsegments))
		{
			return $vars;
		}
		else
		{
			return false;
		}
	}

	/**
	 * Handles the actual routing to views.
	 */
	public static function handle(string $view, array $args = array())
	{
		debugMsg("Handling view: ".$view);
		debugMsg("Args: ".print_r($args, true));

		$vcomps = explode("\\", ltrim($view, "\\"));
		$function = array_pop($vcomps);
		$folder = implode("/", $vcomps);
		Template::addTemplateDir(ROOT . "/apps/$folder/templates");
		$view(new HTTPRequest(), $args);
		return "handled";
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
