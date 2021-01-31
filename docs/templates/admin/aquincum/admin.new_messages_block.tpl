{if $newMessagesCount}
	<div class="new_mess new_mail">
		<a href="index.php?mode=message_dialogs_users_list&menu=53">
			{$lang.admin.newMessagesCount} - <b>{$newMessagesCount}</b>
		</a>
	</div>
{/if}
{if $newPaymentsTransferCount}
	<div class="new_mess new_pay_transfer">
		<a href="index.php?mode=user_request_transaction_transmit_list&menu=46">
			{$lang.admin.newPaymentsTransferCount} - <b>{$newPaymentsTransferCount}</b>
		</a>
	</div>
{/if}
{if $newPaymentsGetCount}
	<div class="new_mess new_pay_get">
		<a href="index.php?mode=user_request_transaction_get_list&menu=46">
			{$lang.admin.newPaymentsGetCount} - <b>{$newPaymentsGetCount}</b>
		</a>
	</div>
{/if}
{if $newAdminNewsCount}
	<div class="new_mess new_admin_news">
		<a href="index.php?mode=admin_news_user_list&menu=20">
			{$lang.admin.newAdminNewsCount} - <b>{$newAdminNewsCount}</b>
		</a>
	</div>
{/if}