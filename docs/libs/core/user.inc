<?php

function getUserByLoginform($email, $pass)
{
  global $dbSet, $_SQL_TABLE;

  $dbSet->open("SELECT * FROM ".$_SQL_TABLE['user']." WHERE email = '".$email."' AND password = MD5('".$pass."')");
  return $dbSet->fetchArray();
}

function updateUserInfo(&$strSet, $id)
{
  global $dbSet, $_SQL_TABLE;
  $dbSet->execute("UPDATE ".$_SQL_TABLE['user']." SET ".$strSet." WHERE id='".$id."'");
}


function insertUserInfo(&$strColumns,&$strValues)
{
  global $dbSet, $_SQL_TABLE;
  $dbSet->execute("INSERT INTO ".$_SQL_TABLE['user']." (".$strColumns.", date) VALUES (".$strValues.", NOW())");
}

function isUserRegistered($email)
{
  global $dbSet, $_SQL_TABLE;

  $dbSet->open("SELECT id FROM ".$_SQL_TABLE['user']." WHERE email = '".$email."'");
  if(!isBlank($dbSet->loadResult()))
  {
  	return __TRUE;
  }
}

function isLoginToken($login)
{
  global $dbSet, $_SQL_TABLE;

  $dbSet->open("SELECT id FROM ".$_SQL_TABLE['user']." WHERE login = '".$login."'");
  if(!isBlank($dbSet->loadResult()))
  {
  	return __TRUE;
  }
}

function getUserByEmail($email)
{
  global $dbSet, $_SQL_TABLE;

  $dbSet->open("SELECT * FROM ".$_SQL_TABLE['user']." WHERE email = '".$email."'");
  return $dbSet->fetchArray();
}

function makeUserLogin(&$Errors, $login, $pass)
{
  global $sID;

  $User = getUserByLoginform($login, $pass);
  if(isBlank($User['email']))
  {
  	$Errors[] = __ERROR_WRONG_LOGIN_OR_PASSWORD;
  }
  elseif($User['active'] != 'y')
  {
  	$Errors[] = __ERROR_USER_LOCKED_BY_ADMIN;
  }
  else
  {
  	$USER['info'] = $User;
  	$USER['isLogin'] = true;
  	$sID->assign('user', $USER);
  	$sID->unassign('order');
  }
}


function generateUserSystemEmail(&$USER)
{
  global $CONFIG;

  preg_match("/^[^@]+/si", $USER['info']['email'], $matches);
  return $matches[0]."_".$USER['info']['id']."@".$CONFIG['emailDomain'];
}

function makeUserRegistration(&$Errors)
{
  global $CONFIG, $tpl, $MailSubject, $_SQL_TABLE;


  if(!preg_match("/^".$CONFIG[emailPattern]."$/", $_POST[email]))
  {
  	$Errors[] = __ERROR_INCORRECT_EMAIL;
  }
  if(isBlank($_POST[firstname]))
  {
  	$Errors[] = __ERROR_FIRSTNAME_NOT_ENTERED;
  }
  if(isBlank($_POST[lastname]))
  {
  	$Errors[] = __ERROR_LASTNAME_NOT_ENTERED;
  }
  /*if(isBlank($_POST[birthMonth]) || isBlank($_POST[birthDay]) || isBlank($_POST[birthYear]))
  {
  	$Errors[] = __ERROR_DATE_OF_BIRTH_NOT_SELECTED;
  }
  else
  {
  	$_POST[birth_date] = $_POST[birthYear]."-".$_POST[birthMonth]."-".$_POST[birthDay];
  }*/
  if(isBlank($_POST[npass]))
  {
  	$Errors[] = __ERROR_PASSWORD_NOT_ENTERED;
  }
  if($_POST[npass] != $_POST[npass2])
  {
  	$Errors[] = __ERROR_PASSWORDS_NOT_IDENTICAL;
  }
  if(strlen($_POST[npass]) < $CONFIG[passwordLength])
  {
  	$Errors[] = __ERROR_PASSWORD_IS_TOO_SHORT;
  }
  if(isUserRegistered($_POST[email]))
  {
    $Errors[] = __ERROR_EMAIL_ALREADY_USED;
  }
  if(isLoginToken($_POST[login]))
  {
    $Errors[] = __ERROR_LOGIN_ALREADY_USED;
  }
  if(isEmptyArr($Errors))
  {
  	$result = array(
  					 	'id' => 0,
  					 	'email' => $_POST[email],
  					 	'login' => $_POST[login],
	  					'password' => md5($_POST[npass]),
  						'firstname' => trim($_POST[firstname]),
  						'lastname' => trim($_POST[lastname]),
  						'birth_date' => $_POST[birth_date],
  						'send' => (!isBlank($_POST[send])) ? $_POST[send] : 'n',
  				   );
  	makeInsertList($strColumns,$strValues, $result);
  	insertUserInfo($strColumns,$strValues);
  	delRow($_SQL_TABLE['subscriber'], 'email', $_POST[email]);
    $User = array(
  					 	'email' => $_POST[email],
	  					'password' => $_POST[npass],
  						'firstname' => trim($_POST[firstname]),
  						'lastname' => trim($_POST[lastname]),
  						'birth_date' => $_POST[birth_date],
  				   );
  	$tpl->assign("User", $User);
  	$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE;
  	$mailBody = $tpl->fetch("mail.user_registration.tpl");
  	sendMailToUser($User[email], $MailSubject[newUserRegister]." ".$CONFIG[SiteName], $mailBody);
  }
}

function makeUserEdit(&$Errors)
{
  global $CONFIG, $sID, $tpl, $MailSubject, $USER, $_SQL_TABLE;

  if($_POST[pass] != '' && $_POST[pass] != $_POST[pass2])
  {
  	$Errors[] = __ERROR_PASSWORDS_NOT_IDENTICAL;
  }
  if($_POST[pass] != '' && strlen($_POST[pass]) < $CONFIG[passwordLength])
  {
  	$Errors[] = __ERROR_PASSWORD_IS_TOO_SHORT;
  }
  if(isBlank($_POST[firstname]))
  {
  	$Errors[] = __ERROR_FIRSTNAME_NOT_ENTERED;
  }
  if(isBlank($_POST[lastname]))
  {
  	$Errors[] = __ERROR_LASTNAME_NOT_ENTERED;
  }
  /*if(isBlank($_POST[birthMonth]) || isBlank($_POST[birthDay]) || isBlank($_POST[birthYear]))
  {
  	$Errors[] = __ERROR_DATE_OF_BIRTH_NOT_SELECTED;
  }
  else
  {
  	$_POST[birth_date] = $_POST[birthYear]."-".$_POST[birthMonth]."-".$_POST[birthDay];
  }*/
  if(isEmptyArr($Errors))
  {
    $result = array(
  					 	'firstname' => $_POST[firstname],
  						'lastname' => $_POST[lastname],
  						//'gender' => $_POST[gender],
  						'birth_date' => $_POST[birth_date],
  						'send' => (!isBlank($_POST[send])) ? $_POST[send] : 'n',
  				   );
    if($_POST[pass] != '')
    {
      $result[password] = md5($_POST[pass]);
    }
  	makeUpdateList($strSet, $result);
  	updateUserInfo($strSet, $USER[info][id]);
  	$User = getRowByField($_SQL_TABLE['user'], 'id', $USER[info][id]);
    $USER[info] = $User;
  	$USER[isLogin] = true;
  	$sID->assign('user', $USER);
  	if($_POST[pass] != '')
  	{
  	  $User[password] = $_POST[pass];
  	  $tpl->assign("User", $User);
  	  $tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE;
  	  $mailBody = $tpl->fetch("mail.user_edit_info.tpl");
  	  sendMailToUser($User[email], $MailSubject[userEditInfo]." ".$CONFIG[SiteName], $mailBody);
  	}
  }
}

function makeUserLogout()
{
  global $sID;

  $sID->unassign("order");
  $sID->unassign("user");
  $sID->unassign("checkoutstep");
}

function generateNewUserPass(&$Errors, $email)
{
  global $CONFIG, $sID, $tpl, $MailSubject, $USER;

  if(!preg_match("/^".$CONFIG['emailPattern']."$/", $email))
  {
  	$Errors[] = __ERROR_INCORRECT_EMAIL;
  }
  if(!isUserRegistered($email))
  {
  	$Errors[] = __ERROR_NO_SUCH_USER;
  }
  if(isEmptyArr($Errors))
  {
    $User = getUserByEmail($email);
    $newPass = generate_password($CONFIG['passwordLength']);

    $result = array('password' => md5($newPass));

  	makeUpdateList($strSet, $result);
  	updateUserInfo($strSet, $User[id]);
  	$User[password] = $newPass;
  	$tpl->assign("User", $User);
  	$tpl->template_dir = __CFG_PATH_MAIL_TEMPLATE;
  	$mailBody = $tpl->fetch("mail.user_pass_reminder.tpl");
  	sendMailToUser($User['email'], $MailSubject['userPassReminder']." ".$CONFIG['SiteName'], $mailBody);
  }
}

function getUserInfoByIdAsArray($userID)
{
  global $dbSet, $_SQL_TABLE;

  $query = "SELECT * FROM ".$_SQL_TABLE['user']." WHERE id = '".$userID."'";
  $dbSet->open($query);
  return $dbSet->fetchArray();
}

function userSubscribe($info, &$Errors)
{
  global $dbSet, $CONFIG, $_SQL_TABLE;

  if(!preg_match("/^".$CONFIG['emailPattern']."$/", $info['email']))
  {
  	$Errors[] = __ERROR_INCORRECT_EMAIL;
  	return __FALSE;
  }

  $info['send'] = 'y';
  if(!isUserRegistered($info['email']))
  {
    $subscriber = getRowByFields($_SQL_TABLE['subscriber'], array("email = '".$info['email']."'"));
    if(isBlank($subscriber['email']))
    {
      makeInsertList($strColumns, $strValues, $info);
      $dbSet->execute("INSERT INTO ".$_SQL_TABLE['subscriber']." (id, ".$strColumns.", date) VALUES ('0', ".$strValues.", NOW())");
    }
    elseif(!isBlank($subscriber['email']) && $subscriber['send'] == 'y')
    {
      $Errors[] = __YOU_HAVE_ALREADY_SUBSCRIBED;
  	  return __TRUE;
    }
    else
    {
      makeUpdateList($strSet, $info);
      $dbSet->execute("UPDATE ".$_SQL_TABLE['subscriber']." SET ".$strSet.", date = NOW() WHERE email = '".$info['email']."'");
    }
  }
  else
  {
  	$user = getUserByEmail($info['email']);
  	if($user['send'] == 'y')
  	{
  	  $Errors[] = __YOU_HAVE_ALREADY_SUBSCRIBED;
  	  return __TRUE;
  	}
  	else
  	{
  	  makeUpdateList($strSet, $info);
      updateUserInfo($strSet, $user['id']);
  	}
  }
  $Errors[] = __YOU_HAVE_SUBSCRIBED;
  return __TRUE;
}

function userUnSubscribe($info, &$Errors)
{
  global $dbSet, $CONFIG, $_SQL_TABLE;

  if(!preg_match("/^".$CONFIG['emailPattern']."$/", $info['email']))
  {
  	$Errors[] = __ERROR_INCORRECT_EMAIL;
  	return __FALSE;
  }

  $info['send'] = 'n';
  if(!isUserRegistered($info['email']))
  {
    $subscriber = getRowByFields($_SQL_TABLE['subscriber'], array("email = '".$info['email']."'"));
    if(isBlank($subscriber['email']))
    {
      makeInsertList($strColumns, $strValues, $info);
      $dbSet->execute("INSERT INTO ".$_SQL_TABLE['subscriber']." (id, ".$strColumns.", date) VALUES ('0', ".$strValues.", NOW())");
    }
    elseif(!isBlank($subscriber['email']) && $subscriber['send'] == 'n')
    {
      $Errors[] = __YOU_HAVE_ALREADY_UNSUBSCRIBED;
  	  return __TRUE;
    }
    else
    {
      makeUpdateList($strSet, $info);
      $dbSet->execute("UPDATE ".$_SQL_TABLE['subscriber']." SET ".$strSet.", date = NOW() WHERE email = '".$info['email']."'");
    }
  }
  else
  {
  	$user = getUserByEmail($info['email']);
  	if($user['send'] == 'n')
  	{
  	  $Errors[] = __YOU_HAVE_ALREADY_UNSUBSCRIBED;
  	  return __TRUE;
  	}
  	else
  	{
  	  makeUpdateList($strSet, $info);
      updateUserInfo($strSet, $user['id']);
  	}
  }
  $Errors[] = __YOU_HAVE_UNSUBSCRIBED;
  return __TRUE;
}

	function findUsersIdsByLeader($userIds)
	{
		global $_SQL_TABLE, $dbSet;

		if(!sizeof($userIds))
		{
			return array();
		}

		$userIdsIn = join(',', $userIds);

		$query = "	SELECT 	u.user_id
					FROM ".$_SQL_TABLE['user']." u
	 				WHERE u.leader_user_id IN (".$userIdsIn.")
	 				AND u.user_status_id != 0
	 				GROUP BY u.user_id
				";
		$dbSet->open($query);
		$UserIDArray = $dbSet->fetchRowsAll();

		if(sizeof($UserIDArray))
		{
			$userArr = array();
			foreach($UserIDArray as $n => $val)
			{
				$userArr[] = $val['user_id'];
			}
			return $userArr;
		}
		else
		{
			return array();
		}
	}

	function usersByGroup($userIds)
	{
		global $_SQL_TABLE, $dbSet;

		if(!is_array($userIds))
		{
			$userIds = array($userIds);
		}

		$AllUsersIds = $userIds;
		$CurrentUsersIds = $userIds;

		do
		{
			$childrenUsers = findUsersIdsByLeader($CurrentUsersIds);
            $CurrentUsersIds = $childrenUsers;
			if(sizeof($childrenUsers))
			{
				$AllUsersIds = array_merge($AllUsersIds, $childrenUsers);
			}
		}
		while(sizeof($CurrentUsersIds));

		return join(',', $AllUsersIds);
	}

	function findUserLeaderIdByUserId($userId)
	{
		global $_SQL_TABLE, $dbSet;

		$query = "	SELECT 	u.leader_user_id AS user_id, ult.percentage
					FROM ".$_SQL_TABLE['user']." u
					INNER JOIN ".$_SQL_TABLE['user']." lu ON lu.user_id = u.leader_user_id
					LEFT JOIN ".$_SQL_TABLE['user_leader_type']." ult ON ult.user_leader_type_id = lu.user_leader_type_id
	 				WHERE u.user_id = '".$userId."'
				";
		$dbSet->open($query);
		$LeaderInfo = $dbSet->fetchRowsAll();

		return $LeaderInfo;
	}

	function userLeaderPercentageTree($userId)
	{
		global $_SQL_TABLE, $dbSet, $CONFIG;

		$UserInfo = getRowByField($_SQL_TABLE['user'], 'user_id', $userId);

		$userLeadersList = array();
		$refererId = getFieldByEnother('referer_user_id', $_SQL_TABLE['user_referer'], 'user_id', $userId);
		if($refererId)
		{
			$userLeadersList[] = array('user_id' => $refererId, 'percentage' => $CONFIG['refererPercentage']);
		}

		$CurrentUserId = $userId;

		do
		{
			$LeaderInfo = findUserLeaderIdByUserId($CurrentUserId);
			if(sizeof($LeaderInfo))
			{
				$userLeadersList = array_merge($userLeadersList, $LeaderInfo);
				$CurrentUserId = $LeaderInfo[0]['user_id'];
			}
			else
			{
				return $userLeadersList;
			}
		}
		while($CurrentUserId);

		return $userLeadersList;
	}

	function getUserInfoByUserId($userId)
	{
		global $_SQL_TABLE, $dbSet, $CONFIG;

		$query = "	SELECT u.*, ui.name, ui.lastname, ua.email, l.code2 AS user_language_code
					FROM ".$_SQL_TABLE['user']." u
	 				INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.user_id
	 				INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.user_id
	 				LEFT JOIN ".$_SQL_TABLE['language']." l ON l.language_id = u.language_id
	 				WHERE u.user_id = '".$userId."'
				";
		$dbSet->open($query);
		$userInfo = $dbSet->fetchArray();

		return $userInfo;
	}

    function ItemActionEditAdminUser($params)
    {
        global $ADMIN, $dbSet, $_SQL_TABLE, $tpl;

        if($params['operation'] && $params['operation'] == 'editdata')
        {
            if(!isBlank($params['name']) && !isBlank($params['login']))
            {
                $query = "  UPDATE ".$_SQL_TABLE['admin_user']."
                        SET name = '".$params['name']."',
                            login = '".$params['login']."'
                        WHERE admin_user_id='".$ADMIN['user']['admin_user_id']."'";
                $dbSet->execute($query);
            }
            go_to(getSameUri().'#info');
        }
        if($params['operation'] && $params['operation'] == 'changepassword')
        {
            if(!isBlank($params['old']) && !isBlank($params['new']) && ($params['old'] != $params['new']) && (md5($params['old']) == $ADMIN['user']['password']))
            {
                $query = "  UPDATE ".$_SQL_TABLE['admin_user']."
                        SET password = '".md5($params['new'])."'
                        WHERE admin_user_id='".$ADMIN['user']['admin_user_id']."'";
                $dbSet->execute($query);

                $tpl->assign_by_ref('Admin', $ADMIN);
            }
            go_to(getSameUri().'#pass');
        }

        exit();
    }

    function ListItemsActionEditAdminUser($params)
    {
        global $ADMIN, $dbSet, $_SQL_TABLE, $tpl;

        if($params['operation'] && $params['operation'] == 'editdata')
        {
            if(!isBlank($params['name']) && !isBlank($params['login']))
            {
                $query = "  UPDATE ".$_SQL_TABLE['admin_user']."
                        SET name = '".$params['name']."',
                            login = '".$params['login']."'
                        WHERE admin_user_id='".$ADMIN['user']['admin_user_id']."'";
                $dbSet->execute($query);
            }
            go_to(getSameUri().'#info');
        }
        if($params['operation'] && $params['operation'] == 'changepassword')
        {
            if(!isBlank($params['old']) && !isBlank($params['new']) && ($params['old'] != $params['new']) && (md5($params['old']) == $ADMIN['user']['password']))
            {
                $query = "  UPDATE ".$_SQL_TABLE['admin_user']."
                        SET password = '".md5($params['new'])."'
                        WHERE admin_user_id='".$ADMIN['user']['admin_user_id']."'";
                $dbSet->execute($query);

                $tpl->assign_by_ref('Admin', $ADMIN);
            }
            go_to(getSameUri().'#pass');
        }

        exit();
    }


?>