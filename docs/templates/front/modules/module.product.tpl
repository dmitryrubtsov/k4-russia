{*{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.add_to_cart.tpl"}
*}
<div class="inner-page-wrap has-no-sidebar clearfix">
    <article class="product type-product status-publish hentry clearfix row instock" itemscope itemtype="/">
        <div class="page-content span12 clearfix">
            <section class="article-body-wrap">
                <div itemscope itemtype="/" class="product type-product status-publish hentry instock">
                    <div class="entry-title" itemprop="name">{$productInfo.title}</div>
                    <div class="images">
                        <div id="product-img-slider" class="flexslider">
                            <ul class="slides">
                                {foreach from=$productInfo.images item=curr key=key name="images"}
                                    <li itemprop="image">
                                        <img class="product-slider-image" data-zoom-image="{$curr.image}" src="{$curr.image}" width="570" />
                                        {if $productInfo.gallery}
                                            <a href="{$curr.image}" itemprop="image" class="woocommerce-main-image zoom" title="{$productInfo.title}"  rel="prettyPhoto[product-gallery]">
                                                <i class="fa-expand"></i>
                                            </a>
                                        {/if}
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                        {if $productInfo.gallery}
                            <div id="product-img-nav" class="flexslider">
                                <ul class="slides">
                                    {foreach from=$productInfo.images item=curr key=key name="smallimages"}
                                        <li itemprop="image">
                                            <img src="{$curr.image}" class="attachment-shop_thumbnail wp-post-image" alt="{$productInfo.title}" />
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}
                    </div>
                    <div class="summary entry-summary">
                        <div class="summary-top clearfix">
                            <div itemprop="offers" itemscope itemtype="/">
                                <p itemprop="price" class="price">
                                    {if $productInfo.old_price > 0}
                                        <del><span class="oldprice">{$productInfo.old_price|string_format:"%d"} {$Config.currencySymbol}</span></del>
                                    {/if}
                                    <ins><span class="currprice">{$productInfo.price|string_format:"%d"} {$Config.currencySymbol}</span></ins>
                                </p>
                            </div>
                            <div class="product-navigation">
                                <div class="nav-previous">
                                    {if $productInfo.prev_product_link}
                                        <a href="{$productInfo.prev_product_link}" rel="prev" title="{$lang.front.nextProduct}">
                                            <i class="fa-angle-right"></i>
                                        </a>
                                    {/if}
                                </div>
                                <div class="nav-next">
                                    {if $productInfo.next_product_link}
                                        <a href="{$productInfo.next_product_link}" rel="next" title="{$lang.front.prevProduct}">
                                            <i class="fa-angle-left"></i>
                                        </a>
                                    {/if}
                                </div>
                            </div>
                        </div>
                        <div class="item-description-block">{$productInfo.description}</div>
                        <div class="item-description-table-block">
                            <table class="shop_attributes">
                                <tr class="">
                                    <th><span>{$lang.front.productCategory}:</span></th>
                                    <td>{$productInfo.category_title}</td>
                                </tr>
                            {if $productInfo.product_section_type_title}
                                <tr class="alt">
                                    <th><span>{$lang.front.type}:</span></th>
                                    <td>{$productInfo.product_section_type_title}</td>
                                </tr>
                            {/if}
                                <tr class="">
                                    <th><span>{$lang.site.artNumber}:</span></th>
                                    <td>{$productInfo.number}</td>
                                </tr>
                            {if $productInfo.product_height}
                                <tr class="alt">
                                    <th><span>{$lang.front.productHeight}:</span></th>
                                    <td>{$productInfo.product_height} {$Config.unitWidthAndHeight}</td>
                                </tr>
                            {/if}
                            {if $productInfo.product_width}
                                <tr class="alt">
                                    <th><span>{$lang.front.productWidth}:</span></th>
                                    <td>{$productInfo.product_width} {$Config.unitWidthAndHeight}</td>
                                </tr>
                            {/if}
                            {if $productInfo.product_scale}
                                <tr class="alt">
                                    <th><span>{$lang.front.productScale}:</span></th>
                                    <td>1 : {$productInfo.product_scale|number_format:-3:" ":" "}</td>
                                </tr>
                            {/if}
                            </table>
                        </div>
                    {if $productInfo.product_section_id eq 1}
                        <div class="item-description-section color-blue">
                            {$lang.site.productPricesTooltip}
                        </div>
                        <div class="item-description-section color-green">
                            <table>
                                <tr>
                                    <td>{$lang.site.price1Tooltip}:&nbsp;&nbsp;&nbsp;</td>
                                    <td>{$productInfo.price|string_format:"%d"} {$Config.currencySymbol}</td>
                                </tr>
                            {if $productInfo.price2 > 0}
                                <tr>
                                    <td>{$lang.site.price2Tooltip}:&nbsp;&nbsp;&nbsp;</td>
                                    <td>{$productInfo.price2|string_format:"%d"} {$Config.currencySymbol}</td>
                                </tr>
                            {/if}
                            {if $productInfo.price3 > 0}
                                <tr>
                                    <td>{$lang.site.price3Tooltip}:&nbsp;&nbsp;&nbsp;</td>
                                    <td>{$productInfo.price3|string_format:"%d"} {$Config.currencySymbol}</td>
                                </tr>
                            {/if}
                            </table>
                        </div>
                    {/if}

                        <div id="item-button-to-cart">
                            <form action="{$BaseURL}cart{$Config.webPageFileType}" class="cart" method="post" enctype='multipart/form-data'>
                                {if $productInfo.product_section_id eq 1}
                                    <div class="item-select-type">
                                        <select id="mysel" name="pricetype" class="type">
                                            <option value="price" selected='selected' >{$lang.site.productDesignOption}</option>
                                            <option value="price">{$lang.site.price1Tooltip}</option>
                                        {if $productInfo.price2 > 0}
                                            <option value="price2">{$lang.site.price2Tooltip}</option>
                                        {/if}
                                        {if $productInfo.price3 > 0}
                                            <option value="price3">{$lang.site.price3Tooltip}</option>
                                        {/if}
                                        </select>
                                    </div>
                                {/if}
                                <input type="hidden" name="task" value="addtocart" />
                                <input type="hidden" name="id" value="{$productInfo.product_id}" />
                                <input type="hidden" name="time" value="{$smarty.now}" />
                                <div class="quantity">
                                    <input type="number" step="1" min="1"  name="quantity" value="1" title="Qty" class="input-text qty text" />
                                </div>
                                <button type="submit" class="item_add_to_cart_button">{$lang.front.addToCart}</button>
                            </form>
                        </div>

                        <div class="product-share clearfix">
                            <ul>
                                <li>
                                    <a href="/" >
                                        <img src="images/like_facebook.jpg" width="185" height="20" />
                                    </a>
                                </li>
                                <li>
                                    <a href="/" >
                                        <img src="images/like_vk.jpg" width="143" height="20" />
                                    </a>
                                </li>
                                <li>
                                    <a href="/" >
                                        <img src="images/like_twitter.jpg" width="137" height="20" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    {if $productInfo.recommend}
                        <div class="related products product-carousel" data-columns="4">
                            <h4 class="lined-heading"><span>{$lang.site.recommendForBuy}</span></h4>
                            <div class="carousel-overflow">
                                <ul class="products">
                                    {foreach from=$productInfo.recommend item=curr key=key name="recommend"}
                                        <li class="product type-product status-publish hentry instock">
                                            <figure class="product-transition">
                                                {if $curr.labelTitle}
                                                    <span class="{$curr.labelClass}">{$curr.labelTitle}</span>
                                                {/if}
                                                <a href="{$curr.link}">
                                                    <div class="product-image">
                                                        <img width="270" height="360" src="{$curr.image_item}" class="attachment-shop_catalog" alt="{$curr.productTitle}" />
                                                    </div>
                                                    <div class="product-image">
                                                        <img width="270" height="360" src="{$curr.image_item_hover}" class="attachment-shop_catalog" alt="{$curr.productTitle}" />
                                                    </div>
                                                </a>
                                                <figcaption>
                                                    <div class="shop-actions clearfix">
                                                        <a href="{$BaseURL}item-to-cart{$Config.webPageFileType}" onclick="addSomeItemToShoppingCart({$curr.product_id}); return false;" rel="nofollow" class="add_to_cart_button product_type_simple" id="a-{$curr.product_id}" data-added_text="{$lang.front.productWasAddedToCart}">
                                                            {$lang.front.addToCart}
                                                        </a>
                                                    </div>
                                                </figcaption>
                                            </figure>
                                            <div class="product-details">
                                                <h3>
                                                    <a href="{$curr.link}">{$curr.categoryTitle}</a>
                                                </h3>
                                                <span class="posted_in">
                                                    <a href="{$curr.category_link}" rel="tag">{$curr.categoryTitle}</a>
                                                </span>
                                            </div>
                                            <span class="price">
                                                <span class="amount">{$curr.price|string_format:"%d"} <span class="currency">{$Config.currencySymbol}</span></span>
                                            </span>
                                        </li>
                                    {/foreach}
                                </ul>
                            </div>
                            <a href="#" class="prev">
                                <i class="fa-chevron-left"></i>
                            </a>
                            <a href="#" class="next">
                                <i class="fa-chevron-right"></i>
                            </a>
                        </div>
                    {/if}
                </div>
            </section>
        </div>
    </article>
</div>