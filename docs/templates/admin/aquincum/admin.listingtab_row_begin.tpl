{if $NoUse.Nomer eq ''}
	<td>{$nomer}</td>
{/if}
{if $NoUse.Checkbox eq ''}
	<td class="check">
		<input type="checkbox" id="item{$curr.$WorkTableKeyFieldName}" name="item[{$curr.$WorkTableKeyFieldName}]" value="{$curr.$WorkTableKeyFieldName}" />
	</td>
{/if}
{if $NoUse.EditBlock eq ''}
	<td>
		<nobr>
			{if $NoUse.Edit eq ''}
				{include file="admin.linktoitem.tpl" Mode=$Mode linkTitle=$linkTitle}
			{/if}
			{if $NoUse.SaveButton eq ''}
				{*&nbsp;
				<a href="#" onClick="checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='edit';document.forms['{$Config.mainFormName}'].submit();return false;">
					<img src="{$HOST}/images/admin/save_ico.gif" border="0" alt="{$lang.admin.saveButton}" title="{$lang.admin.saveButton}" />
				</a>*}
				<a href="#" onClick="checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='edit';document.forms['{$Config.mainFormName}'].submit();return false;" class="tablectrl_small bDefault tipS" title="{$lang.admin.saveButton}">
					<span class="buttonTemp icos-inbox"></span>
				</a>
				{*<a href="#" class="tablectrl_small bDefault tipS" title="Edit"><span class="iconb" data-icon="&#xe22f;"></span></a>*}
			{/if}
			{if $NoUse.DeleteButton eq ''}
				{*&nbsp;
				<a href="#" onClick="if(confirm('{$lang.admin.askToDelThisRow}')){ldelim}checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='delete';document.forms['{$Config.mainFormName}'].submit();{rdelim}else{ldelim}return false;{rdelim}">
					<img src="{$HOST}/images/admin/delete_ico.gif" border="0" alt="{$lang.admin.delete}" title="{$lang.admin.delete}" />
				</a>*}
				<a href="#" onClick="if(confirm('{$lang.admin.askToDelThisRow}')){ldelim}checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='delete';document.forms['{$Config.mainFormName}'].submit();{rdelim}else{ldelim}return false;{rdelim}" class="tablectrl_small bDefault tipS" title="{$lang.admin.delete}">
					<span class="buttonTemp icos-cross"></span>
				</a>
			{/if}
            {if $NoUse.CopyButton eq ''}
            {*&nbsp;
            <a href="#" onClick="if(confirm('{$lang.admin.askToDelThisRow}')){ldelim}checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='delete';document.forms['{$Config.mainFormName}'].submit();{rdelim}else{ldelim}return false;{rdelim}">
                <img src="{$HOST}/images/admin/delete_ico.gif" border="0" alt="{$lang.admin.delete}" title="{$lang.admin.delete}" />
            </a>*}
                <a href="#" onclick="checkItems('');itemCheck('item{$curr.$WorkTableKeyFieldName}');document.forms['{$Config.mainFormName}'].act.value='copy';document.forms['{$Config.mainFormName}'].subtask.value='1';document.forms['{$Config.mainFormName}'].submit();" class="tablectrl_small bDefault tipS" title="{$lang.admin.copy}">
                    <span class="buttonTemp icos-copy"></span>
                </a>
            {/if}
			{foreach from=$ListItemIconButtons item="button" key="key"}
				&nbsp;
				<a href="{if $button.href != ''}{eval var=$button.href|unescape}{else}#{/if}"{if $button.onclick != ''} onClick="{eval var=$button.onclick|unescape}"{/if}{if $button.target != ''} target="{$button.target|unescape}"{/if}>
					<img src="{$HOST}/images/admin/{$button.src|unescape}" border="0" alt="{$button.value}" title="{$button.value}" />
				</a>
			{/foreach}
		</nobr>
	</td>
{/if}