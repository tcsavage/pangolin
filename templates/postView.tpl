{extends file="uopbase.tpl"}

{block name="title"}{$post->user->name} - {$post->content|shrink:15}...{/block}

{block name="main"}<article class="span8">
						<div class="username">
							<h1><a href="#">{$post->user->name}</a></h1>
							<div class="userbox">
								<img src="tempimg/y.jpg" class="profilepic-large">
								<div class="userbox-detail">
									<h3>{$post->user->name}</h3>
									<span class="label">Year 1 Computing</span>
								</div>
							</div>
						</div>`
						<div>
							<p>{$post->body}</p>
							<small>Posted {$post->date}. {$commentCount} comments <a href="/post/{$post->id}">Permalink</a></small>
						</div>
						<hr>
						<div class="comments"><a name="comments"></a>
							{foreach $post->comments as $comment}
							<div class="comment">
								<div class="number">{$comment->id}</div>
								<img src="tempimg/x.jpg" class="profilepic">
								<h3>{$comment->user->name}</h3>
								<div class="content">
									<p>{$comment->body}</p>
								</div>
							</div>
							{/foreach}
						</div>
						<hr>
						<form>
							<textarea></textarea>
							<input type="submit" value="Submit">
						</form>
					</article>{/block}

{block name="sidebar"}
					<aside class="span4">
						<img src="tempimg/x.jpg">
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
							{$post->date}
							<!-- <time datetime="2012-05-22">May 22 2012 at 13:35</time> -->
						</p>
						<h3>Related Posts</h3>
					</aside>{/block}