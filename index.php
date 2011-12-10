<?php

use \pangolin;

require("system/Model.php");
require("apps/testapp/__init.php");

$tst = "\\testapp\\Person";

$default = "home";

$url = isset($_GET['url']) ? $_GET['url'] : $default;

$myperson = new $tst($url);

echo($myperson->name);