{if $FLAGS.ListingTab eq $TRUE}
{if $Field.inListWzTooltip}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.inListWzTooltipSmartyMods assign="fldValue"}
<span onmouseover="return escape('{eval|unescape:'addslashes' var=$fldValue|unescape}');">
{/if}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.inListSmartyMods assign="fieldValue"}
{else}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.SmartyMods assign="fieldValue"}
{/if}
{if $Field.isLink eq 'y'}<a href="{if $Field.linkURL eq ''}{$Field.value|unescape}{else}{$Field.linkURL|unescape}{/if}"{if $Field.className neq ''} class="{$Field.className}"{/if} target="{$Field.linkTarget}">
{elseif $Field.className neq ''}<span class="{$Field.className}">
{/if}
{eval var=$fieldValue|unescape}
{if $Field.isLink eq 'y'}</a>
{elseif $Field.className neq ''}</span>
{/if}
{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField && $FLAGS.ListingTab neq $TRUE}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}
{if $FLAGS.ListingTab eq $TRUE && $Field.inListWzTooltip}
</span>
{/if}