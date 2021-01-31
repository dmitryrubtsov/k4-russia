<!-- filter -->
{include file="admin.form_filter.tpl"}
<script language="javascript">
function submitFilter()
{ldelim}
  {foreach from=$listInfo.where item='curr' key='key'}
    {if $curr.JSact eq ''}
    document.forms['{$Config.filterFormName}'].{$key}.value=document.getElementById('{$curr.id}').value;
    {else}
    document.forms['{$Config.filterFormName}'].{$key}.value={$curr.JSact|unescape};
    {/if}
  {/foreach}
  {if $listInfo.page > 0}
    document.forms['{$Config.filterFormName}'].page.value='1';
  {/if}
    document.forms['{$Config.filterFormName}'].submit();
{rdelim}
</script>
<table class="filter">
  <tr><td class="head">{$lang.admin.filter}:</td></tr>
  <tr><td><table class="filterin"><tr>
  {foreach from=$listInfo.where item='curr' key='key' name='filterfields'}
    {if $curr.newRow eq 'y' && $smarty.foreach.filterfields.last eq ''}
      </tr></table></td></tr><tr><td><table class="filterin"><tr>
    {/if}
    <td><b>{$curr.title}:</b>&nbsp;&nbsp;{include file="admin.field_"|cat:$curr.type|cat:".tpl" Field=$curr}</td>
  {/foreach}
  </tr></table></td></tr>
  <tr><td class="submit">
  {foreach from=$FilterButtons item="curr" key="key"}
  <input id="{$key}" name="{$key}" type="button" value="{$curr.value}" onclick="{$curr.onclick|unescape}"{if $curr.other neq ''} {$curr.other|unescape}{/if} />
  {/foreach}
  </td></tr>
</table>
<!-- end filter -->