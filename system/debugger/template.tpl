{capture name='_smarty_debug' assign=debug_output}
<!DOCTYPE html>
<html>
<head>
<title>Smarty Debug Console</title>
<link rel="stylesheet" type="text/css" href="/static/core/css/debugbar.css"/>
<style type="text/css">
{literal}
body, h1, h2, td, th, p {
		font-family: Arial, sans-serif;
		font-weight: normal;
		font-size: 0.9em;
		padding: 0;
		margin: 0;
		color: #eeeeee;
}

h1 {
		margin: 0;
		text-align: left;
		padding: 2px;
		color:  #fff;
		font-weight: bold;
		font-size: 1.2em;
 }

h2 {
		background-color: #222222;
		color: white;
		text-align: left;
		font-weight: bold;
		padding: 2px;
}

body {
		background-color: #111111;
		padding-bottom: 30px;
}

p, table, div {
		/*background: #f0ead8;*/
} 

p {
		margin: 0;
		font-style: italic;
}

table {
		width: 100%;
}

th, td {
		font-family: monospace;
		vertical-align: top;
		text-align: left;
		width: 50%;
		padding: 2px;
}

td {
		color: #eeeeee;
}

.odd {
		background-color: #111111;
}

.even {
		background-color: #151515;
}

.exectime {
		font-size: 0.8em;
		font-style: italic;
}

#table_assigned_vars th {
		color: #0096bc;
}

#table_config_vars th {
		color: #0096bc;
}
{/literal}
</style>
<script src="/static/jquery/jquery-1.7.2.min.js"></script>
</head>
<body>
<div id="debugbar">
	<span class="main"><a href="#">Debugger</a></span>
	<ul>
		<li class="current" id="smarty-btn"><a href="#">Smarty</a></li>
		<li id="queries-btn"><a href="#">Queries</a></li>
	</ul>
</div>
<div id="smarty" class="page">
<h1>Smarty Debug Console  -  {if isset($template_name)}{$template_name|debug_print_var nofilter}{else}Total Time {$execution_time|string_format:"%.5f"}{/if}</h1>

{if !empty($template_data)}
<h2>included templates &amp; config files (load time in seconds)</h2>

<div>
{foreach $template_data as $template}
	{$template.name}
	<span class="exectime">
	 (compile {$template['compile_time']|string_format:"%.5f"}) (render {$template['render_time']|string_format:"%.5f"}) (cache {$template['cache_time']|string_format:"%.5f"})
	</span>
	<br>
{/foreach}
</div>
{/if}

<h2>assigned template variables</h2>

<table id="table_assigned_vars">
		{foreach $assigned_vars as $vars}
			 <tr class="{if $vars@iteration % 2 eq 0}odd{else}even{/if}">   
			 <th>${$vars@key|escape:'html'}</th>
			 <td>{$vars|debug_print_var nofilter}</td></tr>
		{/foreach}
</table>

<h2>assigned config file variables (outer template scope)</h2>

<table id="table_config_vars">
		{foreach $config_vars as $vars}
			 <tr class="{if $vars@iteration % 2 eq 0}odd{else}even{/if}">   
			 <th>{$vars@key|escape:'html'}</th>
			 <td>{$vars|debug_print_var nofilter}</td></tr>
		{/foreach}

</table>
</div>
<div id="queries" class="page" style="display:none">
	{getqueries}
	<h1>SQL Queries ({$queries|@count})</h1>
	{if $queries}
		{foreach $queries as $q}
			<h2>{$q.query}</h2>
			{foreach $q.backtrace as $b}
				<p>
					<strong>{$b.function}</strong> {if $b.line}{$b.line}{/if}
					{if $b.file}<br/>{$b.file}{/if}
				</p>
			{/foreach}
		{/foreach}
	{else}
		No queries
	{/if}
</div>
<script type="text/javascript">
$('#smarty-btn').click(function() {
	$('.current').removeClass('current');
	$('.page').hide();
	$('#smarty').show();
	$(this).addClass('current');
});

$('#queries-btn').click(function() {
	$('.current').removeClass('current');
	$('.page').hide();
	$('#queries').show();
	$(this).addClass('current');
});
</script>
</body>
</html>
{/capture}
<script type="text/javascript">
{$id = $template_name|default:''|md5}
		_smarty_console = window.open("","console{$id}","width=680,height=600,resizable,scrollbars=yes");
		_smarty_console.document.write("{$debug_output|escape:'javascript' nofilter}");
		_smarty_console.document.close();
</script>
