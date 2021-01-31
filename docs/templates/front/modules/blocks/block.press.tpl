<ul id="press-list" class="column-menu">
	{foreach from=$PressMenu item=menuItem}
		{assign var="item" value=$menuItem->getItem()}
		<li>
			<a href="{$HOST}{$item.link}" class="menu-item" >
				{$item.title}
			</a>
		</li>
	{/foreach}
</ul>