<?php

$dbconfig = array(
	"development" => array(
		"user" => "root",
		"pass" => "rootpw",
		"name" => "uopcomputing",
		"engine" => "mysql",
		"host" => "localhost",
	),
);

$installedapps = array(
	"testapp",
	"admin",
	"uopcomputing"
);

$projectname = "UoP Computing";

$siteDomain = "localhost";

// Warning level 0-3. 0 for silence. 3 for everything including debug messages.
$warninglevel = 2;