<div class="home-slider-wrap">
    {if $mainSlider && $mainSlider|@count > 0}
        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#f7f7f7;padding:0px;margin-top:0px;margin-bottom:0px;max-height:527px;">
            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;max-height:527px;height:527;">
                <ul>
                    {foreach from=$mainSlider item=curr name="mainslide"}
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="300">
                            <img src="{$HOST}images/tpl/transparent.png" style='background-color:#244386' alt="ff_rev_slider_bkg_roshe_test" data-lazyload="{$HOST}images/tpl/transparent.png" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                            <div class="tp-caption lfb"
                                 data-x="0"
                                 data-y="0"
                                 data-speed="300"
                                 data-start="500"
                                 data-easing="easeOutExpo"
                                 data-endspeed="300"
                                 style="z-index: 2">
                                <img src="{$HOST}{$curr.bg}" alt="">
                            </div>
                        {foreach from=$curr.elements item=subcurr name="elslide"}
                            <div class="tp-caption lfb"
                                 data-x="{$subcurr.data_x}"
                                 data-y="{$subcurr.data_y}"
                                 data-speed="{$subcurr.data_speed}"
                                 data-start="{$subcurr.data_start}"
                                 data-easing="easeOutExpo"
                                 data-endspeed="300"
                                 style="z-index: {$subcurr.data_start}
                                 {if $subcurr.type eq 1 && $subcurr.text_colorcode}; color:{$subcurr.text_colorcode};{/if}" >
                                {if $subcurr.type eq 1}
                                    {$subcurr.text}
                                {elseif $subcurr.type eq 2}
                                    <a href="{$subcurr.link}">
                                        <img src="{$HOST}{$subcurr.imagePath}" alt="">
                                    </a>
                                {elseif $subcurr.type eq 3}
                                    <a href='{$subcurr.link}' class='site-button-more' style="">{$subcurr.button_text}</a>
                                {/if}
                            </div>
                        {/foreach}
                        </li>
                    {/foreach}
                </ul>
            </div>
        </div>
    {/if}
</div>
{literal}
    <script type="text/javascript">

        var tpj=jQuery;

        var revapi1;

        tpj(document).ready(function() {

            if(tpj('#rev_slider_1_1').revolution == undefined)
                revslider_showDoubleJqueryError('#rev_slider_1_1');
            else
                revapi1 = tpj('#rev_slider_1_1').show().revolution(
                        {
                            delay:9000,
                            startwidth:1170,
                            startheight:527,
                            hideThumbs:200,

                            thumbWidth:100,
                            thumbHeight:50,
                            thumbAmount:4,

                            navigationType:"bullet",
                            navigationArrows:"solo",
                            navigationStyle:"round",

                            touchenabled:"on",
                            onHoverStop:"on",

                            navigationHAlign:"center",
                            navigationVAlign:"bottom",
                            navigationHOffset:0,
                            navigationVOffset:20,

                            soloArrowLeftHalign:"left",
                            soloArrowLeftValign:"center",
                            soloArrowLeftHOffset:20,
                            soloArrowLeftVOffset:0,

                            soloArrowRightHalign:"right",
                            soloArrowRightValign:"center",
                            soloArrowRightHOffset:20,
                            soloArrowRightVOffset:0,

                            shadow:0,
                            fullWidth:"on",
                            fullScreen:"off",

                            stopLoop:"off",
                            stopAfterLoops:-1,
                            stopAtSlide:-1,


                            shuffle:"off",

                            autoHeight:"off",
                            forceFullWidth:"off",

                            hideThumbsOnMobile:"off",
                            hideBulletsOnMobile:"off",
                            hideArrowsOnMobile:"off",
                            hideThumbsUnderResolution:0,

                            hideSliderAtLimit:0,
                            hideCaptionAtLimit:0,
                            hideAllCaptionAtLilmit:0,
                            startWithSlide:0,
                            videoJsPath:"http://neighborhood.swiftideas.net/wp-content/plugins/revslider/rs-plugin/videojs/",
                            fullScreenOffsetContainer: ""
                        });

        });	//ready

    </script>
{/literal}
<div class="container">
<div id="page-wrap">
<div class="inner-page-wrap has-no-sidebar no-bottom-spacing no-top-spacing clearfix">
<div class="page type-page status-publish hentry clearfix instock">
<div class="page-content clearfix">
{if $productPopularArray && $productPopularArray|@count > 0}
    <div class="blank_spacer span12 " style="height:55px;"></div>
    <div class="row">
        <div class="product_list_widget products-standard woocommerce spb_content_element span12">
            <div class="spb_wrapper">
                <h4 class="spb_heading"><span>{$ProductBlock.1.blockTitle}</span></h4>
                <div class="product-carousel" data-columns="4">
                    <div class="carousel-overflow">
                        <ul class="products list-latest-products">
                            {foreach from=$productPopularArray item=curr name="popular"}
                                <li class="product type-product status-publish hentry sale instock">
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
                                                <a href="{$BaseURL}item-to-cart{$Config.webPageFileType}" onclick="addSomeItemToShoppingCart({$curr.product_id}); return false;" rel="nofollow" id="a-{$curr.product_id}" class="add_to_cart_button product_type_simple"  data-added_text="{$lang.front.productWasAddedToCart}">
                                                    {$lang.front.addToCart}
                                                </a>
                                            </div>
                                        </figcaption>
                                    </figure>
                                    <div class="product-details">
                                        <h3><a href="{$curr.link}">{$curr.categoryTitle}</a></h3>
                                        <span class="posted_in"><a href="{$curr.category_link}" rel="tag">{$curr.categoryTitle}</a></span>
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
            </div>
        </div>
    </div>
{/if}
<div class="row">
    <div id="super-action-place"></div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            <h4 class="spb_heading"><span>{$lang.front.services}</span></h4>
            {if $servicesArray|@count > 0}
                <ul class="mini-list mini-best-sellers">
                    {foreach from=$servicesArray item=curr name="services"}
                        <li class="clearfix" itemscope itemtype="#">
                            <figure>
                                <a href="{$curr.link}">
                                    <img itemprop="image" src="{$curr.image}" width="70" height="70" alt="{$curr.servicesTitle}" title="{$curr.servicesTitle}" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 class="service-name">
                                    <a href="{$curr.link}">{$curr.servicesTitle}</a>
                                </h5>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            {if $productDiscountArray && $productDiscountArray|@count > 0}
                <h4 class="spb_heading"><span>{$ProductBlock.2.blockTitle}</span></h4>
                <ul class="mini-list mini-top-rated">
                    {foreach from=$productDiscountArray item=curr name="discount"}
                        <li class="clearfix">
                            <figure>
                                <a href="{$curr.link}">
                                    <img itemprop="image" src="{$curr.image_logo}" width="70" height="70" alt="{$curr.productTitle}" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 itemprop="name">
                                    <a href="{$curr.link}">{$curr.productTitle}</a>
                                </h5>
                                <span class="product-cats">
                                    <a href="{$curr.category_link}" rel="tag">{$curr.categoryTitle}</a>
                                </span>
                                <span class="price" itemprop="price">
                                    {if $curr.old_price > 0}
                                        <del><span class="amount">{$curr.old_price|string_format:"%d"} {$Config.currencySymbol}</span></del>
                                    {/if}
                                    <span class="amount">{$curr.price|string_format:"%d"} {$Config.currencySymbol}</span>
                                </span>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            {if $productBestArray && $productBestArray|@count > 0}
                <h4 class="spb_heading"><span>{$ProductBlock.3.blockTitle}</span></h4>
                <ul class="mini-list mini-sale-products">
                    {foreach from=$productBestArray item=curr name="bestceller"}
                        <li class="clearfix">
                            <figure>
                                <a href="{$curr.link}">
                                    <img itemprop="image" src="{$curr.image_logo}" width="70" height="70" alt="{$curr.productTitle}" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 itemprop="name">
                                    <a href="{$curr.link}">{$curr.productTitle}</a>
                                </h5>
                                <span class="product-cats">
                                    <a href="{$curr.category_link}" rel="tag">{$curr.categoryTitle}</a>
                                </span>
                                <span class="price" itemprop="price">
                                    <span class="amount">{$curr.price|string_format:"%d"} {$Config.currencySymbol}</span>
                                </span>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
    <div class="spb_posts_carousel_widget spb_content_element span3" >
        <div class="spb_wrapper carousel-wrap" id="site-banner">
            {$Banner|unescape}
        </div>
    </div>
</div>

<div class="blank_spacer span12 " style="height:5px;"></div>

<div class="row">
    <div class="spb_posts_carousel_widget spb_content_element span12">
        <div class="spb_wrapper carousel-wrap">
            {if $newsArray|@count > 0}
                <h4 class="spb_heading"><span>{$lang.front.news}</span></h4>
                <ul id="carousel-2" class="blog-items carousel-items clearfix" data-columns="4">
                    {foreach from=$newsArray item=curr name="sitenews"}
                        <li itemscope data-id="id-0" class="clearfix carousel-item recent-post span3">
                            <div class="news-each">
                                <div class="news-date">{$curr.publication_date|date_format:"%d.%m.%Y"}</div>
                                <div class="news-title">{$curr.newsTitle}</div>
                                <div class="news-text">
                                    <p>
                                        {$curr.newsDescription|unescape}&nbsp;
                                        <a class="news-more" href="{$curr.link}">{$lang.front.more}</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    {/foreach}
                </ul>
            {/if}
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>