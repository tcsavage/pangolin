<?php namespace uopcomputing;

require_once("models.php");

\admin\Site::register(User::name());
\admin\Site::register(Post::name());
\admin\Site::register(Comment::name());
\admin\Site::register(Tag::name());
\admin\Site::register(Page::name());