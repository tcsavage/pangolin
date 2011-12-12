<?php

//use \pangolin;

require("config.php");
require("routes.php");
require("system/bootstrap.php");
require("testapp/__init.php");

$link = mysql_connect('localhost', $config["development"]["dbuser"], $config["development"]["dbpass"]);
mysql_select_db($config["development"]["dbname"]);

$modelclass = "\\testapp\\Person";

$router = new \pangolin\Router((isset($_GET['url']) ? $_GET['url'] : "__default"), $routes);