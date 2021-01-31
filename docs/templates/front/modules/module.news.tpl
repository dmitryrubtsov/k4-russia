{if $blocktype eq 'curr'}

    <div class="content-area">
        {eval var=$NewsArticle.text|unescape}
    </div>

{else}

    <div class="news-page">
        {foreach from=$Items item=curr key=key name="newslist"}
            <section class="news-section" >
                <div class="news-pict">
                    <a href="{$curr.link}">
                        <img src="{$curr.logo}" alt="{$curr.title}" title="{$curr.title}" />
                    </a>
                </div>
                <div class="news-area">
                    <div class="block-date">{$curr.publication_date|date_format:"%d.%m.%Y"}</div>
                    <div class="block-title">{$curr.title}</div>
                    <div class="block-description">
                        {$curr.description|unescape}
                        <a class="block-more" href="{$curr.link}">{$lang.front.more}</a>
                    </div>
                </div>
                <div class="clear"></div>
            </section>
        {/foreach}
    </div>

{/if}