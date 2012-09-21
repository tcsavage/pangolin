<?php namespace uopcomputing;

require_once("Pusher.php");
require_once("pusherconfig.php");

function loggedIn()
{
	return isset($_SESSION['email']);
}

function getLoggedInUser()
{
	$user = User::getWhere(array("email" => "'".$_SESSION['email']."'"));
	return $user[0];
}

function pushMessage($name, $verb, $message = null, $link = null)
{
	$data = array("name" => $name, "verb" => $verb);
	if ($message) $data['message'] = $message;
	if ($link) $data['link'] = $link;
	global $pusherconfig;
	$pusher = new \Pusher($pusherconfig['key'], $pusherconfig['secret'], $pusherconfig['appid']);
	$pusher->trigger('uop', 'activity', $data);
}

function index($request)
{
	$template = new \pangolin\Template;
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("uopbase");
}

function login($request, $vars)
{
	$str = "foo@example.com";
	$estr = \pangolin\encrypt($str);
	echo($str . " : " . $estr . " : " . \pangolin\decrypt(urlencode($estr)));
	$template = new \pangolin\Template;
	$template->assign("status", $vars['status']);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("login");
}

function dologin($request)
{
	$pv = $request->getVars();
	$user = User::getWhere(array("email" => "'".$pv['email']."'"));
	if ($user[0] && $user[0]->password == md5($pv['password']))
	{
		pushMessage($user[0]->name, "logged in");

		$_SESSION['email'] = $pv['email'];
		$_SESSION['id'] = $user[0]->id;
		header("Location: /");
	}
	elseif ($user[0])
	{
		header("Location: /login/failed");
	}
	else
	{
		$user = new User();
		$user->email = $pv['email'];
		$user->password = md5($pv['password']);
		try
		{
			$id = $user->create();
			header("Location: /register/" . \pangolin\encrypt($id));
		}
		catch (\Exception $e)
		{
			\pangolin\set_http_response_code(500);
			die($e->getMessage());
		}
	}
}

function dologout($request)
{
	session_destroy();
	header("Location: /");
}

function register($request, $vars)
{
	$id = \pangolin\decrypt($vars['id']);
	$user = User::getId($id);
	$template = new \pangolin\Template;
	$template->assign("email", $user->email);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("register");
}

function doregister($request)
{
	$pv = $request->getVars();
	$user = User::getId($pv['id']);
	if ($user[0] && $user[0]->password == md5($pv['password']))
	{
		$_SESSION['email'] = $pv['email'];
		header("Location: /");
	}
	else
	{
		header("Location: /login/failed");
	}
}

function boardView($request)
{
	$template = new \pangolin\Template;
	$data = Post::getAll();
	$announcements = Announcement::getAll();
	$template->assign("data", $data);
	$template->assign("announcements", $announcements);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("boardView");
}

function postView($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Post::getId($vars['id']);
	$template->assign("post", $data);
	$template->assign("commentCount", $data->comments->size());
	$template->assign("minipost", substr($data->body, 0, 15));
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("postView");
}

function doComment($request, $vars)
{
	// We only want logged in users to comment (duh).
	if (loggedIn())
	{
		$post = $request->getVars();

		// Build the new comment object.
		$new = new Comment();
		$new->post = $vars['id'];
		$new->user = $_SESSION['id'];
		$new->body = $post['body'];
		$new->karma = "1";
		$new->promoted = false;

		// Get user details for later.
		$user = getLoggedInUser();

		// We want to handle this differently if it's an ajax request.
		if ($request->isAjax())
		{
			// If it's ajax, we should catch any enxeptions and return the error message back to the sender.
			try
			{
				echo($new->create());
			}
			catch (\Exception $e)
			{
				\pangolin\set_http_response_code(500);
				die($e->getMessage());
			}

			// Push an activity message out to connected clients.
			pushMessage($user->name, "commented", $post['body'], "/post/$vars[id]#comments");
		}
		else
		{
			// If it's not ajax, just create the object, push a message out and return.
			// If it errors, the default error handler will chatch it. It won't be pretty but most users will go that ajax route anyways.
			$new->create();
			pushMessage($user->name, "commented", $post['body'], "/post/$vars[id]#comments");
			header("Location: /post/$vars[id]#comments");
		}
	}
}

function staticPage($request, $vars)
{
	$template = new \pangolin\Template;
	$data = Page::getWhere(array("slug" => "'".$vars['slug']."'"));
	$template->assign("page", $data[0]);
	$template->assign("loggedIn", (loggedIn()) ? getLoggedInUser() : false);
	$template->render("staticPage");
}