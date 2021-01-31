{foreach from=$Field.values item='curr' key='key'}
  {if $Field.value eq $key}
    <a class="{$curr.className}" href="#" onClick="{foreach from=$curr.formFields item='current' key='key1'}document.forms['{$Field.formid}'].{$key1}.value='{eval var=$current}';{/foreach}document.forms['{$Field.formid}'].submit();return false;">{$curr.title}</a>
  {/if}
{/foreach}
{if $Field.textAfterField}&nbsp;{$Field.textAfterField|unescape}{/if}{if $Field.textUnderField}<br /><sup>{$Field.textUnderField|unescape}</sup>{/if}