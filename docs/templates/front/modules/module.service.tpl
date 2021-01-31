{if $blocktype eq 'curr'}

    <div class="content-area">
        {eval var=$ServiceArticle.text|unescape}
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
                    <div class="block-title title-top-position">{$curr.title}</div>
                    <div class="block-description">
                        {$curr.description|unescape}
                        <a href="{$curr.link}" class="block-more">{$lang.front.more}</a>
                    </div>
                </div>
                <div class="clear"></div>
            </section>
        {/foreach}
    </div>

{/if}