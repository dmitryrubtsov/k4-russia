{apply_smarty_mods varname="Field.value" mod_arr=$Field.SmartyMods assign="fieldValue"}
<input class="{if $Field.className eq ''}inp_inpt{else}{$Field.className}{/if}" type="text" name="{$Field.name}" value="{eval var=$fieldValue|unescape}"{if $Field.id neq ''} id="{$Field.id}"{/if}{if $Field.size neq ''} size="{$Field.size}"{/if}{if $Field.maxlength neq ''} maxlength="{$Field.maxlength}"{/if}{if $Field.other neq ''} {$Field.other|unescape}{/if}
{if $Field.makeSameValue neq ''}
	onchange="document.forms['{$Config.AddFormName}'].{$Field.makeSameValue}.value={if $Field.makeSameValueFunc neq ''}{$Field.makeSameValueFunc|unescape}{else}this.value.toLowerCase(){/if};"
	onkeyup="document.forms['{$Config.AddFormName}'].{$Field.makeSameValue}.value={if $Field.makeSameValueFunc neq ''}{$Field.makeSameValueFunc|unescape}{else}this.value.toLowerCase(){/if};"
	onclick="document.forms['{$Config.AddFormName}'].{$Field.makeSameValue}.value={if $Field.makeSameValueFunc neq ''}{$Field.makeSameValueFunc|unescape}{else}this.value.toLowerCase(){/if};"

	{*
	onchange="makeLinkName();"
	onkeyup="makeLinkName();"
	onclick="makeLinkName();"
	*}
{/if} />
{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}
