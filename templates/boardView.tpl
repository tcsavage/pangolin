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
											<h3>Alex Bright</h3>
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