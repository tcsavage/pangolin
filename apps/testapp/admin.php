<?php namespace testapp;

require_once("models.php");
require_once(ROOT . "/apps/admin/__init.php");

\admin\Site::register("\\testapp\\Person");