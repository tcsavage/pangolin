<?php namespace uopcomputing;

function index($request)
{
	$template = new \pangolin\Template;
	$template->render("uopbase");
}

function boardView($request)
{
	$template = new \pangolin\Template;
	$data = Post::getAll();
	$announcements = Announcement::getAll();
	$template->assign("data", $data);
	$template->assign("announcements", $announcements);
	$template->render("boardView");
}

function postView($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Post::getId($vars['id']);
	$template->assign("post", $data);
	$template->assign("commentCount", $data->comments->size());
	$template->assign("minipost", substr($data->body, 0, 15));
	$template->render("postView");
}

function staticPage($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Page::getWhere(array("slug" => "'".$vars['slug']."'"));
	$template->assign("page", $data[0]);
	$template->render("staticPage");
}