{extends file="base.tpl"}

{block name=title}Insert - {$model|pluralize|capitalize} - {$app->name}{/block}

{block name=final}
{literal}
<script type="text/javascript">
$("#insert").click(function(event) {
	event.preventDefault();
	var newRecord = new Object();
	{/literal}
	{foreach $columns as $column => $md}
	newRecord.{$md->name} = $("#{$md->name}").val();
	{/foreach}
	{literal}
	$.ajax({
		url: {/literal}"{$root}/{$app->namespace|lower}/{$model|lower}/ajaxinsert"{literal},
		timeout: 2000,
		type: "POST",
		data: "record="+(JSON.stringify(newRecord)),
		success: function(data, status, jqxhr) {
			$("#newrecordid").text("5");
			$("#successalert").fadeIn();
		},
		error: function(jqxhr, status, error) {
			$("#errormsg").text(error);
			$("#erroralert").fadeIn();
		}
	});
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
	<p>This page gives an overview of this model and its records.</p>
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
		<form class="form-horizontal" method="post" action"#" id="insertform">
			<fieldset>
				<legend>New {$modelname}</legend>
				{foreach $columns as $column => $md}
				<div class="control-group">
					<label class="control-label" for="{$md->name}">{$md->prettyname}</label>
					<div class="controls">
						{$md->renderInput()}
						{if $md->helptext}<p class="help-block">{$md->helptext}</p>{/if}
					</div>
				</div>
				{/foreach}
				<div class="form-actions">
					<button type="submit" class="btn btn-primary" id="insert">Insert</button>
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