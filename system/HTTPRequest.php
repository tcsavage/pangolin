<?php namespace pangolin;

/**
 * Represents everything you should need to know about a request.
 * @package pangolin
 */
class HTTPRequest
{
	/** The HTTP verb of the request. */
	private $requestMethod;

	/** Array of request variables (POST, GET and PUT only). */
	private $requestVars = array();

	/** Parsed JSON data in data request var. */
	private $data;

	/** Accepted response types. */
	private $accept;

	/** True if ajax request. */
	private $ajax;

	/**
	 * Constructor.
	 * @return HTTPRequest
	 */
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

		$this->ajax = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
	}
	
	/**
	 * Get HTTP verb.
	 * @return string
	 */
	public function getMethod()
	{
		return $this->requestMethod;
	}

	/**
	 * Array of request variables (POST, GET and PUT only).
	 * @return array
	 */
	public function getVars()
	{
		return $this->requestVars;
	}

	/**
	 * Parsed JSON data in data request var.
	 * @return array/object
	 */
	public function getData()
	{
		return $this->data;
	}

	/**
	 * Uploaded files.
	 * @return array
	 */
	public function getFiles()
	{
		return $_FILES;
	}

	/**
	 * Accepted response types.
	 * @return array
	 */
	public function getHttpAccept()
	{
		return $this->accept;
	}

	/**
	 * Is this an ajax request?
	 * @return bool
	 */
	public function isAjax()
	{
		return $this->ajax;
	}
 }