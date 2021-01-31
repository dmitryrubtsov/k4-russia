{if $blocktype eq 'curr'}
    <div class="head">
        <h1>{eval var=$Archive.title|unescape}</h1>
    </div>
    <div class="content-body">
        {eval var=$Archive.text|unescape}
    </div>
{else}
    <div class="content">
        <div class="head">
            <h1>Архив проектов</h1>
        </div>
        <div class="content-body">
            <div class="proj-list">
                    {foreach from=$Items item=curr key=key name="list"}
                        <div class="item">
                            <div class="item-head">
                                <p><a href="{$curr.link}">{$curr.title}</a></p>
                                <p>{$curr.sub_description}</p>
                            </div>
                            <div class="item-prev">
                                {if $curr.orig_path}
                                    <a href="{$curr.link}"><img src="{$curr.orig_path}"></a>
                                {/if}
                                <p><a href="{$curr.link}">
                                        {$curr.description|unescape}
                                    </a></p>
                            </div>
                        </div>
                {/foreach}
            </div>
            {if $isPaging eq 'yes'}
                {include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.paging.tpl" Paging=$Paging Link=$Paging.link}
            {/if}
        </div>
    </div>
{/if}