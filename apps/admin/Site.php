<?php namespace admin;

class Site
{
	private static $registeredModels = array();

	public static function getModels()
	{
		if (!self::$registeredModels)
		{
			$classes = array();
			foreach (get_declared_classes() as $className)
			{
				if (is_subclass_of($className, "\\pangolin\\Model"))
				{
					$classes[] = $className;
					self::register($className);
				}
			}
		}
		return self::$registeredModels;
	}

	public static function getAppModels($app)
	{
		// Make sure modeldb is up to date.
		if (!self::$registeredModels) self::getModels();

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