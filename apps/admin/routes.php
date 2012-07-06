<?php namespace admin;

function routes()
{
	return array(
		"{app}/{model}/edit/{id}" => "\\admin\\modelEdit",
		"{app}/{model}/insert" => "\\admin\\modelInsert",
		"{app}/{model}/ajaxinsert" => "\\admin\\ajaxInsert",
		"{app}/{model}" => "\\admin\\viewModel",
		"{app}" => "\\admin\\viewApp",
		"" => "\\admin\\index"
	);
}