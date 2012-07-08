<?php namespace rest;

function routes()
{
	return array(
		"{app}/{model}/{id}" => "\\rest\\record",
		"{app}/{model}" => "\\rest\\model",
		"{app}" => "\\rest\\appInfo",
		"" => "\\rest\\index"
	);
}