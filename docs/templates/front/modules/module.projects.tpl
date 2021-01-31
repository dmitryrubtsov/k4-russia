{if $blocktype eq 'curr'}
<div class="content">
    <div class="head">
        <h1>{$ProjGroup.title}</h1>
        <a class="archive" href="{$HOST}articles--arhiv-proektov-35.html">архив проектов</a>
    </div>
    <div class="content-body">
        <div class="proj-list">
            <div class="head">
                <a href="{$ProjGroup.link}">
                    <img src="{$ProjGroup.orig_path}" alt="" title="" />
                </a>
            </div>

        {foreach from=$ListItems item=curr key=key name="list"}
            <div class="item">
                <div class="item-head">
                    <p><span>{$curr.title}</span></p>
                    <p>{$curr.sub_description}</p>
                </div>
                <div class="item-prev">
                    {if $curr.orig_path}
                        <img src="{$curr.orig_path}">
                    {/if}
                    <div class="pr-text">
                            {$curr.description|unescape}
                    </div>
                </div>
            </div>
        {/foreach}
        </div>
    </div>
</div>

{else}

<div class="content">
    <div class="head">
        <h1>Проекты</h1>
        <a class="archive" href="{$HOST}articles--arhiv-proektov-35.html">архив проектов</a>
    </div>
    <div class="content-body">
        <div class="proj-list">
            {foreach from=$Items item=curr key=key name="projectlist"}
                <div class="head">
                    {if $curr.logo}
                        <a href="{$curr.link}">
                            <img src="{$curr.logo}" alt="{$curr.title}" title="{$curr.title}" />
                        </a>
                    {/if}
                </div>
                {if $curr.ListItems}
                {foreach from=$curr.ListItems item=subCurr key=subKey name="list"}
                    <div class="item">
                        <div class="item-head">
                            <p><span>{$subCurr.title}</span></p>
                            <p>{$subCurr.sub_description}</p>
                        </div>
                        <div class="item-prev">
                            {if $subCurr.orig_path}
                                <img src="{$subCurr.orig_path}">
                            {/if}
                            <div class="pr-text">
                                {$subCurr.description|unescape}
                            </div>
                        </div>
                    </div>
                {/foreach}
                {/if}
            {/foreach}
        </div>
        {if $isPaging eq 'yes'}
            {include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.paging.tpl" Paging=$Paging Link=$Paging.link}
        {/if}
     </div>
</div>
{/if}