<?php namespace uopcomputing;

function routes()
{
	return array(
		"" => "\\uopcomputing\\boardView",
		"post/{id}" => "\\uopcomputing\\postView",
		"page/{slug}" => "\\uopcomputing\\staticPage",
		"login" => "\\uopcomputing\\login",
		"login/do" => "\\uopcomputing\\dologin",
		"login/{status}" => "\\uopcomputing\\login"
	);
}