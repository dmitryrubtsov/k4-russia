<form method="get" action="" name="paging{$position}">
	{foreach from=$smarty.get item="curr" key="key"}
		{if $key neq 'onpage' && $curr neq ''}
			<input type="hidden" name="{$key}" value="{$curr}" />
		{/if}
	{/foreach}
	<div class="itemActions">
		<label>{$lang.admin.onPage}:</label>
		<select name="onpage" class="styled" onChange="document.forms['paging{$position}'].submit();">
			{*<option value="">Select action...</option>*}
			{foreach from=$onPageList item="curr"}
				<option value="{$curr}"{if $curr eq $smarty.get.onpage && $smarty.get.onpage neq '' || $curr eq $Config.onPage && $smarty.get.onpage eq ''} selected{/if}>{$curr}</option>
			{/foreach}
		</select>
		{math assign='countFin' equation="a + b" a=$listInfo.countSt b=$listInfo.onpage}
		<span>{math equation="a + b" a=$listInfo.countSt b=1} - {if $countFin > $listInfo.count}{$listInfo.count}{else}{$countFin}{/if} {$lang.admin.from} {$listInfo.count}</span>
	</div>
</form>
<div class="tPages">
	<ul class="pages">
		<li><a {if $listInfo.prev eq 0} class="paginate_button_disabled" {else} href="?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.firstpage}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}" {/if}><<</a></li>
		<li><a {if $listInfo.prev eq 0} class="paginate_button_disabled" {else} href="?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.prev}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}" {/if}><</a></li>
		{section name=Page loop=$listInfo.pages}
			{if $listInfo.pages[Page] == $listInfo.page}
				<li><a title="" class="active">{$listInfo.pages[Page]}</a></li>
			{else}
				<li><a href="?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.pages[Page]}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}">{$listInfo.pages[Page]}</a></li>{*{if not $smarty.section.Page.last}|{/if}*}
			{/if}
		{sectionelse}
			{$lang.admin.noPages}
		{/section}
		<li><a {if $listInfo.next eq 0} class="paginate_button_disabled" {else} href="?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.next}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}" {/if}>></a></li>
		<li><a {if $listInfo.next eq 0} class="paginate_button_disabled" {else} href="?mode={$adminMode}{if $menu neq ''}&menu={$menu}{/if}{foreach from=$listInfo.useInLink item='curr' key='key'}{if $curr neq '' && $listInfo.$curr neq '' && $curr neq 'page'}&{$curr}={$listInfo.$curr}{/if}{/foreach}&page={$listInfo.lastpage}{foreach from=$listInfo.where item='curr' key='key'}{if $curr.value neq ''}&{$key}={$curr.value}{/if}{/foreach}" {/if}>>></a></li>
	</ul>
</div>
<div class="clear"></div>