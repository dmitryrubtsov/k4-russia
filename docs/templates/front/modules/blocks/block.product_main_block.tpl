{*
{if $newsArray|@count > 0}
    <h2 class="site-title">{$lang.front.news}</h2>
    <div id="news-block">
        {foreach from=$newsArray item=curr name="sitenews"}
            <div class="news-block-each{if $smarty.foreach.sitenews.last eq true}-last{/if}">
                <div class="block-date">{$curr.publication_date|date_format:"%d.%m.%Y"}</div>
                <div class="block-title">{$curr.newsTitle}</div>
                <div class="block-text">{$curr.newsDescription|unescape}</div>
                <div class="block-more"><a href="{$curr.link}">{$lang.front.more}</a></div>
            </div>
        {/foreach}
        <div class="clear"></div>
    </div>
{/if}
    *}
{if $productArray|@count > 0}
    <h2 class="site-title">{$lang.front.production}</h2>
    <div id="product-block">
        <div id="product-block-area">
            {foreach from=$productArray item=curr name="mainproduct"}
                <div class="product-card">
                    <div class="product-card-area">
                        <div class="product-card-image">
                            <a href="{$curr.link}">
                                <img src="{$curr.image}" title="{$curr.productTitle}" alt="{$curr.productTitle}" />
                            </a>
                        </div>
                        <div class="product-card-desc">
                            <div class="product-card-title">{$curr.productTitle}</div>
                            <div class="product-card-text">{$curr.description|unescape}</div>
                            <div class="product-card-button">
                                <a class="site-button" href="{$curr.link}">{$lang.front.more}</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            {/foreach}
        </div>
    </div>
{/if}