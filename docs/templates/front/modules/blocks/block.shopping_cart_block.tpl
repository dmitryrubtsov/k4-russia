<ul class="menu">
    <li class="menu-search no-hover">
        <a href="#">
            <i class="fa-search"></i>
        </a>
        <ul class="sub-menu">
            <li>
                <div class="ajax-search-wrap">
                    <div class="ajax-loading"></div>
                    <form method="get" class="ajax-search-form" action="/">
                        <input type="text" placeholder="{$lang.site.siteSearch}" name="s" autocomplete="off" />
                    </form>
                    <div class="ajax-search-results"></div>
                </div>
            </li>
        </ul>
    </li>
    <li class="parent shopping-bag-item">
        <a class="cart-contents" href="#" title="{$lang.front.viewShoppingCart}">
            <i class="sf-cart"></i>
            <span class="amount">
                {if $Cart.total_price > 0}
                    {$Cart.total_price|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}
                {else}
                    0 {$Config.currencySymbol}
                {/if}
            </span>
        </a>
        <ul style="top: 64px;" class="sub-menu">
            <li>
                <div class="shopping-bag">
                    {if $Cart.items && $Cart.items|@count > 0}
                        <div class="bag-header">{$lang.front.itemsInShoppingCart} - {$Cart.total_count}</div>
                        <div class="bag-contents">
                            {foreach from=$Cart.items item=curr name="cartlistblock"}
                                <div class="bag-product clearfix">
                                    <figure>
                                        <a class="bag-product-img" href="{$curr.product_link}">
                                            <img src="{$curr.logo}" class="attachment-shop_thumbnail wp-post-image" alt="{$curr.title}" height="70" width="70">
                                        </a>
                                    </figure>
                                    <div class="bag-product-details">
                                        <div class="bag-product-title">
                                            <a class="title-link" href="{$curr.product_link}">
                                                {$curr.title}
                                            </a>
                                        </div>
                                        <div class="bag-product-category">
                                            <a class="category-link" href="{$curr.category_link}">{$curr.category_title}</a>
                                        </div>
                                        <div class="bag-product-price">{$curr.price|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}</div>
                                    </div>
                                    <a href="{$BaseURL}item-to-cart{$Config.webPageFileType}" onclick="deleteSomeItemFromShoppingCart({$curr.product_id}); return false;" class="remove-item remove-{$curr.product_id}" title="{$lang.front.deleteThisItem}"></a>
                                </div>
                            {/foreach}
                        </div>
                        <div class="bag-buttons">
                            <a class="to-cart-button" href="{$BaseURL}cart{$Config.webPageFileType}">
                                <span>{$lang.front.goToCart}</span>
                            </a>
                        </div>
                    {else}
                        <div class="bag-header">{$lang.front.emptyCartBlock}</div>
                    {/if}
                </div>
            </li>
        </ul>
    </li>
</ul>