<a href="index.php?mode={$Mode}&{$WorkTableKeyVarName}={$curr.$WorkTableKeyFieldName}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'pmode'}&{$curr}={$listInfo.$curr}{/if}{/foreach}{foreach from=$listInfo.where item='current' key='key'}{if $current.value neq ''}&{$key}={$current.value}{/if}{/foreach}{if $adminMode neq ''}&pmode={$adminMode}{/if}">{if $linkTitle eq ''}<img src="{$HOST}/images/admin/edit_ico.gif" border="0" alt="{$lang.admin.edit}" title="{$lang.admin.edit}" />{else}{$linkTitle}{/if}</a>