<!DOCTYPE html>
<html lang="en">
  <head>
	<meta charset="utf-8">
	<title>Project Admin Panel</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Le styles -->
	<link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
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
		  <a class="brand" href="#">Project Admin Panel</a>
		  <div class="nav-collapse">
			<ul class="nav">
			  <li class="active"><a href="#">Admin Home</a></li>
			  <li><a href="#help">Help</a></li>
			  <li><a href="#help">Provide Feedback</a></li>
			</ul>
			<p class="navbar-text pull-right">Logged in as <a href="#">username</a> | <a href="#">logout</a></p>
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
				{foreach $apps as $app}
				<li class="nav-header">{$app->appName}</li>
				{/foreach}
			  <li class="nav-header">Blog</li>
			  <li class="active"><a href="#">Dashboard</a></li>
			  <li><a href="#">Manage Posts</a></li>
			  <li><a href="#">Manage Comments</a></li>
			  <li class="nav-header">Gallery</li>
			  <li><a href="#">Manage Images</a></li>
			  <li><a href="#">Manage Collections</a></li>
			  <li class="nav-header">Admin</li>
			  <li><a href="#">Manage Users</a></li>
			  <li><a href="#">Manage Site Config</a></li>
			</ul>
		  </div><!--/.well -->
		</div><!--/span-->
		<div class="span9">
		  <div class="hero-unit">
			<h1>Greetings, human!</h1>
			<p>This is Pangolin's administration area. Here you can perform operations on your models and configure applications.</p>
			<p><a class="btn btn-primary btn-large">Read the documentation &raquo;</a></p>
		  </div>
		  <div class="row-fluid">
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
		  </div><!--/row-->
		  <div class="row-fluid">
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
			<div class="span4">
			  <h2>Heading</h2>
			  <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
			  <p><a class="btn" href="#">View details &raquo;</a></p>
			</div><!--/span-->
		  </div><!--/row-->
		</div><!--/span-->
	  </div><!--/row-->

	  <hr>

	  <footer>
		<p>Pangolin Framework. Copyright &copy; Tom Savage 2012</p>
		<p>Admin area template courtesy of <a href="http://twitter.github.com/bootstrap/index.html">Twitter Bootcamp</a>.
	  </footer>

	</div><!--/.fluid-container-->

	<!-- Le javascript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="/static/bootstrap/js/jquery.js"></script>
	<script src="/static/bootstrap/js/bootstrap-transition.js"></script>
	<script src="/static/bootstrap/js/bootstrap-alert.js"></script>
	<script src="/static/bootstrap/js/bootstrap-modal.js"></script>
	<script src="/static/bootstrap/js/bootstrap-dropdown.js"></script>
	<script src="/static/bootstrap/js/bootstrap-scrollspy.js"></script>
	<script src="/static/bootstrap/js/bootstrap-tab.js"></script>
	<script src="/static/bootstrap/js/bootstrap-tooltip.js"></script>
	<script src="/static/bootstrap/js/bootstrap-popover.js"></script>
	<script src="/static/bootstrap/js/bootstrap-button.js"></script>
	<script src="/static/bootstrap/js/bootstrap-collapse.js"></script>
	<script src="/static/bootstrap/js/bootstrap-carousel.js"></script>
	<script src="/static/bootstrap/js/bootstrap-typeahead.js"></script>
  </body>
</html>