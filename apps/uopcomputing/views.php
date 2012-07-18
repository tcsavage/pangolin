<?php namespace uopcomputing;

require_once("Pusher.php");
require_once("pusherconfig.php");

function loggedIn()
{
	return isset($_SESSION['email']);
}

function getLoggedInUser()
{
	$user = User::getWhere(array("email" => "'".$_SESSION['email']."'"));
	return $user[0];
}

function index($request)
{
	$template = new \pangolin\Template;
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("uopbase");
}

function login($request, $vars)
{
	$template = new \pangolin\Template;
	$template->assign("status", $vars['status']);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("login");
}

function dologin($request)
{
	$pv = $request->getVars();
	$user = User::getWhere(array("email" => "'".$pv['email']."'"));
	if ($user[0] && $user[0]->password == md5($pv['password']))
	{
		$message = array("name" => $user[0]->name, "verb" => "logged in");
		global $pusherconfig;
		$pusher = new \Pusher($pusherconfig['key'], $pusherconfig['secret'], $pusherconfig['appid']);
		$pusher->trigger('uop', 'activity', $message);

		$_SESSION['email'] = $pv['email'];
		header("Location: /");
	}
	else
	{
		header("Location: /login/failed");
	}
}

function doregister($request)
{
	$pv = $request->getVars();
	$user = new User;
	if ($user[0] && $user[0]->password == md5($pv['password']))
	{
		$_SESSION['email'] = $pv['email'];
		header("Location: /");
	}
	else
	{
		header("Location: /login/failed");
	}
}

function boardView($request)
{
	$template = new \pangolin\Template;
	$data = Post::getAll();
	$announcements = Announcement::getAll();
	$template->assign("data", $data);
	$template->assign("announcements", $announcements);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("boardView");
}

function postView($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Post::getId($vars['id']);
	$template->assign("post", $data);
	$template->assign("commentCount", $data->comments->size());
	$template->assign("minipost", substr($data->body, 0, 15));
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("postView");
}

function staticPage($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Page::getWhere(array("slug" => "'".$vars['slug']."'"));
	$template->assign("page", $data[0]);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("staticPage");
}