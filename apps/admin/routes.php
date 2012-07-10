<?php namespace admin;

function routes()
{
	return array(
		"login" => "\\admin\\login",
		"login/do" => "\\admin\\dologin",
		"login/{status}" => "\\admin\\login",
		"logout" => "\\admin\\logout",
		"{app}/{model}/edit/do" => "\\admin\\postEdit",
		"{app}/{model}/edit/{id}" => "\\admin\\modelEdit",
		"{app}/{model}/insert" => "\\admin\\modelInsert",
		"{app}/{model}/insert/do" => "\\admin\\postInsert",
		"{app}/{model}" => "\\admin\\viewModel",
		"{app}" => "\\admin\\viewApp",
		"" => "\\admin\\index"
	);
}