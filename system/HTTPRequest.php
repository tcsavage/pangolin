<?php namespace pangolin;

class HTTPRequest
{
	private $requestMethod;
	private $requestVars = array();
	private $data;
	private $accept;
 	public function __construct()
	{
		$this->requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
		$this->accept = explode(",", $_SERVER['HTTP_ACCEPT']);
 		switch ($this->requestMethod)
		{
			case "post":
				$this->requestVars = $_POST;
				break;
 			case "get":
				$this->requestVars = $_GET;
				break;
 			case "put":
				parse_str(file_get_contents("php://input"), $putvars);
				$this->requestVars = $putvars;
				break;
		}
 		if (isset($this->requestVars["data"]))
		{
			$this->data = json_decode($requestVars["data"]);
		}
	}
	
	public function getMethod()
	{
		return $this->requestMethod;
	}

	public function getVars()
	{
		return $this->requestVars;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getFiles()
	{
		return $_FILES;
	}

	public function getHttpAccept()
	{
		return $this->accept;
	}
 }