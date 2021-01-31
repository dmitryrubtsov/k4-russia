<div id="extra-menu-right">
	<ul>
		{foreach from=$ExtraMenuRight item=menuItem name=extra}
			{assign var="item" value=$menuItem->getItem()}
			<li>
				<a href="{$HOST}{$item.link}" class="menu-item" >
					{$item.title}
				</a>
			</li>
		{/foreach}
	</ul>
</div>