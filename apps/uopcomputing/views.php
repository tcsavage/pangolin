<?php namespace uopcomputing;

function index()
{
	$template = new \pangolin\Template;
	$template->render("uopbase");
}

function boardView()
{
	$template = new \pangolin\Template;
	$data = Post::getAll();
	$template->assign("data", $data);
	$template->render("boardView");
}

function postView($vars)
{
	$template = new \pangolin\Template;
	$data = Post::getId($vars['id']);
	$template->assign("post", $data);
	$template->assign("minipost", substr($data->body, 0, 15));
	$template->render("postView");
}