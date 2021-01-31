{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.top_html_code.tpl"}

<table width="100%">
<tr><td width="80%">
{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.page_title.tpl" title=$PageTitle}
</td><td align="right" valign="middle">
| <a href="{$BaseURL}login{$Config.webPageFileType}" class="orange">{$lang.user.login}</a>
</td></tr>
</table>

{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.errors.tpl"}
<br />
<center>
<form method="post" action="" name="forgotfrm">
<input type="hidden" name="task" value="remember">
<table class="form">
<tr>
  <td class="name">{$lang.user.email}: </td>
  <td class="value"><input type="text" name="email" value=""></td>
</tr>
<tr>
  <td class="name"></td>
  <td class="value"><a href="{$BaseURL}registration{$Config.webPageFileType}" class="temnsini">{$lang.user.registerHere}</a></td>
</tr>
<tr>
  <td class="name"></td>
  <td><br />&nbsp;<input type="button" class="tg12" onclick="$(forgotfrm).submit();" value="{$lang.user.sendMeMyPassword}" /></td>
</tr>
</table>
</center>
</form>

{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.bottom_html_code.tpl"}