{extends file="base.tpl"}
{block name=title}Insert - {$model|pluralize|capitalize} - {$app->name}{/block}
{block name=body}
<h1>Insert Into {$modelname|pluralize|capitalize}</h1>
<hr/>
<div class="alert alert-block alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Inserting Into Models</h4>
	<p>This page gives an overview of this model and its records.</p>
</div>
<div class="row-fluid">
	<div class="span8">
		<form class="form-horizontal">
			<fieldset>
				<legend>New {$modelname}</legend>
				{foreach $columns as $column => $md}
				<div class="control-group">
					<label class="control-label" for="{$md->name}">{$md->name}</label>
					<div class="controls">
						{$md->renderInput()}
						{if $md->helptext}<p class="help-block">{$md->helptext}</p>{/if}
					</div>
				</div>
				{/foreach}
				<div class="form-actions">
					<button type="submit" class="btn btn-primary">Sumbit</button>
					<a href="{$root}/{$app->namespace}/{$model}" class="btn">Cancel</a>
				</div>
			</fieldset>
		</form>
	</div>
	<div class="span4">
		<h3>Record fields</h3>
		<p>Testing</p>
	</div>
</div>
{/block}