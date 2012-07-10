<?php namespace admin;

function templateSetup($template)
{
	$apps = \pangolin\AppData::getInstalledApps();
	$template->assign("apps", $apps);
	$template->assign("root", "/admin");
	$template->assign("username", $_SESSION['username']);
}

function checkLogin()
{
	if (!isset($_SESSION['username']))
	{
		header("Location: /admin/login/required");
	}
}

function index($request)
{
	checkLogin();
	$template = new \pangolin\Template;
	templateSetup($template);
	$template->renderForceApp("base");
}

function login($request, $vars)
{
	$template = new \pangolin\Template;
	$template->assign("status", $vars['status']);
	$template->renderForceApp("login");
}

function dologin($request)
{
	$pv = $request->getVars();
	$user = User::getWhere(array("username" => "'".$pv['username']."'"));
	if ($user[0] && $user[0]->password == md5($pv['password']))
	{
		$_SESSION['username'] = $pv['username'];
		header("Location: /admin");
	}
	else
	{
		header("Location: /admin/login/failed");
	}
}

function logout($request)
{
	session_destroy();
	header("Location: /admin/login/loggedout");
}

function viewApp($request, $vars)
{
	checkLogin();
	$models = \pangolin\AppData::getAppModels($vars['app']);
	$addCount = function($elem) { $elem['count'] = $elem['fullpath']::countAll(); return $elem; };
	$models =  \pangolin\map($models, $addCount);
	$template = new \pangolin\Template;
	templateSetup($template);
	$appManifest = \pangolin\AppData::getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$template->assign("appname", $appManifest->name); // Needed for weird bug.
	$template->assign("models", $models);
	$template->renderForceApp("viewApp");
}

function viewModel($request, $vars)
{
	checkLogin();
	$model = "\\$vars[app]\\$vars[model]";
	$data = $model::getAll();
	$template = new \pangolin\Template;
	templateSetup($template);
	$appManifest = \pangolin\AppData::getAppManifest($vars['app']);
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
}

function modelInsert($request, $vars)
{
	checkLogin();
	$template = new \pangolin\Template;
	templateSetup($template);
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$template->assign("columns", $fullmodelname::getColumnMetadata(true));
	$appManifest = \pangolin\AppData::getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$t = $fullmodelname::getColumnMetadata();
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->renderForceApp("modelInsert");
}

function ajaxInsert($request, $vars)
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

function postInsert($request, $vars)
{
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$data = array_merge($request->getVars(), $request->getFiles());
	$new = new $fullmodelname();
	foreach ($data as $name => $value)
	{
		$new->$name = $value;
	}

	$id = $new->create();

	if ($request->isAjax()) echo($id);
	else header("Location: /admin/$vars[app]/$vars[model]");
}

function modelEdit($request, $vars)
{
	checkLogin();
	$template = new \pangolin\Template;
	templateSetup($template);
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$data = $fullmodelname::getId($vars['id']);
	//die(var_dump($data));
	$template->assign("columns", $fullmodelname::getColumnMetadata(true));
	$template->assign("data", $data);
	$appManifest = \pangolin\AppData::getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$t = $fullmodelname::getColumnMetadata();
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->renderForceApp("modelEdit");
}

function ajaxEdit($request, $vars)
{
	die("foo");
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