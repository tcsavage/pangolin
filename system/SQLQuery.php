<?php namespace pangolin;

class SQLQuery
{
	public $base = "";
	public $where = "";
	
	public function __construct($table)
	{
		$this->base = "SELECT * FROM " . $table;
	}
	
	public function run()
	{
		$res = mysql_query($this->base);
		if (!$res)
		{
			echo "Could not successfully run query ($sql) from DB: " . mysql_error();
		}
		else
		{
			$results = array();
			
			while ($row = mysql_fetch_assoc($res))
			{
				$results[] = $row;
			}
			
			return $results;
		}
	}
}