
{if $FLAGS.NotAllLangFieldsInTable}
<table class="attention">
<tr><td class="head">{$lang.admin.attention}!</td></tr>
<tr><td class="main">
{$lang.admin.notAllLangFieldsInDB}<br /><br />
<center>
<form method="post" action="">
<input type="hidden" name="correctLangDB" value="correct" />
<input  class="button-attention" type="submit" value="{$lang.admin.correctButton}" />
</form>
</center>
</td></tr>
</table>
{/if}

{if ($FLAGS.TableNotExists || $FLAGS.DBNotExists) && !$FLAGS.CanNotCreateDB}
<table class="attention">
<tr><td class="head">{$lang.admin.attention}!</td></tr>
<tr><td class="main">
{if $FLAGS.TableNotExists}{$MegaMessage.TableNotExists.title}
{elseif $FLAGS.DBNotExists}{$MegaMessage.DBNotExists.title}
{/if}
<br /><br />
<center>
<form method="post" action="">
<input type="hidden" name="correctDB" value="{if $FLAGS.TableNotExists}createTable{elseif $FLAGS.DBNotExists}createDB{/if}" />
<input  class="button-attention" type="submit" value="{$lang.admin.correctButton}" />
</form>
</center>
</td></tr>
</table>
{/if}

{if $FLAGS.CanNotCreateDB}
<table class="attention">
<tr><td class="head">{$lang.admin.attention}!</td></tr>
<tr><td class="main">
{if $FLAGS.CanNotCreateDB}{$MegaMessage.CanNotCreateDB.title|unescape}
{/if}
<br /><br />
<center>
<form method="post" action="">
<input type="hidden" name="correctDB" value="createDB" />
<input  class="button-attention" type="submit" value="{$lang.admin.doneButton}" />
</form>
</center>
</td></tr>
</table>
{/if}

{if $FLAGS.CommonMegaMessage}
<table class="attention">
<tr><td class="head">{$lang.admin.attention}!</td></tr>
<tr><td class="main">
{$MegaMessage.CommonMegaMessage.title|unescape}
</td></tr>
</table>
{/if}

{if $FLAGS.MegaMessageSecretCode}
{if $MegaMessage.MegaMessageSecretCode.ErrorCode|unescape}
 {include file="admin.errors.tpl" ErrorMessage=$MegaMessage.MegaMessageSecretCode.ErrorCode|unescape}
{/if}
<table class="attention">
<tr><td class="head">{$lang.admin.attention}!</td></tr>
<tr><td class="main">
{$MegaMessage.MegaMessageSecretCode.title|unescape}
<br /><br />
<center>
<form method="post" action="">
<input type="hidden" name="tsk" value="secretcode" />
{$lang.admin.enterSecretCode} &nbsp;&nbsp;
    <img src="index.php?mode=showcode&sessid={$SID}" width="90" height="20" border="0" align="absmiddle" />&nbsp;&nbsp;
    <input type="text" name="code" />
    <br /><br />
    <input class="button" type="submit" value="{$MegaMessage.MegaMessageSecretCode.okButtonTitle|unescape}" />
    &nbsp;&nbsp;
    <input class="button" type="button" value="{$MegaMessage.MegaMessageSecretCode.cancelButtonTitle|unescape}" onclick="{$MegaMessage.MegaMessageSecretCode.cancelButtonOnclick|unescape}" />
</form>
</center>
</td></tr>
</table>
{/if}