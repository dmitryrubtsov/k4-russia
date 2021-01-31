{if $ItemAddFormName eq ''}
 {assign var='ItemAddFormName' value=$Config.AddFormName}
{/if}
{include file="admin.errors.tpl"}
<form method="post" action="" name="{$ItemAddFormName}" enctype="multipart/form-data">
<input type="hidden" name="act" value="" />
{if $Item.$WorkTableKeyFieldName != '' && $showAddNewForm eq ''}
<input type="hidden" name="{$WorkTableKeyVarName}" value="{$Item.$WorkTableKeyFieldName}">
{/if}
<table class="item">
 <tr><td class="itemtd">
   <table>
    {gen_fields ConfFields=$ConfFields Item=$Item assign="fieldsstr"}
    {eval var=$fieldsstr|unescape}
    <tr>
      <td colspan=2 class="submit">
        {if $NoUse.SaveItemButton == ''}{include file="admin.button_add_edit.tpl"}{/if}
        {if $Item.$WorkTableKeyFieldName != '' && $showAddNewForm eq '' || $FLAGS.ContentOnly neq ''}
          {if $NoUse.BackButton == ''}{include file="admin.button_back.tpl" ItemAddFormName=$ItemAddFormName}{/if}
          {foreach from=$ItemButtons item="curr" key="key"}
           {if $curr.newRow neq ''}<br /><br />{/if}
         	<input class="{if $curr.cssClass neq ''}{$curr.cssClass}{else}button{/if}" type="button" value="{$curr.value}" onclick="{eval var=$curr.onclick|unescape}" />
          {/foreach}
        {else}
        <input type="button" class="button" value="{$lang.admin.cancelButton}" onclick="{if $cancelFunction}{$cancelFunction}{else}hideAddNewForm();{/if}" />
        {/if}
      </td>
    </tr>
  </table>
 </td></tr>
</table>

</form>
<div class="required_text">{$lang.admin.fieldsAreRequired}</div>