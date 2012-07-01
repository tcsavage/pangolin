<?php namespace uopcomputing;

class User extends \pangolin\Model
{
	public $name;
	public $email;
	public $password;
	//public $karma;


	public function __construct()
	{
		$this->name = new \pangolin\TextField(array(
			"maxlength" => 150,
			"order" => 1,
			"prettyname" => "Full name"), null);
		$this->email = new \pangolin\EmailField(array(
			"order" => 2,
			"prettyname" => "Email address"), null);
		$this->password = new \pangolin\PasswordField(array(
			"order" => 3,
			"prettyname" => "Password hash"), null);


		parent::__construct();
	}
}

class Post extends \pangolin\Model
{
	public $body;
	public $user;
	public $date;
	public $comments;

	public function __construct()
	{
		$this->body = new \pangolin\TextField(array(
			"order" => 1,
			"prettyname" => "Post Body"), null);
		$this->user = new \pangolin\ForeignField(array(
			"order" => 2,
			"prettyname" => "User", 
			"helptext" => "Foreign key of posting user.", 
			"model" => get_class(new User())), null);
		$this->date = new \pangolin\DateField(array(
			"order" => 3,
			"prettyname" => "Date Posted"), null);
		$this->comments = new \pangolin\ForeignArray(array(
			"order" => 3,
			"prettyname" => "Comments",
			"model" => "\\uopcomputing\\Comment",
			"field" => "post"), null);

		parent::__construct();
	}
}

class Comment extends \pangolin\Model
{
	public $body;
	public $user;
	public $date;
	public $promoted;
	public $post;

	public function __construct()
	{
		$this->body = new \pangolin\TextField(array(
			"order" => 1,
			"prettyname" => "Comment Body"), null);
		$this->user = new \pangolin\ForeignField(array(
			"order" => 2,
			"prettyname" => "User", 
			"model" => get_class(new User())), null);
		$this->date = new \pangolin\DateField(array(
			"order" => 3,
			"prettyname" => "Date Posted"), null);
		$this->promoted = new \pangolin\BoolField(array(
			"order" => 4,
			"prettyname" => "Promoted?"), null);
		$this->post = new \pangolin\ForeignField(array(
			"order" => 5,
			"prettyname" => "Post", 
			"model" => get_class(new Post())), null);

		parent::__construct();
	}
}

class Tag extends \pangolin\Model
{
	public $name;

	public function __construct()
	{
		$this->name = new \pangolin\TextField(array(
			"prettyname" => "Tag Name"), null);

		parent::__construct();
	}
}

class Page extends \pangolin\Model
{
	public $name;
	public $content;
	public $slug;

	public function __construct()
	{
		$this->name = new \pangolin\TextField(array(
			"maxlength" => 200, 
			"order" => 1,
			"prettyname" => "Page Title"), null);
		$this->content = new \pangolin\TextField(array(
			"prettyname" => "HTML Source Code", 
			"order" => 2), null);
		$this->slug = new \pangolin\SlugField(array(
			"prettyname" => "URL slug",
			"order" => 3), null);

		parent::__construct();
	}
}

class Announcement extends \pangolin\Model
{
	public $title;
	public $body;

	public function __construct()
	{
		$this->title = new \pangolin\TextField(array(
			"maxlength" => 100,
			"order" => 1,
			"prettyname" => "Announcement Title"), null);
		$this->body = new \pangolin\TextField(array(
			"order" => 2,
			"prettyname" => "Announcement Body"), null);

		parent::__construct();
	}
} 