<?php

define("ROOT",str_replace("\\","/",__DIR__));

require_once("config.php");
require_once("system/bootstrap.php");

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/__init.php");
}

switch ($argv[1])
{
	case "makedb":
		foreach (\admin\Site::getModels() as $model)
		{
			echo("Building " . $model['fullpath'] . "\n");
			$makequery = $model['fullpath']::buildSQLCreate();
			$makequery->run();
		}
	break;

	default:
		echo("Unknown command.\n");
	break;
}

exit(0);