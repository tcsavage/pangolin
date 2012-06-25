<?php namespace testapp;

function index()
{
	$posts = Post::getAll();
	$template = new \pangolin\Template;
	$template->assign("posts", $posts);
	$template->render("test");
}

function add($vars)
{
	$template = new \pangolin\Template;
	$template->assign("people", $people);
	$template->render("add");
}

function action1($vars)
{
	$person = Person::getID($vars["id"]);
	if (!$person)
	{
		echo("Can't find ID " . $vars["id"]);
	}
	else
	{
		echo($person->name);
	}
}

function errorout()
{
	throw new \Exception("Test Exception");
}