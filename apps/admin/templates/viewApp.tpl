{extends file="base.tpl"}
{block name=title}Dashboard - {$app->name}{/block}
{block name=body}
<h1>{$appname}</h1>
<hr/>
<div class="alert alert-block alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Application Dashboard</h4>
	<p>This page gives an overview of this application's models and configuration.</p>
</div>
<h2>Models</h2>
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Model name</th>
			<th>Records</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		{foreach $models as $model}
		<tr>
			<td>{$model.class}</td>
			<td>0</td>
			<td>Manage</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{/block}