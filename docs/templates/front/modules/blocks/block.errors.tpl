{if $ErrorMessages|@count > 0}
<center>
<table class="error">
 <tr><td class="head">{$lang.front.attention}</td></tr>
 <tr><td class="main"><table>
 {foreach from=$ErrorMessages item="curr" key="key"}
  <tr><td>{$curr}</td></tr>
 {/foreach}
 </table></td></tr>
</table>
</center>
{/if}