<?php namespace admin;

require_once("models.php");
require_once("Site.php");

\admin\Site::register(User::name());
\admin\Site::register(Config::name());