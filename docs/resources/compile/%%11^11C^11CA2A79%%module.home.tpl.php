<?php /* Smarty version 2.6.16, created on 2014-03-25 18:21:42
         compiled from modules/module.home.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'modules/module.home.tpl', 2, false),array('modifier', 'count', 'modules/module.home.tpl', 2, false),array('modifier', 'string_format', 'modules/module.home.tpl', 164, false),array('modifier', 'unescape', 'modules/module.home.tpl', 269, false),array('modifier', 'date_format', 'modules/module.home.tpl', 285, false),)), $this); ?>
<div class="home-slider-wrap">
    <?php if (((is_array($_tmp=$this->_tpl_vars['mainSlider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['mainSlider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
        <div id="rev_slider_1_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" style="margin:0px auto;background-color:#f7f7f7;padding:0px;margin-top:0px;margin-bottom:0px;max-height:527px;">
            <div id="rev_slider_1_1" class="rev_slider fullwidthabanner" style="display:none;max-height:527px;height:527;">
                <ul>
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['mainSlider'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['mainslide'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['mainslide']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['mainslide']['iteration']++;
?>
                        <li data-transition="fade" data-slotamount="7" data-masterspeed="300">
                            <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
images/tpl/transparent.png" style='background-color:#244386' alt="ff_rev_slider_bkg_roshe_test" data-lazyload="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
images/tpl/transparent.png" data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat">
                            <div class="tp-caption lfb"
                                 data-x="0"
                                 data-y="0"
                                 data-speed="300"
                                 data-start="500"
                                 data-easing="easeOutExpo"
                                 data-endspeed="300"
                                 style="z-index: 2">
                                <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['curr']['bg'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="">
                            </div>
                        <?php $_from = ((is_array($_tmp=$this->_tpl_vars['curr']['elements'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['elslide'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['elslide']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['subcurr']):
        $this->_foreach['elslide']['iteration']++;
?>
                            <div class="tp-caption lfb"
                                 data-x="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['data_x'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                 data-y="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['data_y'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                 data-speed="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['data_speed'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                 data-start="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['data_start'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"
                                 data-easing="easeOutExpo"
                                 data-endspeed="300"
                                 style="z-index: <?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['data_start'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                                 <?php if (((is_array($_tmp=$this->_tpl_vars['subcurr']['type'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 1 && ((is_array($_tmp=$this->_tpl_vars['subcurr']['text_colorcode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>; color:<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['text_colorcode'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
;<?php endif; ?>" >
                                <?php if (((is_array($_tmp=$this->_tpl_vars['subcurr']['type'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 1): ?>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                                <?php elseif (((is_array($_tmp=$this->_tpl_vars['subcurr']['type'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 2): ?>
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                        <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['HOST'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'));  echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['imagePath'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" alt="">
                                    </a>
                                <?php elseif (((is_array($_tmp=$this->_tpl_vars['subcurr']['type'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) == 3): ?>
                                    <a href='<?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
' class='site-button-more' style=""><?php echo ((is_array($_tmp=$this->_tpl_vars['subcurr']['button_text'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; endif; unset($_from); ?>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php echo '
    <script type="text/javascript">

        var tpj=jQuery;

        var revapi1;

        tpj(document).ready(function() {

            if(tpj(\'#rev_slider_1_1\').revolution == undefined)
                revslider_showDoubleJqueryError(\'#rev_slider_1_1\');
            else
                revapi1 = tpj(\'#rev_slider_1_1\').show().revolution(
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
'; ?>

<div class="container">
<div id="page-wrap">
<div class="inner-page-wrap has-no-sidebar no-bottom-spacing no-top-spacing clearfix">
<div class="page type-page status-publish hentry clearfix instock">
<div class="page-content clearfix">
<?php if (((is_array($_tmp=$this->_tpl_vars['productPopularArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['productPopularArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
    <div class="blank_spacer span12 " style="height:55px;"></div>
    <div class="row">
        <div class="product_list_widget products-standard woocommerce spb_content_element span12">
            <div class="spb_wrapper">
                <h4 class="spb_heading"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['ProductBlock']['1']['blockTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></h4>
                <div class="product-carousel" data-columns="4">
                    <div class="carousel-overflow">
                        <ul class="products list-latest-products">
                            <?php $_from = ((is_array($_tmp=$this->_tpl_vars['productPopularArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['popular'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['popular']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['popular']['iteration']++;
?>
                                <li class="product type-product status-publish hentry sale instock">
                                    <figure class="product-transition">
                                        <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['labelTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))): ?>
                                            <span class="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['labelClass'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['labelTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
                                        <?php endif; ?>
                                        <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                            <div class="product-image">
                                                <img width="270" height="360" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['image_item'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="attachment-shop_catalog" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                                            </div>
                                            <div class="product-image">
                                                <img width="270" height="360" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['image_item_hover'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="attachment-shop_catalog" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                                            </div>
                                        </a>
                                        <figcaption>
                                            <div class="shop-actions clearfix">
                                                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['BaseURL'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
item-to-cart<?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['webPageFileType'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" onclick="addSomeItemToShoppingCart(<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['product_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
); return false;" rel="nofollow" id="a-<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['product_id'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" class="add_to_cart_button product_type_simple"  data-added_text="<?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['productWasAddedToCart'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['addToCart'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>

                                                </a>
                                            </div>
                                        </figcaption>
                                    </figure>
                                    <div class="product-details">
                                        <h3><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['categoryTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></h3>
                                        <span class="posted_in"><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['category_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" rel="tag"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['categoryTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a></span>
                                    </div>
                                    <span class="price">
                                        <span class="amount"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
 <span class="currency"><?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['currencySymbol'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></span>
                                    </span>
                                </li>
                            <?php endforeach; endif; unset($_from); ?>
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
<?php endif; ?>
<div class="row">
    <div id="super-action-place"></div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            <h4 class="spb_heading"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['services'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></h4>
            <?php if (count(((is_array($_tmp=$this->_tpl_vars['servicesArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
                <ul class="mini-list mini-best-sellers">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['servicesArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['services'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['services']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['services']['iteration']++;
?>
                        <li class="clearfix" itemscope itemtype="#">
                            <figure>
                                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                    <img itemprop="image" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['image'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="70" height="70" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['servicesTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['servicesTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 class="service-name">
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['servicesTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                </h5>
                            </div>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            <?php if (((is_array($_tmp=$this->_tpl_vars['productDiscountArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['productDiscountArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
                <h4 class="spb_heading"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['ProductBlock']['2']['blockTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></h4>
                <ul class="mini-list mini-top-rated">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['productDiscountArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['discount'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['discount']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['discount']['iteration']++;
?>
                        <li class="clearfix">
                            <figure>
                                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                    <img itemprop="image" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['image_logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="70" height="70" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 itemprop="name">
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                </h5>
                                <span class="product-cats">
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['category_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" rel="tag"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['categoryTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                </span>
                                <span class="price" itemprop="price">
                                    <?php if (((is_array($_tmp=$this->_tpl_vars['curr']['old_price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) > 0): ?>
                                        <del><span class="amount"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['old_price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['currencySymbol'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></del>
                                    <?php endif; ?>
                                    <span class="amount"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['currencySymbol'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
                                </span>
                            </div>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="product_list_widget woocommerce spb_content_element span3">
        <div class="spb_wrapper">
            <?php if (((is_array($_tmp=$this->_tpl_vars['productBestArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')) && count(((is_array($_tmp=$this->_tpl_vars['productBestArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
                <h4 class="spb_heading"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['ProductBlock']['3']['blockTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></h4>
                <ul class="mini-list mini-sale-products">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['productBestArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['bestceller'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['bestceller']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['bestceller']['iteration']++;
?>
                        <li class="clearfix">
                            <figure>
                                <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
">
                                    <img itemprop="image" src="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['image_logo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" width="70" height="70" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" />
                                </a>
                            </figure>
                            <div class="product-details">
                                <h5 itemprop="name">
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['productTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                </h5>
                                <span class="product-cats">
                                    <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['category_link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" rel="tag"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['categoryTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                </span>
                                <span class="price" itemprop="price">
                                    <span class="amount"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['price'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('string_format', true, $_tmp, "%d") : smarty_modifier_string_format($_tmp, "%d")); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['Config']['currencySymbol'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span>
                                </span>
                            </div>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="spb_posts_carousel_widget spb_content_element span3" >
        <div class="spb_wrapper carousel-wrap" id="site-banner">
            <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['Banner'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>

        </div>
    </div>
</div>

<div class="blank_spacer span12 " style="height:5px;"></div>

<div class="row">
    <div class="spb_posts_carousel_widget spb_content_element span12">
        <div class="spb_wrapper carousel-wrap">
            <?php if (count(((is_array($_tmp=$this->_tpl_vars['newsArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html'))) > 0): ?>
                <h4 class="spb_heading"><span><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['news'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</span></h4>
                <ul id="carousel-2" class="blog-items carousel-items clearfix" data-columns="4">
                    <?php $_from = ((is_array($_tmp=$this->_tpl_vars['newsArray'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sitenews'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sitenews']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['curr']):
        $this->_foreach['sitenews']['iteration']++;
?>
                        <li itemscope data-id="id-0" class="clearfix carousel-item recent-post span3">
                            <div class="news-each">
                                <div class="news-date"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['publication_date'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
</div>
                                <div class="news-title"><?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['newsTitle'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</div>
                                <div class="news-text">
                                    <p>
                                        <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['curr']['newsDescription'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')))) ? $this->_run_mod_handler('unescape', true, $_tmp) : smarty_modifier_unescape($_tmp)); ?>
&nbsp;
                                        <a class="news-more" href="<?php echo ((is_array($_tmp=$this->_tpl_vars['curr']['link'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['lang']['front']['more'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</a>
                                    </p>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; endif; unset($_from); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>