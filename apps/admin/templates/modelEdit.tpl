{extends file="base.tpl"}

{block name=title}Edit - {$model|pluralize|capitalize} - {$app->name}{/block}

{block name=final}
{literal}
<script src="/static/jquery/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#edit').button();
	$("#edit").click(function(event) {
		$("#edit").button('loading');
	});
	$('#editform').ajaxForm({
		clearForm: true,
		beforeSubmit: function() { $("#edit").button('loading'); },
		success: function(data, status, jqxhr) {
			$("#successalert").fadeIn();
			$("#edit").button('reset');
		},
		error: function(jqxhr, status, error) {
			$("#errormsg").text(error);
			$("#erroralert").fadeIn();
			$("#edit").button('reset');
		}});
});
</script>
{/literal}
{/block}

{block name=body}
<h1>Edit {$modelname|pluralize|capitalize}</h1>
<hr/>
<div class="alert alert-block alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Editing Model Data</h4>
	<p>On this page you can edit a record's data and save it back into the database.</p>
	<p><a href="https://github.com/tcsavage/pangolin/wiki/Introduction-to-the-framework/" class="btn btn-info"><i class="icon-book icon-white"></i> Learn more</a></p>
</div>
<div class="alert alert-block alert-success fade in" id="successalert" style="display:none">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Successfully Edited Record</h4>
	<p><a href="{$root}/{$app->namespace}/{$model}" class="btn"><i class="icon-list-alt"></i> Go back</a></p>
</div>
<div class="alert alert-block alert-error fade in" id="erroralert" style="display:none">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Edit Failed</h4>
	<p><span id="errormsg"></span></p>
</div>
<div class="row-fluid">
	<div class="span8">
		<form class="form-horizontal" method="post" action="{$root}/{$app->namespace}/{$model}/edit/do" id="editform">
			<input type="hidden" name="id" value="{$data->id}" />
			<fieldset>
				<legend>Edit {$modelname}</legend>
				{foreach $data->getProperties() as $column => $md}
				{if $column != "id"}
				<div class="control-group">
					<label class="control-label" for="{$md->name}">{$md->prettyname}</label>
					<div class="controls">
						{$md->renderInput()}
						{if $md->helptext}<p class="help-block">{$md->helptext}</p>{/if}
					</div>
				</div>
				{/if}
				{/foreach}
				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="edit" data-loading-text="editing">Edit</button>
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