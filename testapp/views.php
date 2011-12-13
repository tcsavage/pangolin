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

function action1()
{
	$person = Person::getID(2);
	echo($person->name);
}