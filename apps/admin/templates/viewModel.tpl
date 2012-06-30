{extends file="base.tpl"}
{block name=title}{$model|pluralize|capitalize} - {$app->name}{/block}
{block name=body}
<h1>{$modelname|pluralize|capitalize} <small>{$count} Records</small></h1>
<hr/>
<div class="alert alert-block alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Model View</h4>
	<p>This page gives an overview of this model and its records.</p>
</div>
<h2>Records</h2>
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			{foreach $hrcolumns as $column}
			<th>{$column}</th>
			{/foreach}
		</tr>
	</thead>
	<tbody>
		{foreach $data as $record}
		<tr>
			{foreach $columns as $column}
			<td>{$record->$column}</td>
			{/foreach}
		</tr>
		{/foreach}
	</tbody>
</table>
<p><a href="{$root}/{$app->namespace|lower}/{$model|lower}/insert">Insert Record</a></p>
{/block}