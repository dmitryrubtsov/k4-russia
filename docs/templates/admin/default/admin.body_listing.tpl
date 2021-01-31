{if $FLAGS.NoReadDB eq $FALSE}
{include file="admin.paging.tpl" position='top'}
<table class="listing">
<tr class="trhead">
  {include file="admin.listingtab_head_begin.tpl"}
  {gen_listingtab_head ConfFields=$ConfFields assign="fheadstr" Config=$Config}
  {eval var=$fheadstr|unescape}
</tr>
<form method="post" action="" name="{$Config.mainFormName}">
{include file="admin.mainform_hidinputs.tpl"}
{counter start=$listInfo.countSt skip=1 print=false assign='nomer'}

{foreach from=$Items item=curr}
 {cycle values="tr1,tr2" assign="trClass"}
 <tr id="listingrt{$curr.$WorkTableKeyFieldName}" class="{$trClass}" onmouseover="this.className='tr-hover';" onmouseout="this.className='{$trClass}';">
  {counter}
  {include file="admin.listingtab_row_begin.tpl" nomer=$nomer Mode=$AloneMode}
  {gen_listingtab_row ConfFields=$ConfFields assign="fitemstr" Config=$Config Item=$curr}
  {eval var=$fitemstr|unescape}
 </tr>
{/foreach}
</form>
</table>
{include file="admin.paging.tpl" position='bottom'}
{include file="admin.buttons_sad.tpl"}
</div>
{if $NoUse.AddButton eq ''}
<div id="addnewitem" style="display:none">
<div class="subtitle">{$lang.admin.addNewItem}</div>
{template_exists file="admin."|cat:$GlobPart|cat:".tpl" alternative="admin.item.tpl" assign='filename'}
{include file=$filename BodyTemplate="admin.body_item.tpl"}
</div>
{/if}
{if $showAddNewForm neq ''}
<script language="javascript">
showAddNewForm();
</script>
{/if}
{/if}