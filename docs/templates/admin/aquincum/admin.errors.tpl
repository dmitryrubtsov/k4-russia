{if $ErrorMessage neq '' || $ErrorMessages|@is_array && $ErrorMessages|@count > 0 }
	<table class="error">
		<tr>
			<td class="head">{$lang.admin.attention}</td>
		</tr>
		<tr>
			<td class="main">
				<table>
					{if $ErrorMessage neq ''}
						<tr>
							<td>{$ErrorMessage}</td>
						</tr>
					{/if}
					{if $ErrorMessages|@count > 0}
						{foreach from=$ErrorMessages item="curr" key="key"}
							<tr>
								<td>{$curr}</td>
							</tr>
						{/foreach}
					{/if}
				</table>
			</td>
		</tr>
	</table>
{/if}