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

	public function countAll()
	{
		$this->type = "SELECT";
		$this->columns[] = "COUNT(*)";

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
			foreach ($columnorarray as $column => $value)
			{
				$this->where[] = "$column = $value";
			}
		}
		else
		{
			$this->where[] = "$columnorarray = $value";
		}

		return $this;
	}

	public function insert($table)
	{
		$this->type = "INSERT INTO";
		$this->table = $table;

		return $this;
	}

	public function value($field, $value)
	{
		$this->columns[$field] = $value;
		return $this;
	}

	public function values($values)
	{
		$this->columns = array_merge($this->columns, $values);
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
			case "INSERT INTO":
				$fields = implode(", ", array_keys($this->columns));
				$values = implode(", ", map(array_values($this->columns), $f = function($x) { return "'".$x."'"; }));
				$query .= "INSERT INTO $this->table ($fields) VALUES ($values)";
				break;
			default:
				throw new \Exception("Invalid query type ($this->type).");
				break;
		}
		
		Debug::logQuery($query);
		
		return $query;
	}

	public function run()
	{
		$statement = $this->database->link->prepare($this->build());
		$statement->execute();
		$statement->setFetchMode(\PDO::FETCH_ASSOC);

		return $statement;
	}

	public function insertId()
	{
		return $this->database->lastInsertId();
	}

	public function fetchAll()
	{
		return $this->run()->fetchAll();
	}

	public function fetch()
	{
		return $this->run()->fetch();
	}
}