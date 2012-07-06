<?php namespace pangolin;

/** Facilitates reading of metadata from classes. Extended from http://interfacelab.com/metadataattributes-in-php/ */
class AttributeReader
{
	public static function classAttributes($name)
	{
		$regex = "~^\[(.+)\h*:\h*(.+)\]$~";
		$ref = new \ReflectionClass($name);
		$comment = $ref->getDocComment();
		$lines = map(explode("\n", $comment), $f = function($s) { return substr($s, 3); });
		$attributes = array();
		foreach ($lines as $line)
		{
			$matches = null;
			$ret = preg_match($regex, $line, $matches);
			if ($ret) { $attributes[$matches[1]] = $matches[2]; }
		}
		die(var_dump($attributes));
	}
}
