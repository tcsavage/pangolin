<?php namespace pangolin;

class Debug
{
	private static $queries;

	public static function logQuery($query)
	{
		self::$queries[] = $query;
	}

	public static function getQueries()
	{
		return self::$queries;
	}
}