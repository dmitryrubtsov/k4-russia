<label>
	<input class="{if $Field.className eq ''}inp_inpt{else}{$Field.className}{/if}" type="checkbox" name="{$Field.name}" value="{$Field.checkedValue}"
	{if $Field.id neq ''} id="{$Field.id}"{/if}
	{if $Field.other neq ''} {$Field.other|unescape}{/if}
	{if $Field.checked neq '' && $Field.checked neq 'n' || $Field.value eq $Field.checkedValue} checked{/if} />{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}
</label>