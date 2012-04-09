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
	$template->render("base");
}

function viewApp($vars)
{
	$models = Site::getAppModels($vars['app']);
	$template = new \pangolin\Template;
	templateSetup($template);
	$appManifest = getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$template->assign("appname", $appManifest->name); // Needed for weird bug.
	$template->assign("models", $models);
	$template->render("viewApp");
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
	$template->assign("columns", $data[0]->getColumns());
	$template->assign("hrcolumns", $data[0]->getPrettyColumnNames());
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->render("viewModel");

	print_r(\pangolin\Debug::getQueries());
}

function modelInsert($vars)
{
	$template = new \pangolin\Template;
	templateSetup($template);
	$fullmodelname = "\\$vars[app]\\$vars[model]";
	$template->assign("columns", $fullmodelname::getColumnMetadata());
	$appManifest = getAppManifest($vars['app']);
	$template->assign("app", $appManifest);
	$t = $fullmodelname::getColumnMetadata();
	$template->assign("model", $vars['model']);
	$template->assign("modelname", $vars['model']); // Needed for weird bug.
	$template->render("modelInsert");
}