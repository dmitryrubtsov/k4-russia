<!--<table>
<tr>
 <td>
  {foreach from=$ListItemsButtons item="curr" key="key"}
    {if $curr.newRow neq ''}</td></tr><tr><td>{/if}
    {if $NoUse.$key eq ''}<input class="{if $curr.cssClass neq ''}{$curr.cssClass}{else}button{/if}" type="button" value="{$curr.title}" onClick="{eval var=$curr.onclick|unescape}" />{/if}
  {/foreach}
   {*{if $NoUse.SaveButton eq ''}<input class="button" type="button" value="{$lang.admin.saveButton}" onClick="document.forms['{$Config.mainFormName}'].act.value='edit';document.forms['{$Config.mainFormName}'].submit();" />{/if}
   {if $NoUse.AddButton eq ''}<input class="button" type="button" value="{$lang.admin.addButton}" onClick="showAddNewForm();" />{/if}
   {if $NoUse.DeleteButton eq ''}<input class="button" type="button" value="{$lang.admin.delete}" onClick="if(confirm('{$lang.admin.askToDelSelectedItems}')){ldelim}document.forms['{$Config.mainFormName}'].act.value='delete';document.forms['{$Config.mainFormName}'].submit();{rdelim}else{ldelim}return false;{rdelim}" />{/if}
   {if $NoUse.ActivateButton eq ''}<input class="button" type="button" value="{$lang.admin.activate}" onClick="document.forms['{$Config.mainFormName}'].act.value='activate';document.forms['{$Config.mainFormName}'].task.value='active';document.forms['{$Config.mainFormName}'].subtask.value='y';document.forms['{$Config.mainFormName}'].submit();" />{/if}
   {if $NoUse.DeactivateButton eq ''}<input class="button" type="button" value="{$lang.admin.deactivate}" onClick="document.forms['{$Config.mainFormName}'].act.value='activate';document.forms['{$Config.mainFormName}'].task.value='active';document.forms['{$Config.mainFormName}'].subtask.value='n';document.forms['{$Config.mainFormName}'].submit();" />{/if}
   {if $NoUse.PresentButton eq ''}<input class="button" type="button" value="{$lang.admin.presentButton}" onClick="document.forms['{$Config.mainFormName}'].act.value='activate';document.forms['{$Config.mainFormName}'].task.value='presence';document.forms['{$Config.mainFormName}'].subtask.value='present';document.forms['{$Config.mainFormName}'].submit();" />{/if}
   {if $NoUse.SoldOutButton eq ''}<input class="button" type="button" value="{$lang.admin.soldOutButton}" onClick="document.forms['{$Config.mainFormName}'].act.value='activate';document.forms['{$Config.mainFormName}'].task.value='presence';document.forms['{$Config.mainFormName}'].subtask.value='sold_out';document.forms['{$Config.mainFormName}'].submit();" />{/if}
   {if $NoUse.CopyButton eq ''}<input class="button" type="button" value="{$lang.admin.copyButton}" onClick="showMessage('message');" />{/if}
   *}
 </td>
</tr>
</table>-->

<ul class="middleNavR">
	{foreach from=$ListItemsButtons item="curr" key="key"}
		{if $NoUse.$key eq ''}
			<li>
				<a href="#" {if $curr.img == 'copy.png'}id="go_count_copy"{/if} title="{$curr.title}" class="tipN" onClick="{eval var=$curr.onclick|unescape}; return false;" >
					<img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.adminTheme}/icons/middlenav/{$curr.img}" alt="" />
				</a>
			</li>
		{/if}
	{/foreach}
</ul>