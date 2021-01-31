<?php

	if(sizeof($_POST) && $_POST['tryLogin'] == 1)
	{
		if($_POST['login'] == __CFG_ADMIN_USERNAME && $_POST['password'] == __CFG_ADMIN_PASSWORD)
		{
			$sID->assign("admin", __CFG_ADMIN_USER_ID);
			$sID->assign("isGlobalAdmin", __TRUE);
			$sID->assign("Editor", array('Enabled' => __TRUE, 'EnableFileManager' => __TRUE));
			if($_GET['r'])
			{
				go_to(urldecode($_GET['r']));
			}
			else
			{
				go_to("index.php?mode=".$CONFIG['defaultAdminMode']);
			}
			exit();
		}
		else
		{
//            $query = "
//		 			SELECT ua.*
//		 			FROM ".$_SQL_TABLE['user']." u
//		 			INNER JOIN ".$_SQL_TABLE['user_auth']." ua
//					WHERE u.user_status_id != 0
//					AND ua.email = '".$_POST['login']."'
//					AND ua.password = '".md5($_POST['password'])."'
//			";
//            $dbSet->open($query);
//            $UserAuth = $dbSet->fetchArray();
//
//            if($UserAuth['email'] == $_POST['login'] && $UserAuth['password'] == md5($_POST['password']))
//            {
//                $mode = $CONFIG['defaultAdminMode'];
//                $sID->assign("isGlobalAdmin", __FALSE);
//                $sID->assign("admin", $UserAuth['user_id']);
//                $sID->assign("Editor", array('Enabled' => __TRUE, 'EnableFileManager' => __TRUE));
//                if($_GET['r'])
//                {
//                    go_to(urldecode($_GET['r']));
//                }
//                else
//                {
//                    go_to("index.php?mode=".$CONFIG['defaultAdminMode']);
//                }
//                exit;
//            }
//            else
//            {
//                $tpl->assign("ErrorMsg", $language["errors"][__ERROR_WRONG_LOGIN_OR_PASSWORD]);
//            }

			$query = "
		 			SELECT u.*
		 			FROM ".$_SQL_TABLE['admin_user']." u
					WHERE u.active != 0
					AND u.login = '".$_POST['login']."'
					AND u.password = '".md5($_POST['password'])."'
			";
			$dbSet->open($query);
			$UserAuth = $dbSet->fetchArray();
			if($UserAuth['login'] == $_POST['login'] && $UserAuth['password'] == md5($_POST['password']))
			{
				$mode = $CONFIG['defaultAdminMode'];
				$sID->assign("isGlobalAdmin", __FALSE);
				$sID->assign("admin", $UserAuth['admin_user_id']);
				$sID->assign("Editor", array('Enabled' => __TRUE, 'EnableFileManager' => __TRUE));

				if($_GET['r'])
				{
					go_to(urldecode($_GET['r']));
				}
				else
				{
					go_to("index.php?mode=".$CONFIG['defaultAdminMode']);
				}
				exit;
			}
			else
			{
				$tpl->assign("ErrorMsg", $language["errors"][__ERROR_WRONG_LOGIN_OR_PASSWORD]);
			}
		}
	}

	$tpl->assign("PageTitle", $language['admin']['loginPage']);

	$isLogin = true;
	$tpl->assign("isLogin", $isLogin);
//print_r($tpl);
//	$_ADMIN_SMARTY_TEMPLATE = "admin.login.tpl";

?>