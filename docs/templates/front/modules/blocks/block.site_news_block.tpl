{if $newsArray|@count > 0}
    <h2 class="site-title">{$lang.front.news}</h2>
    <div id="news-block">
        {foreach from=$newsArray item=curr name="sitenews"}
            <div class="news-block-each{if $smarty.foreach.sitenews.last eq true}-last{/if}">
                <div class="block-date">{$curr.publication_date|date_format:"%d.%m.%Y"}</div>
                <div class="block-title">{$curr.newsTitle}</div>
                <div class="block-text">{$curr.newsDescription|unescape}</div>
                <div class="block-more"><a href="{$curr.link}">{$lang.front.more}</a></div>
            </div>
        {/foreach}
        <div class="clear"></div>
    </div>
{/if}