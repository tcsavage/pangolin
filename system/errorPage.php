<?php namespace pangolin;

// Render an error page.
// Doesn't use Smarty because we want to keep this as light as possible.
function render_error_page(Exception $e)
{
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Error - <?=$e->getMessage()?></title>
	<link rel="stylesheet" type="text/css" href="/static/bootstrap/css/bootstrap.min.css">
	<style type="text/css">
	h1, h2, p, pre { font-weight: normal; padding: 10px; }
	h1 { background: #eeeeaa url('/error_page_stripe.png'); }
	footer { padding: 10px; font-weight: bolder; text-transform: uppercase; font-size: 10pt; color: #999; }
	</style>
	<script src="/static/jquery/jquery-1.7.2.min.js"></script>
	<script src="/static/bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript">$(".accordion").collapse()</script>
</head>
<body>
	<h1>Error: <?=$e->getMessage()?></h1>
	<p>
		<strong>File:</strong> <?=$e->getFile()?><br/>
		<strong>Line:</strong> <?=$e->getLine()?><br/>
		<strong>Code:</strong> <?=$e->getCode()?><br/>
	</p>
	<div class="accordion" id="accordion">
		<div class="accordion-group">
			<h2 class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#collapseOne">
				Queries
			</a></h2>
			<div id="collapseOne" class="accordion-body collapse in">
				<div class="accordion-inner">
					<?php if(Debug::getQueries()): ?>
						<pre><?php print_r(Debug::getQueries()); ?></pre>
					<?php else: ?>
						<p>None</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<h2 class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#collapseTwo">
				Full Exception
			</a></h2>
			<div id="collapseTwo" class="accordion-body collapse">
				<div class="accordion-inner">
					<pre><?php print_r($e);?></pre>
				</div>
			</div>
		</div>
		<div class="accordion-group">
			<h2 class="accordion-heading"><a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#collapseThree">
				Backtrace
			</a></h2>
			<div id="collapseThree" class="accordion-body collapse">
				<div class="accordion-inner">
					<pre><?php print_r($e->getTrace()); ?></pre>
				</div>
			</div>
		</div>
	</div>
	<footer>Pangolin Framework. <?=date("c")?></footer>
</body>
</html>
	<?php
	die();
}