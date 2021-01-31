{include file="admin.header.tpl"}
<div id="admin-logo"></div>
<center><table><tr><td>
{$lang.admin.wellcomeToAdminPanel}
<br /><br />
{$lang.admin.pleaseLogin}

{if $ErrorMsg}<div class="error">{$ErrorMsg}</div>{/if}
<form method="post" action="">
<input type="hidden" name="tryLogin" value="1" />
<table class="logintab">
 <tr>
  <td>
    {$lang.admin.login}:
  </td>
  <td>
    <input type="text" name="login" />
  </td>
 </tr>
 <tr>
  <td>
   {$lang.admin.password}:
  </td>
  <td>
    <input type="password" name="password" />
  </td>
 </tr>
 <tr>
  <td colspan="2" class="submit">
    <input class="button" type="submit" value="{$lang.admin.loginButton}" />
  </td>
 </tr>
</table>
</form>
</td></tr></table>
{include file="admin.footer.tpl"}
