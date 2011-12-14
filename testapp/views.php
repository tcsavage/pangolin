<?php namespace testapp;

function index()
{
	$people = Person::getAll();
	echo("<ul>");
	foreach ($people as $p)
	{
		echo("<li>" . $p->name . "</li>");
	}
	echo("</ul>");
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