{*<input class="button" type="button" value="{$lang.admin.back}" onClick="document.location.href='?mode={$listInfo.pmode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $curr neq 'pmode' && $curr neq 'mode' && $listInfo.$curr neq ''}&{$curr}={$listInfo.$curr}{/if}{/foreach}{foreach from=$listInfo.where item='current' key='key'}{if $current.value neq ''}&{$key}={$current.value}{/if}{/foreach}{foreach from=$smarty.get item='curr' key='key'}{if $listInfo.useInLink.$key neq $key && $curr neq '' && $key neq $WorkTableKeyVarName && $key neq 'pmode' && $key neq 'mode'}&{$key}={$curr}{/if}{/foreach}';" />*}
<input class="button" type="button" value="{$lang.admin.back}" onClick="document.location.href='?mode={$listInfo.pmode}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $curr neq 'pmode' && $curr neq 'mode' && $listInfo.$curr neq ''}&{$curr}={$listInfo.$curr}{/if}{/foreach}{foreach from=$smarty.get item='curr' key='key'}{if $listInfo.useInLink.$key neq $key && $curr neq '' && $key neq $WorkTableKeyVarName && $key neq 'pmode' && $key neq 'mode'}&{$key}={$curr}{/if}{/foreach}'; {if $FLAGS.ContentOnly eq 'y'}window.parent.$.prettyPhoto.close();;{/if} return false;" />
