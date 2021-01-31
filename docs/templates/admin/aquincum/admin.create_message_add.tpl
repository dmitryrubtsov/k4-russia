<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}style_popup.css" rel="stylesheet" type="text/css" />
	</head>
<body>

<div>
	<div class="title-row"><h3>{$lang.admin.addSystemMessageToDialogue}</h3></div>
	<div id="message-block">
		<form method="post" action="" name="add-message">
			<input type="hidden" name="task" value="mess" />
			<div class="message-tooltip">
				{$lang.admin.youCanAddSystemMessageToDialogue}
			</div>
			{if $ErrorMessages|@count > 0}
				<div class="popup-error">
					{foreach from=$ErrorMessages item="curr" key="key"}
						{$curr}<br />
					{/foreach}
				</div>
			{/if}
			<div class="message-title">{$lang.admin.systemDialogueTheme}:</div>
			<div class="message-field">
				{$MessageInfo.title}
			</div>
			<div class="message-title">{$lang.admin.systemMessageText}:</div>
			<div class="message-field">
				<textarea class="message mess-style" name="message">{if $smarty.post.message}{$smarty.post.message}{/if}</textarea>
			</div>
		</form>
	</div>
	<center>
		<a class="buttonS bBlue" onclick="document.forms['add-message'].submit();">{$lang.admin.adminButtonSendSystemMessage}</a>
	</center>
	<br /><br />
</div>

</body>
</html>