<?php

//use \pangolin;

require("config.php");
require("routes.php");
require("system/bootstrap.php");
require("apps/testapp/__init.php");

$modelclass = "\\testapp\\Person";

$default = "home";

$router = new \pangolin\Router(isset($_GET['url']) ? $_GET['url'] : $default, $routes);

$myperson = new $modelclass("Tom Savage", 20, "tcsavage@gmail.com");

echo($myperson->name);
$myperson->name = "New namevvvbvcxdfhjkjgfghjdcfhjcxhjk";
echo($myperson->name);
