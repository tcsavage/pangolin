<?php

require_once("config.php");

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/routes.php");
}

$routes = array();
$routes["testapp/errorout"] = "\\testapp\\errorout";
$routes["testapp/{id}"] = "\\testapp\\action1";
$routes["users"] = "\\admin\\index";
$routes["admin"] = \admin\routes();
$routes[""] = "\\testapp\\index";
