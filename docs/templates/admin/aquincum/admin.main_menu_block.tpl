<ul class="nav">
	{foreach from=$AdminMenuTree item="curr" key="key" name="admmenutree"}
		{if $curr}
			<li>
				<a title="" href="{if $curr.unic_link}{$curr.unic_link}{else}{$curr.link}{$curr.admin_menu_id}{/if}" {if $curr.maincurr} class="active" {/if}>
					<img src="{$curr.logo}" width="32" alt="" />
					<span>{$curr.title}</span>
				</a>
				{if $curr.children|@count > 0}
					<ul>
						{foreach from=$curr.children item="subcurr" key="subkey"}
							<li>
								<a {if $subcurr.children|@count > 0} href="#" class="exp" {else} href="{$subcurr.link}" title="" {/if}>
									<span class="icol-fullscreen"></span>{$subcurr.title}
									{if $subcurr.children|@count > 0}<span class="dataNumGreen">{$subcurr.children|@count}</span>{/if}
								</a>
								{if $subcurr.children|@count > 0}
									<ul>
										{foreach from=$subcurr.children item="subsubcurr" key="subsubkey"}
											<li>
												<a href="{$subsubcurr.link}" title="">
													<span class="icol-fullscreen"></span>{$subsubcurr.title}
												</a>
											</li>
										{/foreach}
									</ul>
								{/if}
							</li>
						{/foreach}
					</ul>
				{/if}
			</li>
		{/if}
	{/foreach}
</ul>