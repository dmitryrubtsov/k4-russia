{if $FLAGS.ListingTab eq $TRUE}
{if $Field.inListWzTooltip}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.inListWzTooltipSmartyMods assign="fldValue"}
<span onmouseover="return escape('{eval|unescape:'addslashes' var=$fldValue|unescape}');">
{/if}
{/if}
{eval var=$Field.value|unescape}{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField && $FLAGS.ListingTab neq $TRUE}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}
{if $FLAGS.ListingTab eq $TRUE && $Field.inListWzTooltip}
</span>
{/if}