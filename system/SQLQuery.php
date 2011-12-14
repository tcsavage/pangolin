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
		$query = $this->base;
		if ($this->where != "")
		{
			$query .= " WHERE" . $this->where;
		}
		
		$res = mysql_query($query);
		if (!$res)
		{
			echo "Could not successfully run query ($query) from DB: " . mysql_error();
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
	
	public function where($array)
	{
		foreach ($array as $field => $value)
		{
			$this->where .= " " . $field . " = " . (is_string($value) ? "'" . $value . "'" : $value);
		}
	}
}