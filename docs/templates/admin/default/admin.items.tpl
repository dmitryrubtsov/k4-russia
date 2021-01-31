{*{include file="admin.header.tpl"}*}
{include file="admin.javascript_items.tpl"}
{if $NoUse.CopyButton eq ''}
{include file="admin.message_window.tpl"}
<div id="copy-message" class="hid">
<center>
<table>
 <tr><td>{$lang.admin.count}</td><td><input id="copy_count" type="input" value="" /></td></tr>
</table>
</div>
<div class="hid" id="copy-buttons">
 <input class="button" type="button" value="{$lang.admin.copyButton}" onclick="document.forms['{$Config.mainFormName}'].act.value='copy';document.forms['{$Config.mainFormName}'].subtask.value=document.getElementById('copy_count').value;document.forms['{$Config.mainFormName}'].submit();" />
 &nbsp;&nbsp;&nbsp;<input type="button" class="button" value="{$lang.admin.cancelButton}" onclick="hideMessage();" />
</div>
<div class="hid" id="copy-title">{$lang.admin.enterCountOfCopies}</div>
{/if}
<div id="listing" style="display:block;">
{if $EnableFilter eq true}
{include file="admin.filter.tpl"}
{/if}
{include file="admin.errors.tpl"}
{if $FLAGS.NotAllLangFieldsInTable}
{include file="admin.body_megamessage.tpl"}
{/if}
{gen_forms ConfEditForms=$ConfEditForms Item=$Item assign="formsstr"}
{eval var=$formsstr|unescape}
{get_defined_param val='__FALSE' assign="FALSE"}
{include file=$BodyTemplate}
{*{include file="admin.footer.tpl"}*}
