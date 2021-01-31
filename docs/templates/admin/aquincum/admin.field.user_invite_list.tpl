<center>
	{if $Field.values|@count}
		<table class="invite-list">
				<tr>
					<th>{$lang.admin.userName}</th>
					<th>{$lang.admin.userLastname}</th>
					<th>{$lang.admin.userEmail}</th>
					<th>{$lang.admin.registrationDateInSystemByUser}</th>
				</tr>
			{foreach from=$Field.values item=curr key=key name="invite-list"}
				<tr>
					<td>{$curr.name}</td>
					<td>{$curr.lastname}</td>
					<td>{$curr.email}</td>
					<td>{$curr.date_registration|date_format:"%d.%m.%Y"}</td>
				</tr>
			{/foreach}
		</table>
	{else}
		<div class="extra-info">
			{$lang.admin.userInviteListEmpty}
		</div>
	{/if}
</center>