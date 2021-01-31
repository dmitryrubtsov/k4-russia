
<script type="text/javascript" src="{$Config.FCKEditorPath}fckeditor.js"></script>
<script type="text/javascript" src="{$Config.FileBrowserPath}ckfinder.js"></script>
<script language="javascript">
function {$Field.name}LoadEditor()
{ldelim}
	var BasePath = '{$Config.FCKEditorPath}';
	var oFCKeditor = new FCKeditor( '{$Field.name}' ) ;
	oFCKeditor.BasePath	= BasePath ;
	var SkinPath = BasePath + 'editor/skins/silver/';
    oFCKeditor.Config['SkinPath'] = SkinPath ;
	oFCKeditor.Height	= {if $Field.height != ''}{$Field.height}{else}400{/if} ;
    oFCKeditor.Width	= {if $Field.width != ''}{$Field.width}{else}650{/if} ;
    {if $Field.toolbar != ''}oFCKeditor.ToolbarSet	= '{$Field.toolbar}' ;{/if}
    {*CKFinder.SetupFCKeditor( oFCKeditor, '{$Config.FileBrowserPath}' ) ;*}
    oFCKeditor.ReplaceTextarea() ;
    document.getElementById('{$Field.name}LoadEditor').innerHTML='';
{rdelim}
</script>
<div id="{$Field.name}LoadEditor"><input type="button" value="{$lang.admin.loadEditor}" onclick="{$Field.name}LoadEditor();return false;" /></div>
{include file="admin.field_textarea.tpl" Field=$Field}
{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}