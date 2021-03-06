<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>{block name=title}Dashboard{/block} - {$pangolin.projectname} Admin Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/static/core/css/debugbar.css">
	<style type="text/css">
	  body {
		padding-top: 60px;
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Le fav and touch icons -->
	<link rel="shortcut icon" href="../assets/ico/favicon.ico">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">


	<script src="/static/jquery/jquery-1.7.2.min.js"></script>
	<script src="/static/bootstrap/js/bootstrap.js"></script>
	<script src="/static/json/json2.js"></script>
	<script src="/static/modernizr/modernizr.min.js"></script>
	<script src="/static/webshims/js/minified/polyfiller.js"></script>
	<script>
		$.webshims.polyfill();
	</script>

	{block name=addheader}{/block}
  </head>

  <body>
	<div class="navbar navbar-fixed-top">
	  <div class="navbar-inner">
		<div class="container-fluid">
		  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </a>
		  <a class="brand" href="{$root}">{$pangolin.projectname} Admin Panel</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li><a href="/">Site Root</a></li>
			  <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Installed Apps
						<b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						{foreach $apps as $a}
						<li><a href="{$root}/{$a->namespace}">{$a->name}</a></li>
						{/foreach}
					</ul>
				</li>
			  <li><a href="https://github.com/tcsavage/pangolin/wiki">Help</a></li>
			  <li><a href="https://github.com/tcsavage/pangolin/issues">Provide Feedback</a></li>
			</ul>
			<ul class="nav pull-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						{$username}
						<b class="caret"></b>
						</a>
					<ul class="dropdown-menu">
						<li><a href="#">Change Password</a></li>
						<li><a href="{$root}/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		  </div><!--/.nav-collapse -->
		</div>
	  </div>
	</div>

	<div class="container-fluid">
		<ul class="breadcrumb">
			<li>
				<a href="#">Admin</a> <span class="divider">/</span>
			</li>
			<li>
				<a href="#">Blog</a> <span class="divider">/</span>
			</li>
			<li class="active">Posts</li>
		</ul>
	</div>

	<div class="container-fluid">
	  <div class="row-fluid">
		<div class="span3">
		  <div class="well sidebar-nav">
			<ul class="nav nav-list">
				{foreach $apps as $a}
				<li class="nav-header">{$a->name}</li>
				<li><a href="{$root}/{$a->namespace|lower}">{$a->name} Dashboard</a></li> <!-- Add class active at some point -->
				{foreach $a->models as $m}
				<li><a href="{$root}/{$a->namespace|lower}/{$m.class|lower}">Manage {$m.class|pluralize|capitalize}</a></li>
				{/foreach}
				{/foreach}
			</ul>
		  </div><!--/.well -->
		</div><!--/span-->
		<div class="span9">
			{block name=body}
		  <div class="hero-unit">
			<h1>Greetings, human!</h1>
			<p>This is Pangolin's administration area. Here you can perform operations on your models and configure applications.</p>
			<p><a class="btn btn-primary btn-large" href="https://github.com/tcsavage/pangolin/wiki">Read the documentation &raquo;</a></p>
		  </div>
		  <div class="row-fluid">
		  	{foreach $apps as $a}
			<div class="span4">
			  <h2>{$a->name}</h2>
			  <p>{$a->description}</p>
			  <p><a class="btn" href="{$root}/{$a->namespace|lower}">Go to dashboard &raquo;</a></p>
			</div>
			{/foreach}
		  {/block}
		</div><!--/span-->
	  </div><!--/row-->

	  <hr>

	  <footer>
		<p><a href="https://github.com/tcsavage/pangolin">Pangolin Framework</a>. Copyright &copy; <a href="http://tcsavage.org">Tom Savage</a> 2012. Made with <a href="http://getbootstrap.com">Bootstrap</a>.
	  </footer>

	</div><!--/.fluid-container-->

	{block name=final}{/block}
  </body>
</html>