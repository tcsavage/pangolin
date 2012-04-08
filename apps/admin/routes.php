<?php namespace admin;

function routes()
{
	return array(
		"{app}/{model}" => "viewModel",
		"{app}" => "viewApp",
		"" => "index"
	);
}