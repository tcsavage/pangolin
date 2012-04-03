<?php namespace pangolin;

// SQL query builder class.
// Each method returns the object so you can build querys thus: $query = new SQLQuery($db); $query->selectAll()->from("people").
class SQLQuery
{
	private $database = null;
	private $table = null;
	private $type = null;
	private $columns = array();
	private $where = null;
	
	public function __construct($database)
	{
		if ($database)
		{
			$this->database = $database;
		}
		else
		{
			throw new \Exception('No database given.');
		}
	}

	public function from($table)
	{
		$this->table = $table;

		return $this;
	}

	public function createTable($table, $columns)
	{
		$this->type = "CREATE TABLE";
		$this->table = $table;
		$this->columns = $columns;

		return $this;
	}

	public function selectAll()
	{
		$this->type = "SELECT";
		$this->columns[] = "*";

		return $this;
	}

	public function select($columns)
	{
		$this->type = "SELECT";
		$this->columns = array_merge($this->columns, $columns);

		return $this;
	}

	public function where($columnorarray, $value = null)
	{
		// Initialize where array.
		if (!$this->where)
		{
			$this->where = array();
		}

		// Handle arrays.
		if (is_array($columnorarray))
		{
			if (!is_array($columnorarray[0]))
			{
				throw new Exception('Invalid parameter.');
			}
			else
			{
				$this->where[] = "$columnorarray[0] = $columnorarray[1]";
			}
		}
		else
		{
			$this->where[] = "$columnorarray = $value";
		}

		return $this;
	}
	
	public function build()
	{
		$query = "";

		$columns = implode(", ", $this->columns);

		switch($this->type)
		{
			case "SELECT":
				$query .= "SELECT $columns FROM $this->table";
				if ($this->where)
				{
					$query .= " WHERE " . implode(" AND ", $this->where);

				}
				break;
			case "CREATE TABLE":
				$query .= "CREATE TABLE $this->table (";
				$query .= implode(", ", $this->columns);
				$query .= ")";
				break;
			default:
				throw new \Exception("Invalid query type ($this->type).");
				break;
		}

		return $query;
	}

	public function fetchAll()
	{
		try
		{
			$statement = $this->database->link->prepare($this->build());
			$statement->execute();
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
		}
		catch(\PDOException $e)
		{
			die("Database query failed: " . $e->getMessage());
		}
		
		return $statement->fetchAll();
	}
}