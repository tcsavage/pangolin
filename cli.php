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
		foreach (\pangolin\AppData::getModels() as $model)
		{
			echo("Building " . $model['fullpath'] . "\n");
			$makequery = $model['fullpath']::buildSQLCreate();
			$makequery->run();
		}
	break;
	case "testdata":
		$user1 = new \uopcomputing\User();
		$user1->name = "Yorgsef";
		$user1->email = "yorgsef@example.com";
		$user1->password = "password";
		$user1->flair = "Year 1 - Computing";
		$user1->banned = 0;
		$u1id = $user1->create();
		$user2 = new \uopcomputing\User();
		$user2->name = "Jonathan Moermans";
		$user2->email = "jon@jonsucks.com";
		$user2->password = "u76a59b6ga76b";
		$user2->flair = "gay flair";
		$user2->banned = 1;
		$u2id = $user2->create();
		$user3 = new \uopcomputing\User();
		$user3->name = "Roddynf";
		$user3->email = "roddynf@example.com";
		$user3->password = "password";
		$user3->flair = "Year 2 - Awesome";
		$user3->banned = 0;
		$u3id = $user3->create();
		$post1 = new \uopcomputing\Post();
		$post1->body = "This is an example post about something, maybe.";
		$post1->user = $u1id;
		$post1->date = "2012-07-01";
		$p1id = $post1->create();
		$post2 = new \uopcomputing\Post();
		$post2->body = "This is a spam post that probably features the words nazi and niggers";
		$post2->user = $u2id;
		$post2->date = "2012-07-02";
		$p2id = $post2->create();
		$comment1 = new \uopcomputing\Comment();
		$comment1->body = "Example comment.";
		$comment1->user = $u3id;
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

	case "makeuser":
		if (isset($argv[4]))
		{
			$user = new \admin\User();
			$user->username = $argv[2];
			$user->email = $argv[3];
			$user->password = $argv[4];
			$user->create();
		}
		break;

	case "facebook":
		$accesstoken = "";
		$jsonurl = "https://graph.facebook.com/154342131271237/members";
		$jsontext = \file_get_contents($jsonurl."?access_token=".$accesstoken,0,null,null);
		$json = \json_decode($jsontext);
		echo("Creating " . count($json->data) . " users...\n");
		foreach ($json->data as $i => $user)
		{
			echo("User " . $i . ": .");
			$userjsonurl = "https://graph.facebook.com/".$user->id;
			echo(".");
			$userjsontext = \file_get_contents($userjsonurl."?access_token=".$accesstoken,0,null,null);
			echo(".");
			$userjson = \json_decode($userjsontext);
			echo(".");

			//$picurl = \file_get_contents($userjsonurl."/picture?access_token=".$accesstoken,0,null,null);
			echo(".");

			$ob = new \uopcomputing\User();
			echo(".");
			$ob->name = mysql_real_escape_string($user->name);
			echo(".");
			$ob->email = $userjson->username."@facebook.com";
			echo(".");
			$ob->password = "lol";
			echo(".");
			$ob->flair = "Test User";
			echo(".");
			$ob->banned = 0;
			echo(".");
			$ob->roll = "user";
			echo(".");
			//$ob->profilePic = $picurl;
			echo(".");
			$ob->create();
			echo(". Done!\n");
		}
		echo("\nFinshed!\n");
		break;
		
	case "dropall":
		break;

	default:
		echo("Unknown command.\n");
	break;
}

exit(0);