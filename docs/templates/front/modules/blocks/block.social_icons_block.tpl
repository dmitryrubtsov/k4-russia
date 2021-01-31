{if $SocialIcons|@count > 0}
	<div id="right_block">
		{foreach from=$SocialIcons item=curr key=key name="socialIcons"}
			<div class="soc-icon">
				<a {if $curr.link neq ''} href="{$curr.link}" target="_blank" {/if}>
					<img src="{$curr.image_path}" title="{$curr.title}" alt="{$curr.title}" width="{$curr.orig_width}" height="{$curr.orig_height}" />
				</a>
			</div>
		{/foreach}
	</div>
{/if}