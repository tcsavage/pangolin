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
</head>
<body>
	<h1>Error: <?=$e->getMessage()?></h1>
	<p>
		<strong>File:</strong> <?=$e->getFile()?><br/>
		<strong>Line:</strong> <?=$e->getLine()?><br/>
		<strong>Code:</strong> <?=$e->getCode()?>
	</p>
	<h2>Backtrace:</h2>
	<pre><?php print_r($e->getTrace()); ?></pre>
	<footer>Pangolin Framework. <?=date("c")?></footer>
</body>
</html>
	<?php
	die();
}