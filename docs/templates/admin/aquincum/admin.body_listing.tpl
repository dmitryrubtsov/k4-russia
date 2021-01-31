{if $FLAGS.NoReadDB eq $FALSE}
	<div class="widget check grid6">
		<div class="whead">
			{*<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>*}
			<h6>{$PageTitle}</h6>
		</div>
		<div class="wtable">
		{if $Items|@count}
			<form method="post" action="" name="{$Config.mainFormName}">
				<table cellpadding="0" cellspacing="0" class="tDefault checkAll tMedia" id="checkAll">
					<thead>
						<tr>
							{include file="admin.listingtab_head_begin.tpl"}
							{gen_listingtab_head ConfFields=$ConfFields assign="fheadstr" Config=$Config}
							{eval var=$fheadstr|unescape}
						</tr>
					</thead>
					<tbody>

						{include file="admin.mainform_hidinputs.tpl"}
						{counter start=$listInfo.countSt skip=1 print=false assign='nomer'}
						{foreach from=$Items item=curr}
							<tr id="listingrt{$curr.$WorkTableKeyFieldName}">
								{counter}
								{include file="admin.listingtab_row_begin.tpl" nomer=$nomer Mode=$AloneMode}
								{gen_listingtab_row ConfFields=$ConfFields assign="fitemstr" Config=$Config Item=$curr}
								{eval var=$fitemstr|unescape}
							</tr>
						{/foreach}

					</tbody>
				</table>
			</form>
		{else}
			<div class="empty-page-tooltip">{$emptyPageTooltip}</div>
		{/if}
		</div>
		{if $Items|@count}
			<div class="navigation">
				{include file="admin.paging.tpl"}
			</div>
		{/if}
	</div>

		{include file="admin.buttons_sad.tpl"}

	</div>
	{if $NoUse.AddButton eq ''}
		<div id="addnewitem" style="display:none;">
			{template_exists file="admin."|cat:$GlobPart|cat:".tpl" alternative="admin.item.tpl" assign='filename'}
			{include file=$filename BodyTemplate="admin.body_item.tpl"}
		</div>
	{/if}

	{if $showAddNewForm neq '' || $onlyAddItem}
		<script language="javascript">
			showAddNewForm();
		</script>
	{/if}
{/if}