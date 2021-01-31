{foreach from=$bannerArray item=curr name="banners"}
    <div class="add-info-block">
        <a href="{$curr.link}" title="{$curr.bannerTitle}"><img src="{$curr.image}" /></a>
        <div class="text-sec">
            <a href="{$curr.link}" title="{$curr.bannerTitle}">{$curr.bannerTitle}</a>
        </div>
    </div>
{/foreach}
<div class="clear"></div>