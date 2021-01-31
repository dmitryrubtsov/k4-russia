<div class="wrapper" style="min-width:250px;">
	<a href="{$HOST}" target="_blank" title="" class="logo">
        <img src="{$HOST}{$Config.MainImageFolder}{$Config.adminImageFolder}{$Config.adminTheme}/background/logo_top_row.png" alt="" />
    </a>

	<!-- Right top nav -->
	<div class="topNav">
		<ul class="userNav">
			{*<li><a title="" class="search"></a></li>*}
			<li><a original-title="{$lang.admin.toFrontTitle}" title="{$lang.admin.toFrontTitle}" href="{$HOST}{*{$language}/*}" class="screen tipN"></a></li>
			{*<li><a href="#" title="" class="settings"></a></li>*}
			{if !$isLogin}
				<li><a original-title="{$lang.admin.logoutTitle}" title="{$lang.admin.logoutTitle}" href="index.php?mode=logout" class="logout tipN"></a></li>
				<li class="showTabletP"><a href="#" original-title="{$lang.admin.showNavigation}" title="" class="sidebar tipN"></a></li>
			{/if}
		</ul>
		{if !$isLogin}
			<a title="" class="iButton"></a>
		{/if}
		{*<a title="" class="iTop"></a>*}

		{*
		<div class="topSearch">
			<div class="topDropArrow"></div>
			<form action="">
				<input type="text" placeholder="search..." name="topSearch" />
				<input type="submit" value="" />
			</form>
		</div>
		*}
	</div>
	<div id="flag-menu-block">
		<ul>
		    {foreach from=$LangMenu item='curr' name='lmenu'}
				<li>
					<a href="{$URL_WITHOUT_LANG}&{$Config.AdminLangVarName}={$curr.locale}">
						<img src="{$HOST}{$curr.orig_path}" title="{$curr.title}" width="$curr.orig_width" height="{$curr.orig_height}" />
					</a>
				</li>
			{/foreach}
		</ul>
	</div>

	<!-- Responsive nav -->
	<ul class="altMenu">
	    {foreach from=$AdminMenuTree item='curr' name='mmenu'}
	    	<li>
				<a href="{$Host}{$curr.link}" title="{$curr.title}" {if $curr.children neq ''} class="exp" {/if} {*id="current"*}>{$curr.title}</a>
				{if $curr.children neq ''}
					<ul>
						{foreach from=$curr.children item='subcurr' name='submenu'}
							<li><a href="{$Host}{$subcurr.link}">{$subcurr.title}</a></li>
						{/foreach}
					</ul>
				{/if}
			</li>
	    {/foreach}
	</ul>
</div>