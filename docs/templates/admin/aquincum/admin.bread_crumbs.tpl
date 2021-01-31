<!-- Breadcrumbs line -->
<div class="breadLine">
	<div class="bc">
		<ul id="breadcrumbs" class="breadcrumbs">
			<li><a {* href="index.html"*}>{$MainMenuCurr}</a></li>
			<li><a {* href="other_calendar.html" *}>{$SubMenuCurr}</a>
				{*
				{if $AdminSubmenuTree && $AdminSubmenuTree|@count > 0}
					<ul>
						{foreach from=$AdminSubmenuTree item="curr" key="key" name="submenu"}
							<li>
								<a {if $curr.children|@count > 0} href="#" title="" class="exp" {else} href="{$curr.link}{$curr.parent_admin_menu_id}" title="" {if $curr.subcurr eq 'curr'} class="this" {/if}{/if}>
									<span class="icos-dcalendar"></span>
									{$curr.title} {if $curr.children|@count > 0}<span class="dataNumRed">{$curr.children|@count}</span>{/if}
								</a>
								{if $curr.children|@count > 0}
									<ul>
										{foreach from=$curr.children item="subcurr" key="subkey" name="subsubmenu"}
											<li>
												<a href="{$subcurr.link}{$curr.parent_admin_menu_id}">{$subcurr.title}</a>
											</li>
										{/foreach}
									</ul>
								{/if}
							</li>
						{/foreach}
					</ul>
				{/if}
				*}
			</li>
			{*
			<li class="current"><a href="" title="">{$PageTitle}</a></li>
			*}
		</ul>
	</div>
	{*<div class="breadLinks">
		<ul>
			<li><a href="#" title=""><i class="icos-list"></i><span>Orders</span> <strong>(+58)</strong></a></li>
			<li><a href="#" title=""><i class="icos-check"></i><span>Tasks</span> <strong>(+12)</strong></a></li>
			<li class="has">
				<a title="">
					<i class="icos-money3"></i>
					<span>Invoices</span>
					<span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
				</a>
				<ul>
					<li><a href="#" title=""><span class="icos-add"></span>New invoice</a></li>
					<li><a href="#" title=""><span class="icos-archive"></span>History</a></li>
					<li><a href="#" title=""><span class="icos-printer"></span>Print invoices</a></li>
				</ul>
			</li>
		</ul>
	</div>*}
</div>