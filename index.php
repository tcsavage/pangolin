<?php

//use \pangolin;

require("config.php");
require("routes.php");
require("system/bootstrap.php");
require("testapp/__init.php");

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

$router = new \pangolin\Router((isset($_GET['url']) ? $_GET['url'] : "__default"), $routes);

\pangolin\Database::disconnectAll();

$tmp = new \pangolin\Template("template.html");