<?php namespace admin;

function index()
{
	$users = User::getAll();
	$template = new \pangolin\Template;
	$template->assign("users", $users);
	$template->assign("apps", getInstalledApps());
	$template->render("base");
}