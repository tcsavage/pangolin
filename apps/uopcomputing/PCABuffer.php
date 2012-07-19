<?php namespace uopcomputing;

/**
 * A persistent circular buffer for storing recent activity between requests.
 * @package uopcomputing
 */
class PCABuffer
{
	static private $key = "uoppcabuffer";
	static private $size = 4;

	static public function get()
	{
		$val = \apc_fetch(self::$key, $sf);

		if (!$val || !$sf)
		{
			return false;
		}
		else
		{
			return $val;
		}
	}

	static public function push($value)
	{
		$current = self::get();
		if ($current === false)
		{
			$array = array($value);
			\apc_store(self::$key, $array);
		}
		else
		{
			array_unshift($current, $value);
			if (count($current) >= self::$size)
			{
				array_pop($current);
			}
			\apc_store(self::$key, $current);
		}
	}

	static public function delete()
	{
		\apc_delete(self::$key);
	}
}