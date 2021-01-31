
<form method="post" name="addKwds" action="">
<input type="hidden" name="tsk" value="modify" />
<table class="addromcsv">
<tr>
 <td class="head">#</td>
 <td class="head">{$lang.admin.keyword}</td>
 <td class="head">{$lang.admin.linkName}</td>
 <td class="head">{$lang.admin.priority}</td>
 <td class="head">{$lang.admin.active}</td>
</tr>
{foreach from=$ToDBArrKeywordsError item="curr" key="key"}
{if $curr neq ''}
<tr>
 <td class="error">{counter name="kwds"}</td>
 <td class="error"><input type="text" name="keyword[{$curr}]" value="{$ToDBArrKeywords.$curr.keyword}" onclick="document.forms['addKwds'].elements['linkname[{$curr}]'].value=makeLinkName(this.value.toLowerCase());" onchange="document.forms['addKwds'].elements['linkname[{$curr}]'].value=makeLinkName(this.value.toLowerCase());" onkeyup="document.forms['addKwds'].elements['linkname[{$curr}]'].value=makeLinkName(this.value.toLowerCase());" /></td>
 <td class="error"><input type="text" name="linkname[{$curr}]" value="{$ToDBArrKeywords.$curr.linkname}" /></td>
 <td class="error"><input type="text" name="priority[{$curr}]" value="{$ToDBArrKeywords.$curr.priority}" size="3" /></td>
 <td class="error"><input type="text" name="active[{$curr}]" value="{$ToDBArrKeywords.$curr.active}" size="3" /></td>
</tr>
{assign var="errorFlag" value="1"}
{/if}
{/foreach}
{foreach from=$ToDBArrKeywords item="curr" key="key"}
{in_array array=$ToDBArrKeywordsError value=$key assign="isInArr"}
{if !$isInArr}
<tr>
 <td class="list">{counter name="kwds"}</td>
 <td class="list">{$curr.keyword}</td>
 <td class="list">{$curr.linkname}</td>
 <td class="list">{$curr.priority}</td>
 <td class="list">{$curr.active}</td>
</tr>
{/if}
{/foreach}
</table>
<input class="button" type="button" value="<< {$lang.admin.back}" onclick="document.location.href='{$BlankLink|unescape}&{$Config.AdminActionGetVar}={$PrevAction}';" />&nbsp;&nbsp;&nbsp;
{if $errorFlag eq '1'}
<input class="button" type="submit" value="{$lang.admin.next} >>" />
{else}
<input class="button" type="button" value="{$lang.admin.placeKeywordsToDB}" onclick="document.location.href='{$BlankLink|unescape}&{$Config.AdminActionGetVar}={$NextAction}';" />
{/if}
</form>