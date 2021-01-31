<div><b>{$lang.admin.dearUser} {$userInfo.name} {$userInfo.lastname}</b></div>
<hr />
<br /><br />
<div>{$mailContent.body|unescape}</div>
<br /><br />
<div><a href="{$HOST}/manage/index.php?mode=message_dialogs_users_list&menu=53&lang={$userInfo.user_language_code}" target="_blank">{$lang.admin.goToMessage}</a></div>
<br /><br />
<div>{$mailContent.footer|unescape}</div>