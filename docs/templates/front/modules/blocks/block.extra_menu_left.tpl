<div id="extra-menu-left">
	<ul>
			<li class="notbord"><a href="$BaseURL"><img src="{$Host}{$Config.MainImagesFolder}tpl/home_icon.png" alt="Home" title="Home" /></a></li>
		{foreach from=$ExtraMenuLeft item=menuItem name=extra}
			{assign var="item" value=$menuItem->getItem()}
			<li>
				<a href="{$HOST}{$item.link}" class="menu-item" >
					{$item.title}
				</a>
			</li>
		{/foreach}
	</ul>
</div>