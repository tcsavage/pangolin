<?php

require_once("config.php");

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/routes.php");
}

$routes = array();
$routes[""] = \uopcomputing\routes();
$routes["admin"] = \admin\routes();
