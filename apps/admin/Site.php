<?php namespace admin;

class Site
{
	private static $registeredModels = array();

	public static function register($class)
	{
		self::$registeredModels[] = $class;
	}
}