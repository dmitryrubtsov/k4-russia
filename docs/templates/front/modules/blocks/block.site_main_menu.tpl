<nav>
    <ul id="nav">
        {foreach from=$siteMainMenu item=menuItem name=mainMenu}
            {assign var="item" value=$menuItem->getItem()}
            <li>
                <a class="hsubs current_page m" href="{$HOST}{$item.link}">{$item.title}</a>
                {if $menuItem->hasChildNodes()}
                    <ul class="subs">
                        {foreach from=$menuItem->getSortedChildNodes('position') item=subMenuItem}
                            {assign var="submenu" value=$subMenuItem->getItem()}
                            <li><a href="{$HOST}{$submenu.link}">{$submenu.title}</a></li>
                        {/foreach}
                    </ul>
                {/if}
                {if $item.menu_id eq 12}
                    <ul class="subs">
                        {foreach from=$productsArray item=product}
                            <li><a href="{$BaseURL}product{$Config.linkPartSeparator}{$product.linkname}{$Config.AdminLinkNameDelim}{$product.product_id}">{$product.title}</a></li>
                        {/foreach}
                    </ul>
                {/if}
            </li>
        {/foreach}
    </ul>
</nav>