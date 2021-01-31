<div><b>{$lang.admin.dearAdmin}</b></div>
<hr />
<br /><br />
<div>{$mailBodyAdmin|unescape}</div>
<br /><br />
<table>
	<tr>
		<td><b>{$lang.admin.participatorName}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.name}&nbsp;{$userInfo.lastname}</td>
	</tr>
	<tr>
		<td>{$lang.admin.participatorEmail}</b>:&nbsp;&nbsp;</td>
		<td>{$userInfo.email}</td>
	</tr>
</table>
<br /><br />
<div>{$mailFooter|unescape}</div>