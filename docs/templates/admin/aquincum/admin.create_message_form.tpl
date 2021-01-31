<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}style_popup.css" rel="stylesheet" type="text/css" />
		<title>{$lang.admin.createNewSystemMessage}</title>
	</head>
<body>

<div>
	<div class="title-row"><h3>{$lang.admin.createNewSystemMessage}</h3></div>
	<div id="message-block">
		<form method="post" action="" name="sys-message">
			<input type="hidden" name="task" value="mess" />
			{*
			<div class="message-tooltip">
				{$lang.admin.youCanCreateSystemMessage}
			</div>
			*}
			{if $ErrorMessages|@count > 0}
				<div class="popup-error">
					{foreach from=$ErrorMessages item="curr" key="key"}
						{$curr}<br />
					{/foreach}
				</div>
			{/if}
			<div class="message-title">{$lang.admin.systemMessageTo}:</div>
			<div class="message-field">
				<b>{$RequestInfo.to_user_title}</b>
			{*
				<table id="to-users">
					<tr>
						<td><input type="checkbox" name="to_user" value="{$RequestInfo.to_user_id}" id="to_user" {if $smarty.post.to_user}checked{/if} /></td>
						<td><label for="to_user">{$RequestInfo.to_user_title}</label></td>
					</tr>
				{if $RequestInfo.to_leader_title}
					<tr>
						<td><input type="checkbox" name="to_leader" value="{$RequestInfo.leader_id}" id="to_leader" {if $smarty.post.to_leader}checked{/if} /></td>
						<td><label for="to_leader">{$RequestInfo.to_leader_title}</label></td>
					</tr>
				{/if}
					<tr>
						<td><input type="checkbox" name="to_admin" value="1" id="to_admin" {if $smarty.post.to_admin}checked{/if} /></td>
						<td><label for="to_admin">{$lang.admin.siteAdministrator}</label></td>
					</tr>
				</table>
			*}
			</div>
			<div class="message-title">{$lang.admin.systemMessageTheme}:</div>
			<div class="message-field">
			    <b>{$lang.admin.transactionTitle1} {$RequestInfo.transaction_id} {$lang.admin.transactionTitle2}</b>
				{*<input class="theme mess-style" type="text" name="theme" maxlength="150" value="{if $smarty.post.theme}{$smarty.post.theme}{else}{if $RequestInfo.theme_title}{$RequestInfo.theme_title}{/if}{/if}" />*}
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