<div class="inner-page-wrap has-no-sidebar clearfix">
    <div class="page type-page status-publish hentry clearfix instock">
        <div class="page-content clearfix">
            <div class="woocommerce">
                <div class="row">
                    <div class="span9">
                        <div class="content-area">
                            <div id="order-form-page">
                                <h2>{$lang.front.dataForOrder}</h2>
                                <form method="post" action="{$BaseURL}send-form-order{$Config.webPageFileType}">
                                    <input type="hidden" name="task" value="order" />
                                    <input type="hidden" name="success" value="{$BaseURL}order-final{$Config.webPageFileType}" />
                                    <div class="order-form-row">
                                        <input type="text" name="name" value="" class="req-field input-form" title="{$lang.front.yourName}*" />
                                    </div>
                                    <div class="form-error"></div>
                                    <div class="order-form-row">
                                        <input type="text" name="email" value="" class="req-field input-form" title="{$lang.front.yourEmail}*" />
                                    </div>
                                    <div class="form-error"></div>
                                    <div class="order-form-row">
                                        <input type="text" name="phone" value="" class="req-field input-form" title="{$lang.front.yourPhone}*" />
                                    </div>
                                    <div class="order-form-row">
                                        <textarea name="comment" class="input-form " title="{$lang.front.orderComment}"></textarea>
                                    </div>
                                    <div class="order-form-row">
                                        {$lang.front.takeOrder}* <span>(<a href="#" onclick="show_modal('#delivery-text'); return false;">{$lang.front.deliveryDetails}</a>)</span>
                                    </div>
                                    <div class="order-form-delivery">
                                        <table class="delivery-tab">
                                            <tr>
                                            {foreach from=$OrderDeliveryArray item=curr name="delivery"}
                                                {if $curr.image}
                                                <td>
                                                    <label for="del-{$curr.order_delivery_id}">
                                                        <img src="{$curr.image}" title="{$curr.deliveryTitle}" alt="{$curr.deliveryTitle}" />
                                                    </label>
                                                </td>
                                                {/if}
                                                <td class="field">
                                                    <input type="radio" id="del-{$curr.order_delivery_id}" name="delivery" value="{$curr.order_delivery_id}" />
                                                </td>
                                                <td>
                                                    <label for="del-{$curr.order_delivery_id}">{$curr.deliveryTitle}</label>
                                                </td>
                                            {/foreach}
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="form-error"></div>
                                    <div class="order-form-row">
                                        <input type="text" name="secretcode" value="" class="input-form req-field" title="Введите анти спам код*"  maxlength="{$Config.secureImageSymbols}" />
                                    </div>
                                    <div class="order-form-cptch">
                                        <img src="{validate_url url=$HOST url1='showcode' url2=$Config.webPageFileType url3='?sessid=' url4=$session}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" />
                                        <a href="#" class="cptch">{$lang.front.refreshCode}</a>
                                    </div>
                                    <div class="order-form-req">
                                        {$lang.front.requiredFields}
                                    </div>
                                    <div class="form-not-send">{$lang.contacts.youMustCompleteAllFields}</div>
                                    <div class="order-form-button">
                                        <input type="button" class="checkout-button df-form-submit" name="proceed" value="{$lang.front.takeOrder}" />
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="span3 sidebar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="popup" id="delivery-text">
    <div class="popup-header">
        <a href="#" class="close" onclick="return false;"></a>
        <h3>{$DeliveryArticle.title}</h3>
    </div>
    <div class="popup-body">{$DeliveryArticle.text}</div>
</div>