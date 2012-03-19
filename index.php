<?php

//use \pangolin;

define("ROOT",str_replace("\\","/",__DIR__));
echo(ROOT);

require("config.php");
require("routes.php");
require("system/bootstrap.php");

foreach ($installedapps as $app)
{
	require($app."/__init.php");
}

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

$router = new \pangolin\Router((isset($_GET['url']) ? $_GET['url'] : "__default"), $routes);

\pangolin\Database::disconnectAll();

//$tmp = new \pangolin\Template("template.html");