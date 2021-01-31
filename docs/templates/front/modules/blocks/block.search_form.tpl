{*{include file=$Config.ModulesFolder|cat:$Config.BlocksFolder|cat:"block.page_title.tpl" title=$BlockTitle}
<table class="searchfrm">
<tr><td class="searchtd">
<center>
<form method="get" action="{$HOST}search{$Config.webPageFileType}">
<table class="search">
 <tr>
  <td class="field">
   <input type="text" name="{$Config.MainSearchVarName}" value="{$SearchQuery}" />
  </td>
  <td class="button">
   <input type="submit" value="{$lang.search.search}" />
  </td>
 </tr>
</table>
</form>
</center>
</td></tr>
</table> *}

<form class="poick_os" method="get" action="" >
	<div id="search">
		<input class="poick_knopka" type="submit" value="" />
		<input class="poick_pole" type="text" name="q" maxlength="30" value="" placeholder="SUCHEN"/>
	</div>
</form>
