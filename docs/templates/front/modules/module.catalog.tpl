<form id="catalog" name="maincatalog" method="get">
    <div class="inner-page-wrap woocommerce-shop-page has-left-sidebar has-one-sidebar row clearfix">
        <section class="span9 push-right clearfix">
            {if $Items && $Items|@count > 0}
                <div class="page-content clearfix">
                    <div class="woocommerce-count-wrap">
                        <p class="woocommerce-result-count">Показаны 1-{$Items|@count} из {$Items|@count}</p>
                        <p class="woocommerce-show-products">
                            <span>Показать: </span>
                            <a class="show-products-link" href="/">24</a>/
                            <a class="show-products-link" href="/">48</a>/
                            <a href="/">Все</a>
                        </p>
                    </div>
                    <div class="woocommerce-ordering">
                        <select name="orderby" class="orderby">
                            <option value="" {if !$smarty.get.orderby}selected='selected'{/if}>{$lang.front.sortBy}</option>
                            <option value="height" {if $smarty.get.orderby eq 'height'}selected='selected'{/if} >{$lang.front.sortByHeight}</option>
                            <option value="width" {if $smarty.get.orderby eq 'width'}selected='selected'{/if} >{$lang.front.sortByWidth}</option>
                            <option value="scale" {if $smarty.get.orderby eq 'scale'}selected='selected'{/if} >{$lang.front.sortByScale}</option>
                            <option value="price" {if $smarty.get.orderby eq 'price'}selected='selected'{/if} >{$lang.front.sortByPrice}</option>
                        </select>
                    </div>
                    <ul class="products">
                        {foreach from=$Items item=curr name="products"}
                            <li class="product type-product status-publish hentry {if $smarty.foreach.products.iteration % 3 == 1}first{elseif $smarty.foreach.products.iteration % 3 == 0}last{/if} instock">
                                <figure class="product-transition">
                                    {if $curr.labelTitle}
                                        <span class="{$curr.labelClass}">{$curr.labelTitle}</span>
                                    {/if}
                                    <a href="{$curr.link}">
                                        <div class="product-image">
                                            <img width="270" height="360" src="{$curr.item_image}" class="attachment-shop_catalog" alt="{$curr.productTitle}" />
                                        </div>
                                        <div class="product-image">
                                            <img width="270" height="360" src="{$curr.item_image_hover}" class="attachment-shop_catalog" alt="{$curr.productTitle}" />
                                        </div>
                                    </a>
                                    <figcaption>
                                        <div class="shop-actions clearfix">
                                            <a href="{$BaseURL}item-to-cart{$Config.webPageFileType}" onclick="addSomeItemToShoppingCart({$curr.product_id}); return false;"  rel="nofollow" class="add_to_cart_button product_type_simple" id="a-{$curr.product_id}" data-added_text="{$lang.front.productWasAddedToCart}">
                                                {$lang.front.addToCart}
                                            </a>
                                        </div>
                                    </figcaption>
                                </figure>
                                <div class="product-details">
                                    <h3><a href="{$curr.link}">{$curr.productTitle}</a></h3>
                                    <span class="posted_in">
                                        <a href="{$curr.category_link}" rel="tag">{$curr.categoryTitle}</a>
                                    </span>
                                </div>
                                <span class="price">
                                    <span class="amount">
                                        {$curr.price|string_format:"%d"} <span class="currency">{$Config.currencySymbol}</span>
                                    </span>
                                </span>
                            </li>
                        {/foreach}
                    </ul>
                </div>
                {if $Paging.next && $Paging.next neq '0'}
                    <div class="show-more-block">
                        <a href="#" class="show-more-button">Показать ЕщЕ</a>
                    </div>
                {/if}
            {else}
                <div class="notice-board">
                    {$lang.site.noItemsForThisRequest}
                </div>
            {/if}
        </section>

        <aside class="sidebar left-sidebar span3">
            <section class="widget woocommerce widget_shopping_cart clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.site.artNumber}</span></h4>
                </div>
                <form action="" method="post">
                    <div id="art-search">
                        <input type="text" name="artvalue" {if $smarty.post.artvalue neq ''} value="{$smarty.post.artvalue}"{/if} class="art-search-field" />
                        <input type="submit" class="art-search-button button-show" value="{$lang.front.search}" />
                    </div>
                </form>
            </section>
        {if $categoriesArray && $categoriesArray|@count > 0}
            <section id="product_categories-2" class="widget woocommerce widget_product_categories clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.front.categories}</span></h4>
                </div>
                <ul class="check-item-param" id="category-list">
                    <li class="cat-item" {if $smarty.get.cat} style="display:none;" {/if}>
                        <input type="checkbox" id="cat-all" name="cat" value="1" rel="all" {if $smarty.get.cat} checked {/if} />
                        <label for="cat-all">{$lang.front.all}</label>
                        <div class="clear"></div>
                    </li>
                    <li class="selected" {if $smarty.get.cat} style="display:block;" {/if}>{$lang.front.all}</li>
                {foreach from=$categoriesArray item=curr name="categories"}
                    {assign var="cat" value='cat-'|cat:$curr.product_category_id}
                    <li class="cat-item" {if $smarty.get.$cat} style="display:none;"{/if}>
                        <input type="checkbox" id="cat-{$curr.product_category_id}" name="cat-{$curr.product_category_id}" value="1" {if $smarty.get.$cat} checked {/if} />
                        <label for="cat-{$curr.product_category_id}">{$curr.categoryTitle}</label>
                        <div class="clear"></div>
                    </li>
                    <li class="selected" {if $smarty.get.$cat} style="display:block;"{/if}>{$curr.categoryTitle}</li>
                {/foreach}
                </ul>
            </section>
        {/if}
            <section id="woocommerce_layered_nav-4" class="widget woocommerce widget_product_categories clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.front.mapType}</span></h4>
                </div>
                <ul class="check-item-param" id="type-list">
                    <li class="type-item" {if $smarty.get.type} style="display:none;" {/if}>
                        <input type="checkbox" name="type" id="type-all" value="1" rel="all" {if $smarty.get.type} checked {/if} />
                        <label for="type-all">{$lang.front.all}</label>
                        <div class="clear"></div>
                    </li>
                    <li class="selected" {if $smarty.get.type} style="display:block;" {/if}>{$lang.front.all}</li>
                {foreach from=$mapTypeArray item=curr name="types"}
                    {assign var="type" value='type-'|cat:$curr.product_section_type_id}
                    <li class="type-item" {if $smarty.get.$type} style="display:none;"{/if}>
                        <input type="checkbox" id="type-{$curr.product_section_type_id}" name="type-{$curr.product_section_type_id}" value="1" {if $smarty.get.$type} checked {/if} />
                        <label for="type-{$curr.product_section_type_id}">{$curr.sectionTypeTitle}</label>
                        <div class="clear"></div>
                    </li>
                    <li class="selected" {if $smarty.get.$type} style="display:block;"{/if}>{$curr.sectionTypeTitle}</li>
                {/foreach}
                </ul>
            </section>
            <section id="height-filter" class="widget woocommerce widget_price_filter clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.front.productHeight}</span></h4>
                </div>
                <div class="height_slider_wrapper">
                    <div class="height_slider" style="display:none;"></div>
                    <div class="height_slider_amount">
                        <input type="text" id="min_height" name="min_height" value="" data-min="0" placeholder="{$lang.front.minProductHeight}" />
                        <input type="text" id="max_height" name="max_height" value="" data-max="{$maxHeightOfItems}" placeholder="{$lang.front.maxProductHeight}" />
                        <div class="height_label" style="display:none;">
                            <span class="from"></span>
                            <span class="to"></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>
            <section id="" class="widget woocommerce widget_price_filter clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.front.productWidth}</span></h4>
                </div>
                <div class="width_slider_wrapper">
                    <div class="width_slider" style="display:none;"></div>
                    <div class="width_slider_amount">
                        <input type="text" id="min_width" name="min_width" value="" data-min="0" placeholder="{$lang.front.minProductWidth}" />
                        <input type="text" id="max_width" name="max_width" value="" data-max="{$maxWidthOfItems}" placeholder="{$lang.front.maxProductWidth}" />
                        <div class="width_label" style="display:none;">
                            <span class="from"></span>
                            <span class="to"></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>
            <section id="price_filter-2" class="widget woocommerce widget_price_filter clearfix">
                <div class="widget-heading clearfix">
                    <h4><span>{$lang.front.productCost}</span></h4>
                </div>
                <div class="price_slider_wrapper">
                    <div class="price_slider" style="display:none;"></div>
                    <div class="price_slider_amount">
                        <input type="text" id="min_price" name="min_price" value="" data-min="0" placeholder="{$lang.front.minProductCost}" />
                        <input type="text" id="max_price" name="max_price" value="" data-max="{$maxPriceOfItems|string_format:"%d"}" placeholder="{$lang.front.maxProductCost}" />
                        <div class="price_label" style="display:none;">
                            <span class="from"></span>
                            <span class="to"></span>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>
            <section id="side-form-button">
                <button type="submit" class="button-show"  onclick="document.forms['maincatalog'].submit();">{$lang.front.showButton}</button>
            </section>
            <section class="widget woocommerce widget_price_filter clearfix">
                <div id="left-column-banner">
                    <a href="#" class="link-to-post">
                        <img itemprop="image" src="images/tpl/banner.jpg" width="272" height="319" alt="Изготовление настенных карт" />
                    </a>
                </div>
            </section>
        </aside>
    </div>
</form>