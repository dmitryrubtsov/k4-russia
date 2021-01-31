<div><b>{$lang.contacts.dearUser} {$User.name} {$User.lastname}</b></div>
<hr />
<br /><br />
<div>{$mailBodyUser|unescape}</div>
<br /><br />
<table>
	<tr>
		<td><b>{$lang.site.yourLogin}</b>&nbsp;&nbsp;</td>
		<td>{$User.email}</td>
	</tr>
	<tr>
		<td><b>{$lang.site.yourPassword}</b>&nbsp;&nbsp;</td>
		<td>{$User.password}</td>
	</tr>
</table>
<br /><br />
<div>{$mailFooter|unescape}</div>