{if $blocktype eq 'curr'}
    <div id="page-content">
		{eval var=$NewsArticle.text|unescape}
	</div>
{else}
    {if !$showDestiny}
        <div id="publications-block">
    {/if}
        <div id="articles-list-area">
            {foreach from=$Items item=curr key=key name="newslist"}
                <div class="articles-list">
                    <div class="articles-list-image">
                        <a href="{$curr.link}">
                            <img src="{$curr.logo}" title="{$curr.title}" />
                        </a>
                    </div>
                    <div class="articles-list-desc">
                        <div class="block-date">{$curr.publication_date|date_format:"%d.%m.%Y"}</div>
                        <div class="block-title-article">{$curr.title}</div>
                        <div class="block-text">
                            {$curr.description|unescape}
                            <a class="more" href="{$curr.link}">{$lang.front.more}</a>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            {/foreach}
        </div>
        {if $isPaging eq 'yes'}
            {include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.paging.tpl" Paging=$Paging Link=$Paging.link}
        {/if}
    {if !$showDestiny}
        </div>
    {/if}
{/if}