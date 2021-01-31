{include file="admin.header.tpl"}
<div id="wrapper">
    {if $FLAGS.ContentOnly eq ''}
        <div id="top">
            {*{$Blocks.adminMessagesBlock|unescape}*}
            {$Blocks.topRow|unescape}
        </div>
    {/if}
    <div class="pagetitle">{$PageTitle}</div>
    {if $isLogin}
        {$Blocks.loginForm|unescape}
    {else}
        <center>
        {$MainContent|unescape}
        </center>
    {/if}


</div>
{include file="admin.footer.tpl"}
