<div><h2>{$lang.form.dearUser} {$smarty.post.name}</h2></div>
<hr />
<div>{$lang.site.newReviewUser}</div>
<br /><br />
<div>
	<table>
		<tr>
			<td><b>{$lang.contacts.nameAb}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.name}</td>
		</tr>
		<tr>
			<td><b>{$lang.contacts.contactPhone}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.email}</td>
		</tr>
		<tr>
			<td><b>{$lang.contacts.email}:</b>&nbsp;&nbsp;</td>
			<td>{$smarty.post.phone}</td>
		</tr>
		<tr>
			<td><b>{$lang.site.learningBranch}:</b>&nbsp;&nbsp;</td>
			<td>{$Branch.title}</td>
		</tr>
		<tr>
			<td colspan="2"><b>{$lang.form.reviewText}:</b>&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td colspan="2">{$smarty.post.message}</td>
		</tr>
	</table>
</div>
<br /><br />
<div>{$mailFooter|unescape}</div>