<?php

use \pangolin;

require("config.php");
require("system/bootstrap.php");
require("apps/testapp/__init.php");

$modelclass = "\\testapp\\Person";

$default = "home";

$router = new \pangolin\Router(isset($_GET['url']) ? $_GET['url'] : $default);

$myperson = new $modelclass("Tom Savage");

echo($myperson->name . " " . $config["development"]["dbname"]);

print_r($router->getUrlElms());