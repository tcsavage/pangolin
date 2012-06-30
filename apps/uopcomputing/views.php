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