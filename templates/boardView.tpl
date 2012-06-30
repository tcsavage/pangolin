{extends file="uopbase.tpl"}

{block name="title"}UoP Computing{/block}

{block name="main"}<article class="span8">
						<h1><span>Board Posts &raquo;</span> All</h1>
						<div class="posts">
							<div class="post alert">
								<h3>Announcement</h3>
								<p>Some stuff.</p>
							</div>
							{foreach $data as $post}
							<div class="post">
								<img src="tempimg/y.jpg" class="profilepic">
								<div class="username">
									<h3><a href="#">{$post->user->name}</a></h3>
									<div class="userbox">
										<img src="tempimg/y.jpg" class="profilepic-large">
										<div class="userbox-detail">
											<h3>{$post->user->name}</h3>
											<span class="label">Year 1 Computing</span>
										</div>
									</div>
								</div>
								<div class="content">
									{$post->body}
								</div>
								<small>{$post->date} | <a href="#">31 comments</a> | <a href="#">Permalink</a></small>
								<small><a class="label">corgma</a> <a class="label">exam</a></small>
							</div>
							{/foreach}
						</div>
					</article>{/block}

{block name="crap"}{/block}