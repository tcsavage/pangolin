<?php namespace admin;

function getInstalledApps()
{
	global $installedapps;

	$apps = array();

	foreach ($installedapps as $app)
	{
		$manifest = getAppManifest($app);
		$apps[] = $manifest;
	}
	return $apps;
}

function getAppManifest($app)
{
	$manifest = json_decode(file_get_contents(ROOT . "/apps/$app/manifest.json"));
	$manifest->namespace = $app;
	$manifest->models = Site::getAppModels($app);
	return $manifest;
}