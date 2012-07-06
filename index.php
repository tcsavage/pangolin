<?php

//use \pangolin;

define("ROOT",str_replace("\\","/",__DIR__));

// Handle errors as exceptions.
function exception_error_handler($errno, $errstr, $errfile, $errline )
{
	$exit = false;
	switch ( $errno ) {
		case E_USER_ERROR:
			$type = 'Fatal Error';
			$exit = true;
			break;
		case E_USER_WARNING:
		case E_WARNING:
			$type = 'Warning';
			break;
		case E_USER_NOTICE:
		case E_NOTICE:
		case @E_STRICT:
			$type = 'Notice';
			break;
		case @E_RECOVERABLE_ERROR:
			$type = 'Catchable';
			break;
		default:
			$type = 'Unknown Error';
			$exit = true;
			break;
	}
    if ($exit) throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}
set_error_handler("exception_error_handler");

require_once("config.php");
require_once("system/bootstrap.php");

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/__init.php");
}

require("routes.php");

try
{
	\pangolin\Router::setup((isset($_GET['url']) ? $_GET['url'] : ""));
	\pangolin\Router::route($routes);
}
catch (Exception $e)
{
	\pangolin\render_error_page($e);
}

\pangolin\Database::disconnectAll();