<div><b>{$lang.contacts.dearUser} {$smarty.post.firstname} {$smarty.post.lastname}</b></div>
<hr />
<br /><br />
<div>{$mailBodyUser|unescape}</div>
<br /><br />
<a href="{$BaseURL}confirm-registration{$Config.webPageFileType}?ce={$confirmEmail}" target="_blank">
	{$BaseURL}confirm-registration{$Config.webPageFileType}?ce={$confirmEmail}
</a>
<br /><br />
<div>{$mailFooter|unescape}</div>