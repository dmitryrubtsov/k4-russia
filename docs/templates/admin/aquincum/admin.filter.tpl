<!-- filter -->
{include file="admin.form_filter.tpl"}
<script language="javascript">
	function submitFilter()
	{ldelim}
		{foreach from=$listInfo.where item='curr' key='key'}
			{if $curr.type neq 'date_filter'}
				{if $curr.JSact eq ''}
					document.forms['{$Config.filterFormName}'].{$key}.value=document.getElementById('{$curr.id}').value;
				{else}
					document.forms['{$Config.filterFormName}'].{$key}.value={$curr.JSact|unescape};
				{/if}
			{/if}
		{/foreach}
		{if $listInfo.page > 0}
			document.forms['{$Config.filterFormName}'].page.value='1';
		{/if}
		document.forms['{$Config.filterFormName}'].submit();
	{rdelim}
</script>

<form method="get" action="" name="{$Config.filterFieldsFormName}">
	<div class="filter-area">
		<div class="whead">
			{*<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span>*}
			<h6>{$lang.admin.filter}</h6>
		</div>
		<div class="filter-content">
			{foreach from=$listInfo.where item='curr' key='key' name='filterfields'}
				{if $curr.newRow eq 'y' && $smarty.foreach.filterfields.last eq ''}
			<div class="clear"></div>
		</div>
		<div class="filter-content">
				{/if}
				<div class="filter-block">
					<span>{$curr.title}:</span>
					{include file="admin.field_"|cat:$curr.type|cat:".tpl" Field=$curr}
				</div>
			{/foreach}
			<div class="clear"></div>
		</div>
		<div class="filter-button">
			{foreach from=$FilterButtons item="curr" key="key"}
				<div class="grid6">
					<input id="{$key}" class="buttonS bGreen" name="{$key}" type="button" value="{$curr.value}" onclick="{$curr.onclick|unescape}"{if $curr.other neq ''} {$curr.other|unescape}{/if} />
				</div>
			{/foreach}
		</div>
	</div>
</form>