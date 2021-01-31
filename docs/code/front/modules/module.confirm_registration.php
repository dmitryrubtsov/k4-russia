<?php

if($_GET['ce'] && strlen($_GET['ce']) == 32)
{
	$query = "	SELECT 	u.user_id, ui.name, ui.lastname, ua.email,
						ual.email AS leader_email,
						uil.name AS leader_name, uil.lastname AS leader_lastname,
						uar.email AS referer_email,
						uir.name AS referer_name, uir.lastname AS referer_lastname
				FROM ".$_SQL_TABLE['user']." u
				INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.user_id
				INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.user_id
				LEFT JOIN ".$_SQL_TABLE['user_auth']." ual ON ual.user_id = u.leader_user_id
				LEFT JOIN ".$_SQL_TABLE['user_info']." uil ON uil.user_id = u.leader_user_id
				LEFT JOIN ".$_SQL_TABLE['user_referer']." ur ON ur.user_id = u.user_id
				LEFT JOIN ".$_SQL_TABLE['user_auth']." uar ON uar.user_id = ur.referer_user_id
				LEFT JOIN ".$_SQL_TABLE['user_info']." uir ON uir.user_id = ur.referer_user_id
 				WHERE MD5(ua.email) = '".$_GET['ce']."'
 				AND u.user_status_id = 0
			";
	$dbSet->open($query);
	$userInfo = $dbSet->fetchArray();

	if($userInfo['user_id'])
	{		$userPassword = generate_password(10);

	 	$userInfo['password'] = $userPassword;
	 	$pct->assign("userInfo", $userInfo);

		$todbarr = array();
		$todbarr['user_status_id'] = 1;
		makeUpdateList($strSet, $todbarr, array(), array());
		updateItem($_SQL_TABLE['user'], $strSet, 'user_id', $userInfo['user_id']);

		$todbarrAuth = array();
		$todbarrAuth['password'] = md5($userPassword);
		makeUpdateList($strSetAuth, $todbarrAuth, array(), array());
		updateItem($_SQL_TABLE['user_auth'], $strSetAuth, 'user_id', $userInfo['user_id']);

        $autoCreatePurses = getRowsByField($_SQL_TABLE['user_purse_type'], 'auto_create', 1);
        if(is_array($autoCreatePurses) && count($autoCreatePurses))
        {
	        foreach($autoCreatePurses as $n => $purseType)
	        {
	        	$todbarrUserPurse = array();
				$todbarrUserPurse['user_id'] = $userInfo['user_id'];
				$todbarrUserPurse['user_purse_type_id'] = $purseType['user_purse_type_id'];
				$todbarrUserPurse['amount'] = $purseType['auto_create_amount'];
				$todbarrUserPurse['user_purse_status_id'] = 2;
				$todbarrUserPurse['status_date'] = 'NOW()';
				makeInsertList($strColumns, $strValues, $todbarrUserPurse, array('status_date'));
				insertItem($_SQL_TABLE['user_purse'], $strColumns, $strValues);
				unset($todbarrUserPurse);
	        }
		}

		// mail footer
        $mailFooter = getFieldByEnother('body'.__FLANG, $_SQL_TABLE['article_info'], 'article_id', '8');
		$pct->assign("mailFooter", $mailFooter);

        // mail body
        $mailBodyUser = getFieldByEnother('body'.__FLANG, $_SQL_TABLE['article_info'], 'article_id', '10');
		$pct->assign("mailBodyUser", $mailBodyUser);

		$mailBodyAdmin = getFieldByEnother('body'.__FLANG, $_SQL_TABLE['article_info'], 'article_id', '12');
		$pct->assign("mailBodyAdmin", $mailBodyAdmin);


		$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE_ADMIN;
		$Body = $tpl->fetch("mail.send_activation.tpl");
		$BodyCopy = $tpl->fetch("mail.send_activation_user.tpl");
		$BodyLeader = $tpl->fetch("mail.send_activation_leader.tpl");
		$BodyReferer = $tpl->fetch("mail.send_activation_referer.tpl");

		$Subject = $MailSubject['admin']['userActivationToAdmin'];
		$SubjectCopy = $MailSubject['admin']['userActivationToUser'];

		require_once __CFG_PATH_LIBS . __CFG_PATH_CORE."mail.php";

		sendMailToUser($CONFIG['adminEmailRegistration'], $Subject, $Body, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);
		sendMailToUser($userInfo['email'], $SubjectCopy, $BodyCopy, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);
		if($userInfo['leader_email'])
		{
			sendMailToUser($userInfo['leader_email'], $Subject, $BodyLeader, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);
		}
		if($userInfo['referer_email'])
		{
			sendMailToUser($userInfo['referer_email'], $Subject, $BodyReferer, null, $CONFIG['SiteDomain'], $CONFIG['adminEmailForUserMailing']);
		}

		showMessageAlertJVSC($language['site']['successfulConfirmationLink']);
		go_toJVSC($BaseURL);
		exit;	}
	else
	{
		showMessageAlertJVSC($language['site']['wrongConfirmationLink']);
		go_toJVSC($BaseURL);
		exit;	}
}
else
{	showMessageAlertJVSC($language['site']['wrongConfirmationLink']);
	go_toJVSC($BaseURL);
	exit;}


?>