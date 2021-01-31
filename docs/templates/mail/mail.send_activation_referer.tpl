<div><b>{$lang.admin.dearUser} {$userInfo.leader_name} {$userInfo.leader_lastname}</b></div>
<hr />
<br /><br />
<div>{$lang.admin.sendUserActivationForReferer}</div>
<br /><br />
<table>
	<tr>
		<td><b>{$lang.admin.userName}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.name}</td>
	</tr>
	<tr>
		<td>{$lang.admin.userLastname}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.lastname}</td>
	</tr>
	<tr>
		<td>{$lang.admin.userEmail}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.email}</td>
	</tr>
</table>
<br /><br />
<div>{$mailFooter|unescape}</div>