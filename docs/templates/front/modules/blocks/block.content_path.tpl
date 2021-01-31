<div class="row">
    <div class="page-heading span12 clearfix alt-bg alt-one">
        <div class="heading-text">
            <h1>{$Page->Title}</h1>
        </div>
        <div id="breadcrumbs">
            {foreach from=$Page->ContentPathArr item=curr key=key name="contpath"}
                {if $smarty.foreach.contpath.first neq true}
                    <i class="icon-angle-right"></i>
                {/if}
                {if $curr.link neq ''}
                    <a href="{$curr.link}">{$curr.title}</a>
                {else}
                    {$curr.title}
                {/if}
            {/foreach}
        </div>
    </div>
</div>