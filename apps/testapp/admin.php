<?php namespace testapp;

require_once("models.php");
require_once(ROOT . "/apps/admin/__init.php");

\admin\Site::register(Person::name());
\admin\Site::register(Post::name());