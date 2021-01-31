<div id="extra-menu-mobile">
	<ul>
		{foreach from=$ExtraMenuMobile item=menuItem name=extra}
			{assign var="item" value=$menuItem->getItem()}
			<li>
				<a href="{$HOST}{$item.link}" class="menu-item" >
					{$item.title}
				</a>
			</li>
			{if $smarty.foreach.extra.last neq true}
				<li>|</li>
			{/if}
		{/foreach}
	</ul>
</div>
<div class="clear"></div>