<?php

define("ROOT",str_replace("\\","/",__DIR__));

require_once("config.php");
require_once("system/bootstrap.php");

$db = new \pangolin\Database($dbconfig["development"]);
$db->connect();

foreach ($installedapps as $app)
{
	require_once("apps/".$app."/__init.php");
}

switch ($argv[1])
{
	case "makedb":
		foreach (\admin\Site::getModels() as $model)
		{
			echo("Building " . $model['fullpath'] . "\n");
			$makequery = $model['fullpath']::buildSQLCreate();
			$makequery->run();
		}
	break;
	case "testdata":
		$user1 = new \uopcomputing\User();
		$user1->name = "bob";
		$user1->email = "bob@bob.com";
		$user1->password = "6656a57c6d7r7";
		$user1->flair = "IM A REAL FLAIR!"
		$u1id = $user1->create();
		$post1 = new \uopcomputing\Post();
		$post1->body = "post 1 body";
		$post1->user = $u1id;
		$post1->date = "2012-07-01";
		$p1id = $post1->create();
		$comment1 = new \uopcomputing\Comment();
		$comment1->body = "comment body";
		$comment1->user = $u1id;
		$comment1->date = "2012-07-02";
		$comment1->promoted = 0;
		$comment1->post = $p1id;
		$c1id = $comment1->create();
		$page1 = new \uopcomputing\Page();
		$page1->name = "Test Static Page";
		$page1->content = "<h1>This is a heading</h1><p>this is a paragraph</p>";
		$page1->slug = "test";
		$page1->create();
		$alert1 = new \uopcomputing\Announcement();
		$alert1->title = "Announcment Title";
		$alert1->body = "Announcment Body";
		$alert1->create();

	break;
	case "dropall":
		break;

	default:
		echo("Unknown command.\n");
	break;
}

exit(0);