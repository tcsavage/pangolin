<?php

require_once("config.php");

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/routes.php");
}

$routes = array();
$routes["post/{id}"] = "\\uopcomputing\\postView";
$routes["page/{slug}"] = "\\uopcomputing\\staticPage";
$routes[""] = "\\uopcomputing\\boardView";
$routes["admin"] = \admin\routes();
