<form method="get" action="" name="{$Config.filterFormName}">
	<input type="hidden" name="mode" value="{$adminMode}">
	{if $menu neq ''}
		<input type="hidden" name="menu" value="{$menu}">
	{/if}
	{if $leader neq ''}
		<input type="hidden" name="leader" value="{$leader}">
	{/if}
	{foreach from=$listInfo.useInLink item='curr' key='key'}
		{if $curr neq '' && $listInfo.$curr neq ''}
			<input type="hidden" name="{$curr}" value="{$listInfo.$curr}">
		{/if}
	{/foreach}
	{foreach from=$listInfo.where item='curr' key='key'}
		<input type="hidden" name="{$key}" value="{$curr.value}">
	{/foreach}
</form>