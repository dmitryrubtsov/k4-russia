<div><b>{$lang.admin.dearUser} {$userInfo.user_name} {$userInfo.user_lastname}</b></div>
<hr />
<br /><br />
<div>{$mailContent.body|unescape}</div>
<br /><br />
{if $type eq 'get'}
	<div>
		<a href="{$HOST}/manage/index.php?mode=user_request_transaction_get_list&menu=46&lang={$userInfo.user_language}" target="_blank">
			{$lang.admin.goToPayOrder}
		</a>
	</div>
{else}
	<div>
		<a href="{$HOST}/manage/index.php?mode=user_request_transaction_transmit_list&menu=46&lang={$userInfo.user_language}" target="_blank">
			{$lang.admin.goToPayOrder}
		</a>
	</div>
{/if}
<br /><br />
<div>{$mailContent.footer|unescape}</div>