{extends file="uopbase.tpl"}

{block name="title"}Login{/block}

{block name="extraheaders"}
<script type="text/javascript">
</script>
{/block}

{block name="main"}
	<article class="span8">
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
		<ul class="nav nav-tabs" id="loginregtabs">
			<li class="active"><a href="#registerform" data-toggle="tab">Register</a></li>
			<li><a href="#loginform" data-toggle="tab">Login</a></li>
		</ul>
		<div id="loginregtabscontent" class="tab-content">
			<div class="tab-pane fade active in" id="registerform">
				<form class="form-horizontal" method="post" action="/login/do">
					<fieldset>
						<legend>Register</legend>
						<div class="control-group">
							<label class="control-label" for="uopusername">University username</label>
							<div class="controls">
								<input type="text" name="uopusername" required placeholder="cam12345"/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="uoppassword">University password</label>
							<div class="controls">
								<input type="password" name="uoppassword" required placeholder="********"/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="email">Email address</label>
							<div class="controls">
								<input type="email" name="email" required placeholder="jsmith@example.com"/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="password">Password</label>
							<div class="controls">
								<input type="password" name="password" required placeholder="********"/>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="password2">And again</label>
							<div class="controls">
								<input type="password" name="password2" required placeholder="********"/>
							</div>
						</div>
						<div class="form-actions">
							<button type="submit" class="btn btn-primary" id="login">Create Account</button>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="tab-pane fade" id="loginform">
				<form class="form-horizontal" method="post" action="/login/do">
					<fieldset>
						<legend>Login</legend>
						<div class="control-group">
							<label class="control-label" for="email">Email address</label>
							<div class="controls">
								<input type="email" name="email" required placeholder="jsmith@example.com"/>
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
	</article>
{/block}

{block name="sidebar"}
	<article class="span4">
	</article>
{/block}