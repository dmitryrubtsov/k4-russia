<a class="orderby{if $listInfo.order == $orderby && $listInfo.tabord == $taborder}-curr{/if}" {if $NoUse.OrderBy eq ''} href="index.php?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}&order={$orderby|replace:" ":$Config.AdminLinkNameDelim}&order_type={if $listInfo.order == $orderby && $listInfo.tabord == $taborder && $listInfo.order_type != 'desc'}desc{else}asc{/if}{if $taborder neq ''}&tabord={$taborder}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'order' && $curr neq 'tabord' && $curr neq 'order_type'}&{$curr}={$listInfo.$curr}{/if}{/foreach}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}" {/if}>
	{$title}
	{if $listInfo.order == $orderby && $listInfo.tabord == $taborder}
		&nbsp;&nbsp;
		<img src="{$HOST}/images/admin/{if $listInfo.order_type == 'desc'}arrow_up.gif{else}arrow_down.gif{/if}" border="0" align="absmiddle" />
	{/if}
</a>
