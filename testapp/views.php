<?php namespace testapp;

function index()
{
	$people = Person::getAll();
	$template = new \pangolin\Template;
	$template->assign("people", $people);
	$template->render("test", $people);
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

function action2()
{
	echo("Test");
}