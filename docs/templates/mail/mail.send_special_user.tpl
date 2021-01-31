<div><h2>{$lang.contacts.dearUser} {$smarty.post.name}</h2></div>
<hr />
<div>{$lang.site.newSpecialFormUser}</div>
<br /><br />
<div>
	<table>
		<tr>
			<td><b>{$lang.site.specialProgram}:</b>&nbsp;&nbsp;</td>
			<td>{$specProgram}</td>
		</tr>
		<tr>
			<td><b>{$lang.user.firstname}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.name}</td>
		</tr>
		<tr>
			<td><b>{$lang.user.email}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.email}</td>
		</tr>
		<tr>
			<td><b>{$lang.user.phone}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.phone}</td>
		</tr>
		<tr>
			<td colspan="2"><b>{$lang.front.postYourComment}</b>&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">{$smarty.post.message}</td>
		</tr>
	</table>
</div>
<br /><br />
<div>{$mailFooter|unescape}</div>