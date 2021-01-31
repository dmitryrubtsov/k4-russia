<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}style_popup.css" rel="stylesheet" type="text/css" />
	</head>
<body>

<div>
	<div class="title-row"><h3>{$lang.admin.sendMessageToYourLeader}</h3></div>
	<div id="message-block">
		<form method="post" action="" name="sys-message">
			<input type="hidden" name="task" value="mess" />
			<div class="message-tooltip">
				{$lang.admin.youCanSendMessageToYourLeader}
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
				<span class="message-to">
					{$LeaderInfo.name} {$LeaderInfo.lastname} ({$LeaderInfo.email})
				</span>
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