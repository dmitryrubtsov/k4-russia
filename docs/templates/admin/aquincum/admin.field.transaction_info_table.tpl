<center>
	{if $Field.values.transaction_info_name && $Field.values.transaction_info_account}
		<table class="transaction-dateils">
		{if $Field.values.transaction_info_name}
			<tr>
				<th>{$lang.admin.transactionInfoName}:</th>
				<td>{$Field.values.transaction_info_name}</td>
			</tr>
		{/if}
		{if $Field.values.transaction_info_account}
			<tr>
				<th>{$lang.admin.transactionInfoAccountNumber}:</th>
				<td>{$Field.values.transaction_info_account}</td>
			</tr>
		{/if}
		{if $Field.values.transaction_info_bank_code}
			<tr>
				<th>{$lang.admin.transactionInfoBankCode}:</th>
				<td>{$Field.values.transaction_info_bank_code}</td>
			</tr>
		{/if}
		{if $Field.values.transaction_info_bank}
			<tr>
				<th>{$lang.admin.transactionInfoBank}:</th>
				<td>{$Field.values.transaction_info_bank}</td>
			</tr>
		{/if}
		{if $Field.values.transaction_info_iban}
			<tr>
				<th>{$lang.admin.transactionInfoIBAN}:</th>
				<td>{$Field.values.transaction_info_iban}</td>
			</tr>
		{/if}
		{if $Field.values.transaction_info_bic}
			<tr>
				<th>{$lang.admin.transactionInfoBIC}:</th>
				<td>{$Field.values.transaction_info_bic}</td>
			</tr>
		{/if}
		</table>
	{else}
		<div class="extra-info">
			{$lang.admin.transactionInfoDetailsEmpty}
		</div>
	{/if}
</center>