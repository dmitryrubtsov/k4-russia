{include file="admin.header.tpl"}
<br /><br />
<center>
<form name="sitemap" method="post" action="">
<div class="item">
  {$lang.admin.clientDomain}:&nbsp;&nbsp;
   <select name="client_domain" id="client_domain">
   {foreach from=$ClientDomains item=curr}
    <option value="{$curr.id}"{if $smarty.post.client_domain == $curr.id} selected{/if}>{$curr.sitename}</option>
   {/foreach}
   </select>
</div>
<br />
<div class="item">
  {$lang.admin.changeFrequency}:&nbsp;&nbsp;
  <select name="frequency">
   <option value=""{if $smarty.post.frequency == ''} selected{/if}>{$lang.admin.none}</option>
   <option value="always"{if $smarty.post.frequency == 'always'} selected{/if}>{$lang.admin.always}</option>
   <option value="hourly"{if $smarty.post.frequency == 'hourly'} selected{/if}>{$lang.admin.hourly}</option>
   <option value="daily"{if $smarty.post.frequency == 'daily'} selected{/if}>{$lang.admin.daily}</option>
   <option value="weekly"{if $smarty.post.frequency == 'weekly'} selected{/if}>{$lang.admin.weekly}</option>
   <option value="monthly"{if $smarty.post.frequency == 'monthly'} selected{/if}>{$lang.admin.monthly}</option>
   <option value="yearly"{if $smarty.post.frequency == 'yearly'} selected{/if}>{$lang.admin.yearly}</option>
   <option value="never"{if $smarty.post.frequency == 'never'} selected{/if}>{$lang.admin.never}</option>
  </select>
</div>
<!--<br />
<div class="item">
  {$lang.admin.priority}:&nbsp;&nbsp;
  <input type="text" name="priority" value="{if $smarty.post.priority != ''}{$smarty.post.priority}{else}0.5{/if}" size="3" />
</div>-->
<br />
<div class="item"><input type="submit" value="{$lang.admin.submitButton}" /></div>
</form>
</center>

{if $smarty.post.client_domain neq ''}
<b>{$lang.admin.sitemap}</b><br /><br />
<textarea name="smap" id="smap" style="width:500px;height:450px;">
{$SiteMap|unescape}
</textarea>
{/if}
{include file="admin.footer.tpl"}
