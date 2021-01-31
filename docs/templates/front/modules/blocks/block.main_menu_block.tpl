<nav id="top-nav">
    <ul>
        {foreach from=$siteMainMenu item=menuItem name=main}
            {assign var="item" value=$menuItem->getItem()}
            <li {if $item.curr eq 'y' || $item.outerlink eq $action|cat:$Config.webPageFileType} class="active"{/if} ><a href="{$HOST}{$item.link}">{$item.title}</a></li>
        {/foreach}
        <div class="clearfix"></div>
    </ul>
</nav>


