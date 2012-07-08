<!DOCTYPE html>
<html>
<head>
	<title>Login - {$pangolin.projectname} Admin Panel</title>
	<link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
	<style type="text/css">
	.row-fluid
	{
		margin-top: 10%;
		margin-left: auto;
		margin-right: auto;
		width: 400px;
		background: #fff;
		-webkit-border-radius: 5px;
		border-radius: 5px;
		-webkit-box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.8);
		box-shadow: 0px 3px 15px 0px rgba(0, 0, 0, 0.5);
		padding: 10px;
	}
	</style>
</head>
<body>
<div class="row-fluid">
	<div class="span12">
		{if $status == "failed"}
		<div class="alert alert-block alert-error fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<h4 class="alert-heading">Login Failed</h4>
			<p><span id="errormsg"></span></p>
		</div>
		{elseif $status == "loggedout"}
			<div class="alert alert-block alert-success fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<h4 class="alert-heading">You have logged out</h4>
			<p><span id="errormsg"></span></p>
		</div>
		{elseif $status == "required"}
			<div class="alert alert-block alert-info fade in">
			<a class="close" data-dismiss="alert">&times;</a>
			<h4 class="alert-heading">You are required to login</h4>
			<p><span id="errormsg"></span></p>
		</div>
		{/if}
		<form class="form-horizontal" method="post" action="/admin/login/do">
			<fieldset>
				<legend>{$pangolin.projectname} Admin Panel Login</legend>
				<div class="control-group">
					<label class="control-label" for="username">Username</label>
					<div class="controls">
						<input type="text" name="username" required placeholder="johnsmith"/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<input type="password" name="password" required placeholder="********"/>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="login">Login</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>
</body>
</html>