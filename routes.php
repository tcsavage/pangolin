<?php

require_once("config.php");

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/routes.php");
}

$routes = array();
$routes["admin"] = \admin\routes();
$routes[""] = "\\uopcomputing\\index";
