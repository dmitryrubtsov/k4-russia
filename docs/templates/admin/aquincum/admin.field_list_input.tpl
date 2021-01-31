{if $FLAGS.ListingTab eq $TRUE}
	{apply_smarty_mods varname="Field.value" mod_arr=$Field.inListSmartyMods assign="fieldValue"}
{/if}
<input type="text" name="{$Field.name}[{$Item.$WorkTableKeyFieldName}]" value="{eval var=$fieldValue|unescape}"{if $Field.id neq ''} id="{$Field.id}{$Item.$WorkTableKeyFieldName}"{/if}{if $Field.size neq ''} size="{$Field.size}"{/if}{if $Field.maxlength neq ''} maxlength="{$Field.maxlength}"{/if}{if $Field.other neq ''}{$Field.other|unescape}{/if} onChange="itemCheck('item{$Item.$WorkTableKeyFieldName}');" onKeyUp="itemCheck('item{$Item.$WorkTableKeyFieldName}');" />
{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}