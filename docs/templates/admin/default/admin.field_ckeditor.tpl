
<script type="text/javascript" src="{$Config.FCKEditorPath}ckeditor.js"></script>
<script id="headscript" type="text/javascript">
	//<![CDATA[

var {$Field.name}editor;
function {$Field.name}createEditor()
{ldelim}
	if ( {$Field.name}editor )
		return;

	var html = document.getElementById( '{$Field.name}' ).value;
	var {$Field.name}editor = CKEDITOR.replace( '{$Field.name}' );
	{$Field.name}editor.setData( html );
	document.getElementById( '{$Field.name}contents' ).style.display = 'none';
	CKFinder.SetupCKEditor( {$Field.name}editor ) ;

{rdelim}

function {$Field.name}removeEditor()
{ldelim}
	if ( !{$Field.name}editor )
		return;

	document.getElementById( '{$Field.name}' ).value = {$Field.name}editor.getData();
	document.getElementById( '{$Field.name}contents' ).style.display = '';

	{$Field.name}editor.destroy();
	{$Field.name}editor = null;
{rdelim}

	//]]>
	</script>
<div>
<input onclick="{$Field.name}createEditor();" type="button" value="{$lang.admin.loadEditor}"/>&nbsp;&nbsp;
<input onclick="{$Field.name}removeEditor();" type="button" value="{$lang.admin.removeEditor}"/>
</div>
<div id="{$Field.name}contents">
{include file="admin.field_textarea.tpl" Field=$Field}
{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}
</div>
<div id="{$Field.name}editor"></div>
