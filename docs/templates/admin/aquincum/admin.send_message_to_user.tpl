<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}style_popup.css" rel="stylesheet" type="text/css" />
	</head>
<body>

<div>
	<div class="title-row"><h3>{$lang.admin.sendMessageToUserByYouGroup}</h3></div>
	<div id="message-block">
		<form method="post" action="" name="sys-message">
			<input type="hidden" name="task" value="mess" />
			<div class="message-tooltip">
				{$lang.admin.youCanSendMessageToUserByGroup}
			</div>
			{if $ErrorMessages|@count > 0}
				<div class="popup-error">
					{foreach from=$ErrorMessages item="curr" key="key"}
						{$curr}<br />
					{/foreach}
				</div>
			{/if}
			<div class="message-title">{$lang.admin.systemMessageTo}:</div>
			<div class="message-field">
			<table id="to-users">
				<tr>
					<td><input type="checkbox" name="to_user" value="1" id="to_user" {if $smarty.post.to_user}checked{/if} /></td>
					<td><label for="to_user">{$UserInfo.name} {$UserInfo.lastname} ({$UserInfo.email})</label></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="to_group" value="1" id="to_group" {if $smarty.post.to_group}checked{/if} /></td>
					<td><label for="to_group">{$lang.admin.toAllYouGroup}</label></td>
				</tr>
			</table>
			</div>
			<div class="message-title">{$lang.admin.systemMessageTheme}:</div>
			<div class="message-field">
				<input class="theme mess-style" type="text" name="theme" maxlength="150" value="{if $smarty.post.theme}{$smarty.post.theme}{else}{if $RequestInfo.theme_title}{$RequestInfo.theme_title}{/if}{/if}" />
			</div>
			<div class="message-title">{$lang.admin.systemMessageText}:</div>
			<div class="message-field">
				<textarea class="message mess-style" name="message">{if $smarty.post.message}{$smarty.post.message}{/if}</textarea>
			</div>
		</form>
	</div>
	<center>
		<a class="buttonS bBlue" onclick="document.forms['sys-message'].submit();">{$lang.admin.adminButtonSendSystemMessage}</a>
	</center>
	<br /><br />
</div>

</body>
</html>