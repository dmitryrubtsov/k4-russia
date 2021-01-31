
<script language="javascript">
var {$Field.name}FBWin = null;
var {$Field.name}SetFileUrl = function(url)
{ldelim}
$({$Field.name}).val(url);
{$Field.name}FBWin.close();
{rdelim}
function {$Field.name}ShowFileManager()
{ldelim}
{$Field.name}FBWin = window.open('{$Config.FileManagerPath}?__rBd_=/&_rBd_={$smarty.const.__CFG_SESSION_HANDLE}&_r8b__=wcrfw3&_r8b_=&_r8d_={$SID}&_rBb__={$Field.name}SetFileUrl','FileBrowser{$FieldName}','width=800,height=540');
{rdelim}
</script>
{include file="admin.field_input.tpl" Field=$Field}
&nbsp;<input type="button" value="{$lang.admin.fileManager}" onclick="{$Field.name}ShowFileManager();" />
&nbsp;<input type="button" value="{$lang.admin.filePreviewButton}" onclick="window.open('{$HOST}'+$({$Field.name}).val(),$({$Field.name}).val())" />