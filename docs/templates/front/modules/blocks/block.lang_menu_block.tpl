{*<div id="bannerscollection_kenburns_generous">
	<div class="myloader"></div>
	<ul class="bannerscollection_kenburns_list">
		{foreach from=$SliderArray item=curr key=key name="slider"}
			<li data-initialZoom="1" data-finalZoom="0.71" data-bottom-thumb="{$curr.logo}" {if $curr.embed_link} data-horizontalPosition="left" data-verticalPosition="bottom" data-video="true" {/if} >
				<img src="{$curr.image}" alt="" width="1350" height="800" />
				{if $curr.embed_link}
					<iframe width="100%" height="100%" src="{$curr.embed_link}" frameborder="0" allowfullscreen></iframe>
				{/if}
			</li>
		{/foreach}
	</ul>
</div>*}

<div id="multi-languages">
	<ul>
		{foreach from=$LangMenuArray item=curr key=key name="lang"}
			<li>
				<a href="/{$curr.code2}{$URL_WITHOUT_LANG}" {if $LANG eq $curr.code2} class="curr" {/if}>
					{if $curr.flag}
						<img src="{$curr.flag}" title="{$curr.title}" />
					{/if}
					<span>{$curr.title}</span>
				</a>
			</li>
		{/foreach}
	</ul>
</div>