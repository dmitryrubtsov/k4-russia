<div id="admin-message-block">
	{if $adminPutNewRequest}
		<span class="admin-message-sec">
			<a class="put-req" href="index.php?mode=user_request_all_put_list&menu=30">
				{$lang.admin.newRequestPutCount} - <b>{$adminPutNewRequest}</b>
			</a>
		</span>
	{/if}
	{if $adminOutputNewRequest}
		<span class="admin-message-sec">
			<a class="output-req" href="index.php?mode=user_request_all_output_list&menu=30">
				{$lang.admin.newRequestOutputCount} - <b>{$adminOutputNewRequest}</b>
			</a>
		</span>
	{/if}
</div>