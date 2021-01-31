<h3 class="bag-summary">{$lang.site.yourProductsInCart} <span>({$Cart.total_count} {if in_array($Cart.total_count|substr:-2, array(11,12,13,14))} {$lang.site.product11}{else}{if $Cart.total_count|substr:-1 eq 1} {$lang.site.product1}{else} {$lang.site.product2}{/if}{/if})</span></h3>
<table border="1" cellspacing="0">
    <thead>
    <tr>
        <th>{$lang.front.productPhoto}</th>
        <th>{$lang.front.productDescription}</th>
        <th>{$lang.front.productPrice}</th>
        <th>{$lang.front.productCount}</th>
        <th>{$lang.front.productSumm}</th>
    </tr>
    </thead>
    <tbody>
    {foreach from=$Cart.items item=curr key=key name="cartlist"}
        <tr class>
            <td>
                <a href="{$curr.product_link}">
                    <img width="70" height="70" src="{$curr.logo}" class="attachment-shop_thumbnail wp-post-image" alt="{$curr.title}" />
                </a>
            </td>
            <td>
                <div>{$curr.number}</div>
                <div>
                    <a href="{$curr.product_link}">{$curr.title}</a>
                </div>
                <div>
                    <a href="{$curr.category_link}">{$curr.category_title}</a>
                </div>
            </td>
            <td>
                {$curr.price|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}
            </td>
            <td>
                <center>{$curr.quantity}</center>
            </td>
            <td>
                {$curr.subtotal|string_format:"%d"|number_format:-3:" ":" "} {$Config.currencySymbol}
            </td>
        </tr>
    {/foreach}
    </tbody>
</table>