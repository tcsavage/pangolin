<?php namespace admin;

function routes()
{
	return array(
		"{app}/{model}/insert" => "modelInsert",
		"{app}/{model}" => "viewModel",
		"{app}" => "viewApp",
		"" => "index"
	);
}