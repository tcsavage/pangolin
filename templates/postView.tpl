{extends file="uopbase.tpl"}

{block name="title"}{$post->user->name} - {$minipost}{/block}

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
						</div>
						<div>
							<p>{$post->body}</p>
							<small>Posted {$post->date}. <a href="#">Permalink</a></small>
						</div>
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