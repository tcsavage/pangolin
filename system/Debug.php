<?php namespace pangolin;

class Debug
{
	private static $queries;

	public static function logQuery($query)
	{
		$backtrace = debug_backtrace();
		array_shift($backtrace);
		self::$queries[] = array("query" => $query, "backtrace" => $backtrace);
	}

	public static function getQueries()
	{
		return self::$queries;
	}
}