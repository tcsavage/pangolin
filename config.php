<?php

$dbconfig = array(
	"development" => array(
		"user" => "root",
		"pass" => "",
		"name" => "pangolin_test",
		"engine" => "mysql",
		"host" => "localhost",
	),
);

$installedapps = array(
	"testapp",
	"admin"
);

$projectname = "Testing";

$siteDomain = "localhost";

// Warning level 0-3. 0 for silence. 3 for everything including debug messages.
$warninglevel = 2;