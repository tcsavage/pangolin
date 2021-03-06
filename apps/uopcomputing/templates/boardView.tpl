{extends file="uopbase.tpl"}

{block name="title"}UoP Computing{/block}

{block name="main"}<article class="span8">
						<h1><span>Board Posts &raquo;</span> All</h1>
						<div class="posts">
							{foreach $announcements as $alert}
							<div class="post alert">
								<h3>{$alert->title}</h3>
								<p>{$alert->body}</p>
							</div>
							{/foreach}
							{foreach $data as $post}
							{if $post->user->banned != 1 || $post->approved}
							<div class="post">
								<img src="/upload/{$post->user->profilePic}" class="profilepic">
								<div class="username">
									<h3><a href="#">{$post->user->name}</a></h3>
									<div class="userbox">
										<img src="/upload/{$post->user->profilePic}" class="profilepic-large">
										<div class="userbox-detail">
											<h3>{$post->user->name}</h3>
											<span class="label">{$post->user->flair}</span>
										</div>
									</div>
								</div>
								<div class="content">
									{$post->body}
								</div>
								<small>{$post->date|date_format:"%d/%m/%Y"} | <a href="/post/{$post->id}#comments">{$post->comments->size()} Comments</a> | <a href="/post/{$post->id}">Permalink</a></small>
								<small><a class="label">corgma</a> <a class="label">exam</a></small>
							</div>
							{else}
							{/if}
							{/foreach}
						</div>
					</article>{/block}

{block name="crap"}{/block}