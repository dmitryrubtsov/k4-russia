{html_options name=$Field.name options=$Field.values selected=$Field.value id=$Field.id other=$Field.other|unescape}
{if $Field.textAfterField}
	&nbsp;{$Field.textAfterField|unescape}
{/if}
{if $Field.textUnderField}
	<br /><sup>{$Field.textUnderField|unescape}</sup>
{/if}