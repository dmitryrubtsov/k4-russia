<div id="additional-info-column">
    {foreach from=$bannerArray item=curr name="banners"}
        <div class="add-info-column">
            <div class="pict-sec">
                <a href="{$curr.link}" title="{$curr.bannerTitle}"><img src="{$curr.image}" /></a>
            </div>
            <div class="text-sec">
                <a href="{$curr.link}" title="{$curr.bannerTitle}">{$curr.bannerTitle}</a>
            </div>
            <div class="clear"></div>
        </div>
    {/foreach}
</div>