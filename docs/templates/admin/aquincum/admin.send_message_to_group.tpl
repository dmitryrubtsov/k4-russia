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
				<b>{$lang.admin.selectUserOrUsersForMessage}</b><br />
				<select name="group[]" multiple size="{$GroupSize}" class="users mess-style">
					{foreach from=$GroupListTree item="group1" key="key1"}
						<option value="{$group1.user_id}" {if in_array($group1.user_id, $smarty.post.group)} selected {/if}>{$group1.name} {$group1.lastname} ({$group1.email})</option>
						{foreach from=$group1.group item="group2" key="key2"}
							<option value="{$group2.user_id}" {if in_array($group2.user_id, $smarty.post.group)} selected {/if} >
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								{$group2.name} {$group2.lastname} ({$group2.email})
							</option>
							{foreach from=$group2.group item="group3" key="key3"}
								<option value="{$group3.user_id}" {if in_array($group3.user_id, $smarty.post.group)} selected {/if} >
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									{$group3.name} {$group3.lastname} ({$group3.email})
								</option>
								{foreach from=$group3.group item="group4" key="key4"}
									<option value="{$group4.user_id}" {if in_array($group4.user_id, $smarty.post.group)} selected {/if} >
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										{$group4.name} {$group4.lastname} ({$group4.email})
										{foreach from=$group4.group item="group5" key="key5"}
											<option value="{$group5.user_id}" {if in_array($group5.user_id, $smarty.post.group)} selected {/if} >
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
												{$group5.name} {$group5.lastname} ({$group5.email})
												{foreach from=$group5.group item="group6" key="key6"}
													<option value="{$group6.user_id}" {if in_array($group6.user_id, $smarty.post.group)} selected {/if} >
														&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														{$group6.name} {$group6.lastname} ({$group6.email})
													</option>
												{/foreach}
											</option>
										{/foreach}
									</option>
								{/foreach}
							{/foreach}
						{/foreach}
					{/foreach}
				</select>
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