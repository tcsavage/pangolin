<?php namespace admin;

function getInstalledApps()
{
	global $installedapps;

	$apps = array();

	foreach ($installedapps as $app)
	{
		$config = json_decode(file_get_contents(ROOT . "/apps/$app/config.json"));
		$config->appDir = $app;
		$apps[] = $config;
	}
	return $apps;
}