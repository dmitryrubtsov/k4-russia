<div><b>{$lang.admin.dearUser} {$userInfo.name} {$userInfo.lastname}</b></div>
<hr />
<br /><br />
<div>{$mailBodyUser|unescape}</div>
<br /><br />
<table>
	<tr>
		<td><b>{$lang.admin.yourLogin}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.email}</td>
	</tr>
	<tr>
		<td>{$lang.admin.yourPassword}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.password}</td>
	</tr>
</table>
<br /><br />
<div>{$mailFooter|unescape}</div>