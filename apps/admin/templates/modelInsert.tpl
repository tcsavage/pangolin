{extends file="base.tpl"}

{block name=title}Insert - {$model|pluralize|capitalize} - {$app->name}{/block}

{block name=final}
{literal}
<script src="/static/jquery/jquery.form.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#insert').button();
	$("#insert").click(function(event) {
		$("#insert").button('loading');
	});
	$('#insertform').ajaxForm({
		target: "#newrecordid",
		clearForm: true,
		beforeSubmit: function() { $("#insert").button('loading'); },
		success: function(data, status, jqxhr) {
			$("#successalert").fadeIn();
			$("#insert").button('reset');
		},
		error: function(jqxhr, status, error) {
			$("#errormsg").text(error);
			$("#erroralert").fadeIn();
			$("#insert").button('reset');
		}});
});
</script>
{/literal}
{/block}

{block name=body}
<h1>Insert Into {$modelname|pluralize|capitalize}</h1>
<hr/>
<div class="alert alert-block alert-info fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Inserting Into Models</h4>
	<p>Here you can create a new record and save it into your data model. Each new record will be given a unique ID and will be displayed below when created.</p>
	<p><a href="https://github.com/tcsavage/pangolin/wiki/Introduction-to-the-framework/" class="btn btn-info"><i class="icon-book icon-white"></i> Learn more</a></p>
</div>
<div class="alert alert-block alert-success fade in" id="successalert" style="display:none">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Successfully Inserted Record</h4>
	<p>Created new record in {$modelname}. ID: <span id="newrecordid"></span>.</p>
</div>
<div class="alert alert-block alert-error fade in" id="erroralert" style="display:none">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Insert Failed</h4>
	<p><span id="errormsg"></span></p>
</div>
<div class="row-fluid">
	<div class="span8">
		<form class="form-horizontal" method="post" action="insert/do" id="insertform" enctype="multipart/form-data">
			<fieldset>
				<legend>New {$modelname}</legend>
				{foreach $columns as $column => $md}
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
					<button type="submit" class="btn btn-primary" id="insert" data-loading-text="inserting">Insert</button>
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