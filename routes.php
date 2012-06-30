<?php

require_once("config.php");

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/routes.php");
}

$routes = array();
$routes["test"] = "\\uopcomputing\\boardView";
$routes["admin"] = \admin\routes();
$routes[""] = "\\uopcomputing\\index";
