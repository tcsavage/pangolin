<!DOCTYPE html>
<html>
<head>
	<title>{block name="title"}{/block}</title>
	<link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/uop/css/main.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <script src="/static/modernizr/modernizr.min.js"></script>
	<script src="/static/jquery/jquery-1.7.2.min.js"></script>
    <script src="/static/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/webshims/js/minified/polyfiller.js"></script>
    <script src="http://js.pusher.com/1.12/pusher.min.js"></script>
    <script>
		$.webshims.polyfill();

		// Enable pusher logging - don't include this in production
		Pusher.log = function(message) {
			if (window.console && window.console.log) window.console.log(message);
		};

		// Flash fallback logging - don't include this in production
		WEB_SOCKET_DEBUG = true;

		var pusher = new Pusher('{$pusherkey}');
		var channel = pusher.subscribe('uop');
		channel.bind('activity', function(data) {
			if ($("#activity").children().length > 3) {
				$("#activity p:last").fadeOut().remove();
			}
			
			txt = '<p>';
			if (data.link) {
				txt = txt +'<a href="'+ data.link +'">';
			}
			txt = txt +'<strong>'+ data.name +' '+ data.verb;
			if (data.message) {
				txt = txt +' -</strong> '+ data.message;
			}
			if (data.link) {
				txt = txt +'</a>';
			}
			txt = txt +'</p>';
			$(txt).hide().prependTo("#activity").fadeIn();
		});
	</script>
	{block name="extraheaders"}{/block}
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
				<a class="brand" href="#">UoP Computing</a>
				{if $loggedIn}
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i> {$loggedIn->email}
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						{if $loggedIn->isAdmin()}
						<li><a href="/admin">Admin Panel</a></li>
						{/if}
						<li class="divider"></li>
						<li><a href="#">Sign Out</a></li>
					</ul>
				</div>
				{else}
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="/login">
						<i class="icon-user"></i> Login / Register
					</a>
				</div>
				{/if}
				<div class="nav-collapse">
					<ul class="nav">
						<li class="active"><a href="#">Home</a></li>
						<li><a href="#about">About</a></li>
						<li><a href="#contact">Contact</a></li>
					</ul>
				</div>
				<form class="nav-collapse navbar-search pull-left">
					<input type="text" class="search-query" placeholder="Search">
				</form><!--/.nav-collapse -->
			</div>
		</div>
	</div>

	<header class="intro">
		<div class="container" id="activity">
		</div>
	</header>

	<div class="container">
		<div class="row">
					{block name="main"}<article class="span8">There doesnt seem to be anything here...</article>{/block}
					{block name="sidebar"}<aside class="span4">
						<h3>Subscriptions</h3>
						<div class="tags">
							<a class="label">haskell</a>
							<a class="label">template-haskell</a>
							<a class="label">procap</a>
							<a class="label">computer-science</a>
							<a class="label">type-level-programming</a>
							<a class="label">lambda-calculus</a>
							<a class="label">humour</a>
						</div>
						<form class="form-inline" style="margin-top:10px">
							<input type="text" class="input-small" placeholder="Tag">
							<button type="submit" class="btn">Add</button>
						</form>
					</aside>{/block}
				</div>
				<!-- <hr> -->
				<!-- <div class="row">
					<article class="span8">
						<h1><span>CORGMA &raquo;</span> Alex Bright</h1>
						<p>In case anyone got feedback when they submitted their exams, I have spoken to Ann, and this feedback has no relation to the marks you got on your exam. This feedback is related to how well the program worked, and is only meant to be displayed to the program creator, and should therefore not have come up. Also, our marks should be available in about 2 weeks, but Ann hopes to get them to us sooner.</p>
						<small>Posted May 22 2012 at 13:35. <a href="#">Permalink</a></small>
						<hr>
						<div class="comments">
							<div class="comment">
								<div class="number">1</div>
								<img src="tempimg/x.jpg" class="profilepic">
								<h3>Artur Salagean</h3>
								<div class="content">
									<p>I NEED THE MARKS NOW !!!!!!!!!</p>
								</div>
							</div>
							<div class="comment">
								<div class="number">2</div>
								<img src="tempimg/y.jpg" class="profilepic">
								<h3>Harry Cardew</h3>
								<div class="content">
									<p>i hope this a good thing and not bad</p>
								</div>
							</div>
						</div>
						<hr>
						<form>
							<textarea></textarea>
							<input type="submit" value="Submit">
						</form>
					</article>
					<aside class="span4">
						<img src="tempimg/x.jpg">
						<p>
							Posted by Alex Bright
						</p>
						<p>
							<strong>Taged</strong>
							<div class="tags">
								<a class="label">corgma</a>
								<a class="label">exam</a>
							</div>
						</p>
						<p>
							<strong>Posted</strong>
							<time datetime="2012-05-22">May 22 2012 at 13:35</time>
						</p>
						<h3>Related Posts</h3>
					</aside>
				</div> -->
	</div>

	<footer>
		<div class="container">
			<p>Lovingly crafted by <a href="#"><span class="xteam-tiny">XTeamSquishy</span></a>. Some rights reserved.</p>
			<p><a href="#">Copyright notice</a> | <a href="#">Privacy policy</a> | <a href="#">About the project</a> | <a href="#">Contribute</a></p>
		</div>
	</footer>
</body>
</html>