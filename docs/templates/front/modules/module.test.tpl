{*{explode delim=$Config.imSizeDelimiter str=$Config.sliderImageSize assign='SliderMainImageSize'}*}
<div>
	This is some test page
</div>

{*<div id="main-ad-slider">
	<div class="slides_container">
		{foreach from=$SliderAdMainTestArray item=curr key=key name="slider-main"}
			<div class="main-ad-block">
				<div class="ad-logo">
					{if $curr.link}
						<a href="{$curr.link}" target="_blank" >
					{/if}
						<img src="{$curr.logo}" title="{$curr.title}" width="{$SliderMainImageSize[0]}" height="{$SliderMainImageSize[1]}" />
					{if $curr.link}
						</a>
					{/if}
				</div>
				<div class="ad-title">
					<div class="ad-title-area">{$curr.title}</div>
				</div>
				<div class="ad-text">
					<div class="ad-text-area">
						{$curr.description} <a {if $curr.link}href="{$curr.link}" target="_blank"{/if}class="more">{$lang.front.more}</a>
					</div>
				</div>
			</div>
		{/foreach}
	</div>
	<a href="#" class="prev"></a>
	<a href="#" class="next"></a>
</div>*}

<div id="test"></div>
