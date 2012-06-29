<?php namespace uopcomputing;

function index()
{
	$template = new \pangolin\Template;
	templateSetup($template);
	$template->render("base");
}
