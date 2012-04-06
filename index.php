<?php

//use \pangolin;

define("ROOT",str_replace("\\","/",__DIR__));

require_once("config.php");
require_once("system/bootstrap.php");

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/__init.php");
}

require("routes.php");

$router = new \pangolin\Router((isset($_GET['url']) ? $_GET['url'] : "__default"), $routes);

\pangolin\Database::disconnectAll();