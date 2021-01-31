<?php

    function createMessage($theme, $message, $userId, $users = array(), $messageType, $leaderId = '0', $toUserId = '')
    {
    	global $_SQL_TABLE, $dbSet, $tpl, $MailSubject, $language;

    	$todbarrTheme = array();
    	$todbarrTheme['message_type_id'] = intval($messageType);
    	$todbarrTheme['leader_user_id'] = intval($leaderId);
		$todbarrTheme['date_create'] = 'NOW()';
		$todbarrTheme['date_update'] = 'NOW()';

		makeInsertList($strColumns, $strValues, $todbarrTheme, array('date_create', 'date_update'));
		insertItem($_SQL_TABLE['message_theme'], $strColumns, $strValues);
		$themeId = mysql_insert_id();

		$todbarrThemeInfo = array();
		$todbarrThemeInfo['message_theme_id'] = $themeId;
		$todbarrThemeInfo['title'] = $theme;

		makeInsertList($strColumns, $strValues, $todbarrThemeInfo, array());
		insertItem($_SQL_TABLE['message_theme_info'], $strColumns, $strValues);

		foreach($users as $user)
		{
			$todbarrThemeUser = array();
			$todbarrThemeUser['message_theme_id'] = $themeId;
			$todbarrThemeUser['user_id'] = $user;

			makeInsertList($strColumns, $strValues, $todbarrThemeUser, array());
			insertItem($_SQL_TABLE['message_theme_user'], $strColumns, $strValues);
		}

		$todbarrMessage = array();
		$todbarrMessage['message_theme_id'] = $themeId;
		$todbarrMessage['user_id'] = $userId;
		$todbarrMessage['text'] = $message;
		$todbarrMessage['date_create'] = 'NOW()';

		makeInsertList($strColumns, $strValues, $todbarrMessage, array('date_create'));
		insertItem($_SQL_TABLE['message'], $strColumns, $strValues);

		if($toUserId)
		{			addMessageThemeUserStatus($themeId, $toUserId);
		}
    }

    function createMessageFromTransaction($theme, $message, $userId, $users = array(), $toUserId = '')
    {    	createMessage($theme, $message, $userId, $users, 1, 0, $toUserId);    }

    function addMessageToDialigue($themeId, $message, $userId, $toUserId = '')
    {
    	global $_SQL_TABLE, $dbSet;

    	$todbarrTheme = array();
		$todbarrTheme['date_update'] = 'NOW()';
		makeUpdateList($strSetStatus, $todbarrTheme, array('date_update'));
		updateItem($_SQL_TABLE['message_theme'], $strSetStatus, 'message_theme_id', $themeId);


		$todbarrMessage = array();
		$todbarrMessage['message_theme_id'] = $themeId;
		$todbarrMessage['user_id'] = $userId;
		$todbarrMessage['text'] = $message;
		$todbarrMessage['date_create'] = 'NOW()';

		makeInsertList($strColumns, $strValues, $todbarrMessage, array('date_create'));
		insertItem($_SQL_TABLE['message'], $strColumns, $strValues);

		if($toUserId)
		{
			addMessageThemeUserStatus($themeId, $toUserId);
		}
    }

    function addMessageThemeUserStatus($themeId, $toUserId)
    {    	global $_SQL_TABLE, $dbSet, $tpl, $MailSubject, $language;

    	$messageThemeId = getFieldByEnother('message_theme_id', $_SQL_TABLE['message_theme_user_status'], 'user_id', $toUserId);
    	if(!$messageThemeId)
    	{    		$todbarrMessStatus = array();
			$todbarrMessStatus['message_theme_id'] = $themeId;
			$todbarrMessStatus['user_id'] = $toUserId;

			makeInsertList($strColumns, $strValues, $todbarrMessStatus, array());
			insertItem($_SQL_TABLE['message_theme_user_status'], $strColumns, $strValues);    	}

		require_once __CFG_PATH_LIBS.__CFG_PATH_CORE.'user.inc';

		$userInfo = getUserInfoByUserId($toUserId);
		$tpl->assign("userInfo", $userInfo);

		$articleArray = array_kv(getTableAsArray($_SQL_TABLE['article_info'], '', array("article_id IN ('8','19')"), '', 'body_'.$userInfo['user_language_code'].', article_id'), 'body_'.$userInfo['user_language_code'], 'article_id');
       	$mailContent = array();
       	$mailContent['footer'] = $articleArray[8];
       	$mailContent['body'] = $articleArray[19];
       	$tpl->assign("mailContent", $mailContent);

       	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE.'mail.php';
       	$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE_ADMIN;
       	$MailSubject = $MailSubject['admin']['newMessageOnSite'];
		$MailBody = $tpl->fetch("mail.send_message_to_user.tpl");
		$tpl->assign("MailBody", $MailBody);

		sendMailToUser($userInfo['email'], $MailSubject, $MailBody, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);

		return true;    }

    function createMessageFromLeader($theme, $message, $userId, $users = array())
    {
    	createMessage($theme, $message, $userId, $users = array(), 3);
    }

    function createMessageToLeader($theme, $message, $userId, $users = array(), $messageType, $leaderId = '0')
    {
    	createMessage($theme, $message, $userId, $users, $messageType, $leaderId);
    }

?>