<script language="javascript">
	function {$Field.name}LoadEditor(flag)
	{ldelim}
		CKEDITOR.replace( '{$Field.name}',
		{ldelim}
			language : "{$smarty.const.__LANG}",


			filebrowserWindowHeight:'540',
			filebrowserBrowseUrl: '{$Config.FileManagerPath}?__rBd_=/&_rBd_={$smarty.const.__CFG_SESSION_HANDLE}&_r8b__=wcrfw3&_r8b_=&_r8d_={$SID}&_rBb__=none',
			filebrowserImageBrowseUrl: '{$Config.FileManagerPath}?__rBd_=/&_rBd_={$smarty.const.__CFG_SESSION_HANDLE}&_r8b__=wcrfw3&_r8b_=image&_r8d_={$SID}&_rBb__=none',
			filebrowserFlashBrowseUrl: '{$Config.FileManagerPath}?__rBd_=/&_rBd_={$smarty.const.__CFG_SESSION_HANDLE}&_r8b__=wcrfw3&_r8b_=flash&_r8d_={$SID}&_rBb__=none'
		{rdelim});
		if(flag)
		{ldelim}
			document.getElementById('{$Field.name}LoadEditor').innerHTML='';
		{rdelim}
	{rdelim}
</script>
{if $Field.buttonReplace eq 'y'}
	<div id="{$Field.name}LoadEditor">
		<input type="button" value="{$lang.admin.loadEditor}" onclick="{$Field.name}LoadEditor(true);return false;" />
	</div>
{/if}
{include file="admin.field_textarea.tpl" Field=$Field}
{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}

{if $Field.buttonReplace neq 'y'}
	<script language="javascript">
		{$Field.name}LoadEditor(false);
	</script>
{/if}