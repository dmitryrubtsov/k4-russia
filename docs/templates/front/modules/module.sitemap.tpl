<div id="sitemap-block">
    <ul>
        {foreach from=$siteMenuMain item=menuItem name=mainMenu}
            {assign var="item" value=$menuItem->getItem()}
            <li>
                <a href="{$HOST}{$item.link}" class="main-link">{$item.title}</a>
                {if $menuItem->hasChildNodes()}
                    <ul>
                        {foreach from=$menuItem->getSortedChildNodes('position') item=subMenuItem}
                            {assign var="submenu" value=$subMenuItem->getItem()}
                            <li>
                                <a href="{$HOST}{$submenu.link}">{$submenu.title}</a>
                                {*
                                {if $submenu.menu_id eq 82}
                                    <ul>
                                        {foreach from=$MedicalCenterArr item=center}
                                            <li><a href="{$center.link}">{$center.medCenterTitle}</a></li>
                                        {/foreach}
                                    </ul>
                                {/if}
*}
                            </li>
                        {/foreach}
                    </ul>
                {/if}
                {if $item.menu_id eq 69}
                    <ul>
                        {foreach from=$CategoriesArr item=curr key=key name="category"}
                            <li>
                                <a href="{$curr.link}">{$curr.categoryTitle}</a>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
                {if $item.menu_id eq 9}
                    <ul>
                        {foreach from=$ServicesArr item=curr key=key name="service"}
                            <li>
                                <a href="{$curr.link}">{$curr.serviceTitle}</a>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
            </li>
        {/foreach}
    </ul>
</div>