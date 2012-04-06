<?php namespace admin;

class Site
{
	private static $registeredModels = array();

	public static function getModels()
	{
		return self::$registeredModels;
	}

	public static function getAppModels($app)
	{
		$out = array();
		foreach (self::$registeredModels as $model)
		{
			if ($model['path'] == $app) $out[] = $model;
		}

		return $out;
	}

	public static function register($classPath)
	{
		$elems = explode("\\", $classPath);
		$class = end($elems);
		array_pop($elems);
		$path = implode("\\", $elems);
		self::$registeredModels[] = array(
			"fullpath" => $classPath,
			"class" => $class,
			"path" => $path
		);
	}
}