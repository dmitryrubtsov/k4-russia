<h1 class="site-title">{$Page->Title}</h1>
{if $articleText}
	<div id="module-article-top">{$articleText}</div>
{/if}

{if $blocktype eq 'curr'}
	<div class="gallery-page">
  		{foreach from=$galleryList item=curr key=key name="gallery"}
  			<a href="{$curr.link}" rel="prettyPhoto[{$curr.gallery_id}]">
				<img src="{$curr.logo}" title="{$curr.title}" alt="{$curr.title}" />
			</a>
  		{/foreach}
  	</div>
{else}
  	<div class="gallery-page">
  		{foreach from=$galleryList item=curr key=key name="gallery"}
  			<a href="{$curr.link}">
				<img src="{$curr.logo}" title="{$curr.galleryTitle}" alt="{$curr.galleryTitle}" />
			</a>
  		{/foreach}
  	</div>
{/if}