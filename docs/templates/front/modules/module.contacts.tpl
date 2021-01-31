<div class="head">
    <h1>{eval var=$ContactArticle.title|unescape}</h1>
</div>
<div class="content-body">
    {eval var=$ContactArticle.text|unescape}
</div>


<p>Форма обратной связи:</p>
<br>
    <form method="post" action="" name="contacts">
        <input type="hidden" name="task" value="send">
        <table class="form">
            <tr>
                <td class="name">{$lang.contacts.name}: </td>
                <td class="value"><input type="text" name="name" maxlength="80" value="{if $User.isLogin eq '1' && $POST.name eq ''}{$User.info.firstname} {$User.info.lastname}{else}{$POST.name}{/if}" /></td>
            </tr>
            <tr>
                <td class="name">{$lang.contacts.email}: </td>
                <td class="value"><input type="text" name="email" maxlength="80" value="{if $User.isLogin eq '1' && $POST.name eq ''}{$User.info.email}{else}{$POST.email}{/if}" /></td>
            </tr>
            <tr>
                <td class="name">{$lang.contacts.message}: </td>
                <td class="value"><textarea name="message" rows="7" cols="45">{$POST.message}</textarea></td>
            </tr>
            <tr>
                <td class="name"></td>
                <td class="value">
                    <img id="cptch" src="{$BaseURL}showcode{$Config.webPageFileType}?q={math equation='rand(1,99999)'}" width="{$Config.secureImageWidth}" height="{$Config.secureImageHeight}" border="0" align="absmiddle" />&nbsp;
                    <a href="#" onclick="$('#cptch').attr('src', function(){ldelim}return $(this).attr('src')+'&'+Math.random(999);{rdelim});return false;"><img src="{$HOST}img/up2.jpg" border="0" height="15" width="16" align="absmiddle" alt="{$lang.front.reloadCaptchaImage}" title="{$lang.front.reloadCaptchaImage}" onclick="this.blur();" /></a>
                </td>
            </tr>
            <tr>
                <td class="name">{$lang.contacts.enterSecretCode}:</td>
                <td class="value">
                    <input class="code" type="text" name="code" maxlenght="{$Config.secureImageSymbols}" />
                </td>
            </tr>
        </table>

</form>
<br />
<input type="submit" class="tg12" value="{$lang.contacts.submitButton}" onclick="document.forms['contacts'].submit();" />
