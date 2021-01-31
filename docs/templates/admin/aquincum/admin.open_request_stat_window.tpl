<html>
	<head>
		<link href="{$HOST}{$Config.cssPath}style_popup.css" rel="stylesheet" type="text/css" />
	</head>
<body>

<div>
	<div class="title-row"><h3>{$lang.admin.requestStatistic}</h3></div>
	<div class="request-stat">
		<div class="stat-title stat-general">{$lang.admin.requestStatGeneral}</div>
		<div class="stat-row all-count">{$lang.admin.requestsGeneralCount} - <u>{$RequestsInfo.general_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsInfo.general_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
		<div class="stat-row all-in">{$lang.admin.requestsInCount} - <u>{$RequestsInfo.in_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsInfo.in_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
		<div class="stat-row all-out">{$lang.admin.requestsOutCount} - <u>{$RequestsInfo.out_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsInfo.out_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
		<div class="stat-row all-rest">{$lang.admin.requestsMoneyRest} <b class="{if $RequestsInfo.rest_sum > 0}green{else}red{/if}">{$RequestsInfo.rest_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</b></div>
	</div>
	{if $arrayGET.date_from && $arrayGET.date_to}
		<hr />
		<div class="request-stat">
			<div class="stat-title stat-period">{$lang.admin.requestStatPeriod}</div>
	        {if $RequestsPeriodInfo.general_count > 0}
				<div class="curr-period">({$arrayGET.date_from} - {$arrayGET.date_to})</div>
				<div class="stat-row all-count">{$lang.admin.requestsGeneralCount} - <u>{$RequestsPeriodInfo.general_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsPeriodInfo.general_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
				<div class="stat-row all-in">{$lang.admin.requestsInCount} - <u>{$RequestsPeriodInfo.in_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsPeriodInfo.in_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
				<div class="stat-row all-out">{$lang.admin.requestsOutCount} - <u>{$RequestsPeriodInfo.out_count}</u> {$lang.admin.requestsOnSum} <u>{$RequestsPeriodInfo.out_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</u></div>
				<div class="stat-row all-rest">{$lang.admin.requestsMoneyRest} <b class="{if $RequestsPeriodInfo.rest_sum > 0}green{else}red{/if}">{$RequestsPeriodInfo.rest_sum|string_format:"%.2f"} {$Config.valueUnitCalculation}</b></div>
			{else}
				<div class="stat-error">{$lang.admin.haveNotAnyRequestForPeriod}</div>
			{/if}
		</div>
	{/if}
	{*

		<div class="info-block-title">{$lang.admin.userRequestPutCreateInfo}</div>
		{if $ErrorMessages|@count > 0}
			<div class="popup-error">
				{foreach from=$ErrorMessages item="curr" key="key"}
					{$curr}<br />
				{/foreach}
			</div>
		{/if}
		<form method="post" action="" name="add-put-request">
			<input type="hidden" name="task" value="put" />
			<table class="create-request-tab">
				<tr>
					<td class="title">{$lang.admin.enterValueOfPSPForPut}:</td>
					<td class="field"><input type="text" name="amount" size="7" maxlength="7" {if $smarty.post.amount} value="{$smarty.post.amount}"{/if} /> {$Config.valueUnitCalculation}</td>
				</tr>
				<tr>
					<td class="title">{$lang.admin.selectUserPurseTypeForRequest}:</td>
					<td class="field">
						<select name="purse_type">
								<option value="">{$lang.admin.selectUserPurseTypeChoise}</option>
							{foreach from=$UserPurseTypes item=curr key=key name="purse_types"}
								<option value="{$curr.user_purse_type_id}" {if $smarty.post.purse_type eq $curr.user_purse_type_id} selected{/if}>{$curr.title}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td class="title">{$lang.admin.userRequestNotes}:</td>
					<td class="field">
					</td>
				</tr>
				<tr>
					<td colspan="2" class="combi">
						<textarea name="notes">{if $smarty.post.notes}{$smarty.post.notes}{/if}</textarea>
					</td>
				</tr>
				<tr>
					<td colspan="2" class="combi">
						<center>
							<a class="buttonS bGreen" onclick="document.forms['add-put-request'].submit();">
								{$lang.admin.sendRequest}
							</a>
						</center>
					</td>
				</tr>
			</table>
		</form>
	</div>
	*}
</div>

</body>
</html>