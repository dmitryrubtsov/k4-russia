{*
<div id="pagination-block-area">
    <div id="pagination-block">
        <div id="pagination">
            {if $Paging.prev}
                <a href="{$Link}{$Paging.prev}" class="page gradient"><</a>
            {/if}

            {if $Paging.firstpage != $Paging.pages[0]}
                {assign var='Page' value=$Paging.firstpage}
                {if $Page eq $Paging.page}
                    <span class="page active">{$Page}</span>
                {else}
                    <a href="{eval var=$Link}{$Paging.firstpage}" class="page gradient">{$Page}</a>
                {/if}
                <span class="btn">...</span>
            {/if}

            {foreach from=$Paging.pages item="Page" name="pages"}
                {if $Page eq $Paging.page}
                    <span class="page active">{$Page}</span>
                {else}
                    <a href="{eval var=$Link}{$Page}" class="page gradient">{$Page}</a>
                {/if}
            {/foreach}

            {if $Paging.lastpage != $Paging.pages[$smarty.foreach.pages.index]}
                {assign var='Page' value=$Paging.lastpage}
                <span class="btn">...</span>
                {if $Page eq $Paging.page}
                    <span class="page active">{$Page}</span>
                {else}
                    <a href="{eval var=$Link}{$Paging.lastpage}" class="page gradient">{$Page}</a>
                {/if}
            {/if}

            {if $Paging.next && $Paging.next <= $Paging.lastpage}
                <a href="{$Link}{$Paging.next}" class="page gradient">></a>
            {/if}
        </div>
    </div>
    <div class="clear"></div>
</div>
    *}

<div class="pagination">
        {if $Paging.prev}
             <a href="{$Link}{$Paging.prev}" class="page first"></a>
        {/if}

        {foreach from=$Paging.pages item="Page" name="pages"}
            {if $Page eq $Paging.page}
                    <span class="page  active">{$Page}</span>

            {else}
                    <a href="{eval var=$Link}{$Page}" class="page" title="{$Page}">{$Page}</a>
            {/if}
        {/foreach}

        {if $Paging.next && $Paging.next <= $Paging.lastpage}
                <a href="{$Link}{$Paging.next}" class="page last"></a>
        {/if}
</div>