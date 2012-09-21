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
		<form class="form-horizontal" method="post" action="/login/do">
			<fieldset>
				<legend>Login or Register</legend>
				<div class="control-group">
					<label class="control-label" for="email">Email address</label>
					<div class="controls">
						<input type="email" name="email" required placeholder="jsmith@example.com" autocomplete="off"/>
					</div>
				</div>

				<div class="control-group">
					<label class="control-label" for="password">Password</label>
					<div class="controls">
						<input type="password" name="password" required placeholder="********" autocomplete="off"/>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="login">Go!</button>
				</div>
			</fieldset>
		</form>
	</article>
{/block}

{block name="sidebar"}
	<article class="span4">
		<h3>With an account you can:</h3>
		<ul>
			<li>Submit new posts</li>
			<li>Comment on posts</li>
			<li>Promote comments</li>
			<li>Subscribe to tags you're interested in</li>
		</ul>
	</article>
{/block}