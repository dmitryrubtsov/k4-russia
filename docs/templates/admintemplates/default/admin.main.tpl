{include file="admin.header.tpl"}
<h1>MAIN</h1>
<h1>{$test555}</h1>
{if $isLogin}
    <h1>{$test}</h1>
    {$Blocks.loginForm|unescape}
{/if}



{include file="admin.footer.tpl"}
