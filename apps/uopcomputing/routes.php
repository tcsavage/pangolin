<?php namespace uopcomputing;

function routes()
{
	return array(
		"" => "\\uopcomputing\\boardView",
		"post/{id}" => "\\uopcomputing\\postView",
		"page/{slug}" => "\\uopcomputing\\staticPage"
	);
}