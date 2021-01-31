{if $Field.listToField eq 'y' || $Field.listOfRelations eq 'y'}
	<script language="javascript">
		function openWindow{$Field.name}()
		{ldelim}
 			myWin=open("{if $Field.openLink neq ''}{$Field.openLink|unescape}{else}index.php?{foreach from=$Field.openLinkParams item='value' key='key'}{$key}={$value|unescape}&{/foreach}{/if}", "joinlist{$Field.name}","width={if $Field.width neq ''}{$Field.width}{else}350{/if},height={if $Field.height neq ''}{$Field.height}{else}350{/if},status=no,toolbar=no,menubar=no,scrollbars=yes");
 			myWin.focus();
		{rdelim}
		function setBlank{$Field.name}()
		{ldelim}
			document.getElementById('{$Field.id}').value='';
			document.getElementById('{$Field.id}-list').innerHTML='{$lang.admin.noValues}';
		{rdelim}
	</script>
{/if}

{apply_smarty_mods varname="Field.value" mod_arr=$Field.SmartyMods assign="fieldValue"}
{if $Field.listToField eq 'y' || $Field.listOfRelations eq 'y'}
	&nbsp;&nbsp;
	<a href="#" onclick="openWindow{$Field.name}();return false;">
		<img src="{$HOST}/images/admin/edit_ico.gif" border="0" align="absmiddle" alt="{$lang.admin.edit}" title="{$lang.admin.edit}" onclick="this.blur();" />
	</a>
{/if}
<br />
<span id="{$Field.id}-list" onclick="openWindow{$Field.name}();">
	{foreach from=$Field.listValues item="curr" key="key"}
		{$curr|unescape}<br />
	{/foreach}
</span>
{if $Field.textUnderField}
	<br />
	<sup>{$Field.textUnderField|unescape}</sup>
{/if}
{if $Field.listToField eq 'y'}
	<input type="hidden" name="{$Field.name}" id="{$Field.id}" value="{$Field.value}" />
{elseif $Field.listOfRelations eq 'y'}
	<input type="hidden" name="{$Field.name}" id="{$Field.id}" value="{foreach from=$Field.listValues item="curr" key="key" name="listarr"}{if $smarty.foreach.listarr.first neq true},{/if}{$key}{/foreach}" />
{/if}