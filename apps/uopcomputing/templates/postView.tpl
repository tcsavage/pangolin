{extends file="uopbase.tpl"}

{block name="title"}{$post->user->name} - {$post->body|shrink:15}{/block}

{block name="extraheaders"}
{literal}
<script src="/static/jquery/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#submitcomment').button();
	$("#submitcomment").click(function(event) {
		$("#submitcomment").button('loading');
	});
	$('#commentform').ajaxForm({
		beforeSubmit: function() { $("#submitcomment").button('loading'); },
		success: function(data, status, jqxhr) {
			txt = '<div class="comment"><div class="number">1</div><img src="/upload/{/literal}{$loggedIn->profilePic}{literal}" style="width:50px;height:50px" class="profilepic"><h3>{/literal}{$loggedIn->name}{literal}</h3>';
			txt = txt + '<div class="content"><p>';
			body = $('#commentbody').val();
			txt = txt + body;
			txt = txt + '</p><small>Posted: now</small></div></div>';
			$(txt).hide().appendTo('#comments').fadeIn();
			$("#submitcomment").button('reset');
			$('#commentform')[0].reset();
		},
		error: function(jqxhr, status, error) {
			$("#errormsg").text(error);
			$("#erroralert").fadeIn();
			$("#submitcomment").button('reset');
		}});
});
</script>
{/literal}
{/block}

{block name="main"}<article class="span8">
						<div class="username">
							<h1><a href="#">{$post->user->name}</a></h1>
							<div class="userbox">
								<img src="/upload/{$post->user->profilePic}" class="profilepic-large">
								<div class="userbox-detail">
									<h3>{$post->user->name}</h3>
									<span class="label">{$post->user->flair}</span>
								</div>
							</div>
						</div>
						<div>
							<p>{$post->body}</p>
							<small>Posted {$post->date|date_format:"%d/%m/%Y"}. {$commentCount} comments <a href="/post/{$post->id}">Permalink</a></small>
						</div>
						<hr>
						<div id="comments" class="comments"><a name="comments"></a>
							{foreach $post->comments as $comment}
							<div class="comment">
								<div class="number">{$comment->karma}</div>
								<img src="/upload/{$comment->user->profilePic}" style="width:50px;height:50px" class="profilepic">
								<h3>{$comment->user->name}</h3>
								<div class="content">
									<p>{$comment->body}</p>
									<small>Posted: {$comment->date|date_format:"%d/%m/%Y"}</small>
								</div>

							</div>
							{/foreach}
						</div>
						<hr>
						<div class="alert alert-block alert-error fade in" id="erroralert" style="display:none">
							<a class="close" data-dismiss="alert">&times;</a>
							<h4 class="alert-heading">Insert Failed</h4>
							<p><span id="errormsg"></span></p>
						</div>
						<form action="/post/{$post->id}/comment" method="POST" id="commentform">
							<textarea style="width:400px" rows="4" cols="150" name="body" id="commentbody"></textarea>
							<input type="submit" value="Comment" id="submitcomment">
						</form>
					</article>{/block}

{block name="sidebar"}
					<aside class="span4">
						<img src="/upload/{$post->user->profilePic}" style="width:100px;height:100px">
						<p>
							Posted by {$post->user->name}
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
							{$post->date|date_format:"%d/%m/%Y"}
							<!-- <time datetime="2012-05-22">May 22 2012 at 13:35</time> -->
						</p>
						<h3>Related Posts</h3>
					</aside>{/block}