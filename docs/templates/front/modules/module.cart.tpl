<form method="post" name="cart" id="delfrm" action="{$BaseURL}cart{$Config.webPageFileType}">
    <input type="hidden" name="task" value="deletefromcart" />
    <input type="hidden" name="row" value="" />
</form>
<script language="javascript">
    function deletefromcart(value)
    {ldelim}
        $(delfrm.row).val(value);
        $(delfrm).submit();
        {rdelim}
</script>

<div class="inner-page-wrap has-no-sidebar clearfix">
    <div class="page type-page status-publish hentry clearfix instock">
        <div class="page-content clearfix">
            {if $Cart.items && $Cart.items|@count > 0}
                <div class="woocommerce">
                    <form action="{$BaseURL}cart{$Config.webPageFileType}" method="post">
                        <input type="hidden" name="task" value="updatecart" />
                        <div class="row">
                            <div class="span9">
                                <h3 class="bag-summary">{$lang.site.yourProductsInCart} <span>({$Cart.total_count} {if in_array($Cart.total_count|substr:-2, array(11,12,13,14))} {$lang.site.product11}{else}{if $Cart.total_count|substr:-1 eq 1} {$lang.site.product1}{else} {$lang.site.product2}{/if}{/if})</span></h3>
                                <table class="shop_table cart" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="product-thumbnail">{$lang.front.productPhoto}</th>
                                            <th class="product-name">{$lang.front.productDescription}</th>
                                            <th class="product-price">{$lang.front.productPrice}</th>
                                            <th class="product-quantity">{$lang.front.productCount}</th>
                                            <th class="product-subtotal">{$lang.front.productSumm}</th>
                                            <th class="product-remove">&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {foreach from=$Cart.items item=curr key=key name="cartlist"}
                                        <tr class = "cart_table_item">
                                            <td class="product-thumbnail">
                                                <a href="{$curr.product_link}">
                                                    <img width="70" height="70" src="{$curr.logo}" class="attachment-shop_thumbnail wp-post-image" alt="{$curr.title}" />
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <div class="product-name-art">{$curr.number}</div>
                                                <div class="product-name-title">
                                                    <a href="{$curr.product_link}">{$curr.title}</a>
                                                </div>
                                                <div class="product-name-cat">
                                                    <a href="{$curr.category_link}">{$curr.category_title}</a>
                                                </div>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{$curr.price|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}</span>
                                            </td>
                                            <td class="product-quantity">
                                                <div class="quantity">
                                                    <input type="number" name="cart[{$key}]" step="1" min="" max="" value="{$curr.quantity}" size="4" title="{$lang.front.productCount}" class="input-text qty text" maxlength="12" />
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount">{$curr.subtotal|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}</span>
                                            </td>
                                            <td class="product-remove">
                                                <a onclick="deletefromcart('{$key}');" class="remove sf-roll-button" title="{$lang.front.deleteItemFromCart}">
                                                    <span>&times;</span>
                                                    <span>&times;</span>
                                                </a>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    </tbody>
                                </table>
                            </div>
                            <div class="span3">
                                <div class="cart_totals ">
                                    <h3>{$lang.front.totalSumm}</h3>
                                    <div id="general-summ-block">
                                        <span>{$Cart.total_price|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}</span>
                                    </div>
                                </div>
                                <input type="submit" class="update-cart-button" value="{$lang.front.updateCart}" />
                                <a href="{$BaseURL}order{$Config.webPageFileType}" class="popup-button"><span>{$lang.front.takeOrder}</span></a>
                                <a class="continue-shopping" href="{$BaseURL}catalog{$Config.webPageFileType}">{$lang.front.continueShopping}</a>
                            </div>
                        </div>
                    </form>
                    <div class="cart-collaterals"></div>
                </div>
            {else}
                <div class="notice-board">
                    {$lang.site.yourCartIsEmpty}
                </div>
            {/if}
        </div>
    </div>
</div>