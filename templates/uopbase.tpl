<!DOCTYPE html>
<html>
<head>
	<title>{block name=title}{/block}</title>
	<link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/uop/css/main.css">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
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
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i> tcsavage
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="#">Sign Out</a></li>
					</ul>
				</div>
				<div class="btn-group pull-right">
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i> Login / Register
					</a>
				</div>
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
		<div class="container">
			<p><a href="#"><strong>Tom Savage posted -</strong> In case anyone got feedback when they submitted their...</a></p>
			<p><a href="#"><strong>Tom Savage commented -</strong> Probably a lmgtfy link.</a></p>
		</div>
	</header>

	<div class="container">
		<div class="row">
					{block name=main}<article class="span8">
						<h1><span>Board Posts &raquo;</span> All</h1>
						<div class="posts">
							<div class="post alert">
								<h3>Announcement</h3>
								<p>Some stuff.</p>
							</div>
							<div class="post">
								<img src="tempimg/y.jpg" class="profilepic">
								<div class="username">
									<h3><a href="#">Alex Bright</a></h3>
									<div class="userbox">
										<img src="tempimg/y.jpg" class="profilepic-large">
										<div class="userbox-detail">
											<h3>Alex Bright</h3>
											<span class="label">Year 1 Computing</span>
										</div>
									</div>
								</div>
								<div class="content">
									<p>In case anyone got feedback when they submitted their exams, I have spoken to Ann, and this feedback has no relation to the marks you got on your exam. This feedback is related to how well the program worked, and is only meant to be displayed to the program creator, and should therefore not have come up. Also, our marks should be available in about 2 weeks, but Ann hopes to get them to us sooner.</p>
								</div>
								<small>Posted May 22 2012 at 13:35 | <a href="#">31 comments</a> | <a href="#">Permalink</a></small>
								<small><a class="label">corgma</a> <a class="label">exam</a></small>
							</div>
		
							<div class="post">
								<img src="tempimg/z.jpg" class="profilepic">
								<div class="username">
									<h3><a href="#">Tom Savage</a></h3>
									<div class="userbox">
										<img src="tempimg/z.jpg" class="profilepic-large">
										<div class="userbox-detail">
											<h3>Tom Savage</h3>
											<span class="label">Year 2 Computer Science</span>
											<span class="label label-info">Developer</span>
											<span class="label label-important">Admin</span>
										</div>
									</div>
								</div>
								<div class="content">
									<p>Something about type-level programming in Haskell with Template Haskell.</p>
									<p>Compile-time generation of code is badass.</p>
								</div>
								<small>Posted May 22 2012 at 13:35 | <a href="#">31 comments</a> | <a href="#">Permalink</a></small>
								<small><a class="label">haskell</a> <a class="label">template-haskell</a> <a class="label">procap</a> <a class="label">computer-science</a> <a class="label">type-level-programming</a></small>
							</div>
						</div>
					</article>{/block}
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
				<hr>
				<div class="row">
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
				</div>
	</div>

	<footer>
		<div class="container">
			<p>Built by <a href="#"><span class="xteam-tiny">XTeamSquishy</span></a>. Some rights reserved.</p>
			<p><a href="#">Copyright notice</a> | <a href="#">Privacy policy</a> | <a href="#">About the project</a> | <a href="#">Contribute</a></p>
		</div>
	</footer>

	<script src="jquery/jquery-1.7.2.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>