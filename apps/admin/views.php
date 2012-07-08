<?php namespace admin;

function templateSetup($template)
{
	$apps = getInstalledApps();
	$template->assign("apps", $apps);
	$template->assign("root", "/admin");
}

function index()
{
	$template = new \pangolin\Template;
	templateSetup($template);
	$template->renderForceApp("base");
}

function viewApp($vars)
{
	$models = Site::getAppModels($vars['app']);
	$addCount = function($elem) { $elem['count'] = $elem['fullpath']::countAll(); return $elem; };
	$models =  \pangolin\map($models, $addCount);
	$template = new \pangolin\Template;
	templateSetup($template);
	$appManifest = getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$template->assign("appname", $appManifest->name); // Needed for weird bug.
	$template->assign("models", $models);
	$template->renderForceApp("viewApp");
}

function viewModel($vars)
{
	$model = "\\$vars[app]\\$vars[model]";
	$data = $model::getAll();
	$template = new \pangolin\Template;
	templateSetup($template);
	$appManifest = getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$template->assign("appname", $appManifest->name);
	$template->assign("data", $data);
	$template->assign("count", $model::countAll());
	$template->assign("columns", $model::getColumnsS());
	$template->assign("hrcolumns", $model::getPrettyColumnNamesS());
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->assign("attributes", print_r(\pangolin\AttributeReader::classAttributes($model), true));
	$template->renderForceApp("viewModel");

	echo("<h3>SQL queries run on this page:</h3><pre>");
	print_r(\pangolin\Debug::getQueries());
	echo("</pre>");
}

function modelInsert($vars)
{
	$template = new \pangolin\Template;
	templateSetup($template);
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$template->assign("columns", $fullmodelname::getColumnMetadata(true));
	$appManifest = getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$t = $fullmodelname::getColumnMetadata();
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->renderForceApp("modelInsert");
}

function ajaxInsert($vars, $post)
{
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$data = json_decode($_POST['record']);
	$new = new $fullmodelname();
	foreach ($data as $name => $value)
	{
		$new->$name = $value;
	}

	try
	{
		echo($new->create());
	}
	catch (\Exception $e)
	{
		\pangolin\set_http_response_code(500);
		die($e->getMessage());
	}
}