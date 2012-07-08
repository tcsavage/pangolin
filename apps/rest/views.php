<?php namespace rest;

function index($request, $vars)
{
	header('Content-type: application/json');

	$out = array(
		"foo" => "bar"
	);

	echo(json_encode($out));
}

function appInfo($request, $vars)
{
	header('Content-type: application/json');

	echo(json_encode(\pangolin\AppData::getAppManifest($vars['app'])));
}

function model($request, $vars)
{
	header('Content-type: application/json');

	switch ($request->getMethod())
	{
		case "get":
			$model = "\\$vars[app]\\$vars[model]";
			$data = $model::getAll();

			echo(json_encode($data->getSimple()));
			break;

		case "put":
		case "post":
			if ($request->getData())
			{
				$data = json_decode($request->getData());
				die(var_dump($data));
			}
			else
			{
				\pangolin\set_http_response_code(501);
				echo(json_encode(array("error_code" => 501)));
			}
			break;
		default:
			\pangolin\set_http_response_code(405);
			echo(json_encode(array("error_code" => 405)));
			break;
	}
}

function record($request, $vars)
{
	header('Content-type: application/json');

	$model = "\\$vars[app]\\$vars[model]";
	$data = $model::getId($vars['id']);

	echo(json_encode($data->getSimpleData()));
}