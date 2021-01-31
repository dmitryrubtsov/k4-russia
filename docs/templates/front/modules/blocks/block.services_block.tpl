{if $servicesBlockArray|@count > 0}
    <div class="widget-heading clearfix">
        <h4><span>{$lang.front.services}</span></h4>
    </div>
    <ul class="mini-list mini-best-sellers">
        {foreach from=$servicesBlockArray item=curr name="services"}
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