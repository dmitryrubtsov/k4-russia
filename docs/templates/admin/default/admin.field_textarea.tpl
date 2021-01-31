{if $FLAGS.ListingTab eq $TRUE}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.inListSmartyMods assign="fieldValue"}
{else}
{apply_smarty_mods varname="Field.value" mod_arr=$Field.SmartyMods assign="fieldValue"}
{/if}
<textarea class="{if $Field.className eq ''}inp_txtarea{else}{$Field.className}{/if}" name="{$Field.name}"{if $Field.id neq ''} id="{$Field.id}"{/if}{if $Field.maxlength neq ''} maxlength="{$Field.maxlength}"{/if}{if $Field.cols neq ''} cols="{$Field.cols}"{/if}{if $Field.rows neq ''} rows="{$Field.rows}"{/if}{if $Field.other neq ''}{$Field.other|unescape}{/if}>{eval var=$fieldValue|unescape}</textarea>{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}