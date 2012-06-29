<?php namespace uopcomputing;

function index()
{
	echo "string";
	$template = new \pangolin\Template;
	$template->render("base");
}
