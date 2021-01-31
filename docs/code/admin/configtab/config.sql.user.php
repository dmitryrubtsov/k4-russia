<?php

//print_r($ADMIN['user']['user_groups']);

	if($_GET[$CONFIG['keyVarPrefix']."user_id"] != $ADMIN['user_id'])
	{
		echo("<script language='javascript'>window.location.replace('".$HOST."/manage/index.php?mode=user&menu=20&".$CONFIG['keyVarPrefix']."user_id=".$ADMIN['user_id']."');</script>");
		exit;
	}

	$WorkTableKeyFieldName = 'user_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['ult'] = getFieldNamesWithLangs($_SQL_TABLE['user_leader_type'], array('title'));
	$TabFields['us'] = getFieldNamesWithLangs($_SQL_TABLE['user_status'], array('title'));
	$TabFields['usi'] = getFieldNamesWithLangs($_SQL_TABLE['user_status_inform'], array('title'));

	$UserLeaderTypeSelect = array_kv(getTableAsArray($_SQL_TABLE['user_leader_type'], 'position', array(), '', 'user_leader_type_id,'.$TabFields['ult']['title']), $TabFields['ult']['title'], 'user_leader_type_id');
	$UserStatusSelect = array_kv(getTableAsArray($_SQL_TABLE['user_status'], 'position', array(), '', 'user_status_id,'.$TabFields['us']['title']), $TabFields['us']['title'], 'user_status_id');
    $UserStatusInformSelect = array_kv(getTableAsArray($_SQL_TABLE['user_status_inform'], 'position', array(), '', 'user_status_inform_id,'.$TabFields['usi']['title']), $TabFields['usi']['title'], 'user_status_inform_id');
    $LanguagesSelect = array_kv(getTableAsArray($_SQL_TABLE['language'], 'position', array("site_lang = 1", "status_id = 1"), '', 'language_id, title_system'), 'title_system', 'language_id');

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["yourPersonalInformation"]." :: ".$Item["name"]." ".$Item["lastname"];';

		$query = "	SELECT 	u.*, ult.title".__FLANG." AS leader_type, us.title".__FLANG." AS user_status,
							CONCAT(ui.name, ' ', ui.lastname, '<br />', ua.email) AS user_leader,
							ur.referer_user_id,
							CONCAT(rui.name, ' ', rui.lastname, '<br />', rua.email) AS user_inviter
					FROM ".$WorkTable." u
					LEFT JOIN ".$_SQL_TABLE['user_leader_type']." ult ON ult.user_leader_type_id = u.user_leader_type_id
					LEFT JOIN ".$_SQL_TABLE['user_status']." us ON us.user_status_id = u.user_status_id
					LEFT JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.leader_user_id
					LEFT JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.leader_user_id
					LEFT JOIN ".$_SQL_TABLE['user_referer']." ur ON ur.user_id = u.user_id
					LEFT JOIN ".$_SQL_TABLE['user_info']." rui ON rui.user_id = ur.referer_user_id
					LEFT JOIN ".$_SQL_TABLE['user_auth']." rua ON rua.user_id = ur.referer_user_id
	 				WHERE u.".$WorkTableKeyFieldName." = '".$_REQUEST[getKeyVarName()]."'
				";
		$dbSet->open($query);
		$UserInfo = $dbSet->fetchArray();
		if(!$UserInfo['user_leader'])
		{
			$UserInfo['user_leader'] = '<b>'.$language['admin']['haveNotLeaderForYourGroup'].'</b>';
		}
		if(!$UserInfo['user_inviter'])
		{
			$UserInfo['user_inviter'] = '<b>'.$language['admin']['haveNotUserInviter'].'</b>';
		}

		$query = "	SELECT aug.admin_user_group_id, aug.title".__FLANG." AS title
					FROM ".$_SQL_TABLE['user_admin_user_group']." uaug
	 				LEFT JOIN ".$_SQL_TABLE['admin_user_group']." aug ON aug.admin_user_group_id = uaug.admin_user_group_id
	 				WHERE uaug.".$WorkTableKeyFieldName." = '".$_REQUEST[getKeyVarName()]."'
				";
		$dbSet->open($query);
		$AdminUserGroupSelect = $dbSet->fetchRowsAll();
		$AdminUserGroupSelected = array_kv($AdminUserGroupSelect, 'title', 'admin_user_group_id');

		// User leaders array
		$query = "	SELECT u.user_id, ua.email, ui.name, ui.lastname
					FROM ".$_SQL_TABLE['user']." u
	 				INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.user_id
	 				INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.user_id
	 				WHERE u.user_id != '".$ADMIN['user_id']."'
				";
		$dbSet->open($query);
		$UserLeaderArray = $dbSet->fetchRowsAll();
		$UserLeadersSelect = array();
		foreach($UserLeaderArray as $user)
		{
			$UserLeadersSelect[$user['user_id']] = $user['email']." (".$user['user_id'].") ".$user['name']." ".$user['lastname'];
		}
	}
	else
	{
		$PageTitle = '$language["admin"]["usersPSP"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." u
							INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.".$WorkTableKeyFieldName." = u.".$WorkTableKeyFieldName."
							INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.".$WorkTableKeyFieldName." = u.".$WorkTableKeyFieldName."
							LEFT JOIN ".$_SQL_TABLE['user_leader_type']." ult ON ult.user_leader_type_id = u.user_leader_type_id
  							LEFT JOIN ".$_SQL_TABLE['user_status']." us ON us.user_status_id = u.user_status_id
  							LEFT JOIN ".$_SQL_TABLE['user_status_inform']." usi ON usi.user_status_inform_id = u.user_status_inform_id
  							LEFT JOIN ".$_SQL_TABLE['language']." l ON l.language_id = u.language_id";
		$Query['Fields'] = "u.*, ui.*, ua.*, ult.".$TabFields['ult']['title']." AS user_leader_type_id, us.".$TabFields['us']['title']." AS user_status_id";
		$Query['TabOrder'] = "u.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "u.".$WorkTableKeyFieldName;

		$EnableFilter = true;

		$listInfo['where']['user_leader_type_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "u.user_leader_type_id = '".$_REQUEST['user_leader_type_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['userLeaderType'],
  								'values' => array('' => $language['admin']['all']) + $UserLeaderTypeSelect,
  								'JSact' => '',
   								);

		$listInfo['where']['user_status_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "u.user_status_id = '".$_REQUEST['user_status_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['userStatus'],
  								'values' => array('' => $language['admin']['all']) + $UserStatusSelect,
  								'JSact' => '',
   								);

		require_once __CFG_PATH_CODE."admin.filter.inc";
	}

	$_SQL_TABLE_FIELDS[$GlobPart] = array(

				'name' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userName'],
								'addVariable' => $_POST['name'],
								'useInAddForm' => 'y',
								//unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								//'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '50',
								'size' => '50',
								'tabord' => 'ui.',
								),

				'lastname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userLastname'],
								'addVariable' => $_POST['lastname'],
								'useInAddForm' => 'y',
								//unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								//'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '50',
								'size' => '50',
								'tabord' => 'ui.',
								),

				'email' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_auth'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userEmail']." <br />(".$language['admin']['useAslogin'].")",
								'addVariable' => $_POST['email'],
								'useInAddForm' => 'y',
								//unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								//'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '50',
								'unique' => 'y',
								'size' => '50',
								'tabord' => 'ua.',
								),

				'password' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_auth'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userPassword'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['password'],
								//'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '32',
								'md5' => 'y',
								'textUnderField' => '<span class="red">'.$language['admin']['passwordStoredCoded'].'</span>',
								),

				'phone' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userPhone'],
								'addVariable' => $_POST['phone'],
								'useInAddForm' => 'y',
								//unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '20',
								'tabord' => 'ua.',
								),

				'skype' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userSkype'],
								'addVariable' => $_POST['skype'],
								'useInAddForm' => 'y',
								//unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								'tabord' => 'ua.',
								),

				'user_invite' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['user_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['userInvite'],
								'addVariable' => $_POST['user_invite'],
								'useInAddForm' => 'y',
								'unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								'tabord' => 'ua.',
								'textUnderField' => '<span class="red">'.$language['admin']['userInviteTooltip'].'</span>',
								),

				'user_leader_type_id' => array(
								//'type' => 'select',
								'type' => 'value',
								'title' => $language['admin']['userLeaderType'],
								'useInAddForm' => 'y',
								//'addVariable' => $_POST['user_leader_type_id'],
								'defaultValue' => $UserInfo['leader_type'],
								'useInList' => $CONFIG['useInListSort'],
								'notUsedInDB' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								//'values' => $UserLeaderTypeSelect,
								'orderby' => $TabFields['ult']['title'],
								'tabord' => 'ult.',
								),

				'leader_user_id' => array(
								'type' => 'value',
								'title' => $language['admin']['yourSupervisor'],
								'defaultValue' => $UserInfo['user_leader'],
								'useInList' => $CONFIG['useInListSort'],
								'notUsedInDB' => 'y',
				),

				'invite_user_id' => array(
								'type' => 'value',
								'title' => $language['admin']['yourInviter'],
								'defaultValue' => $UserInfo['user_inviter'],
								'useInList' => $CONFIG['useInListSort'],
								'notUsedInDB' => 'y',
				),

				'user_status_id' => array(
								//'type' => 'select',
								'type' => 'value',
								'title' => $language['admin']['userStatus'],
								'useInAddForm' => 'y',
								//'addVariable' => $_POST['user_status_id'],
								'defaultValue' => $UserInfo['user_status'],
								'useInList' => $CONFIG['useInListSort'],
								'notUsedInDB' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								//'values' => $UserStatusSelect,
								'orderby' => $TabFields['us']['title'],
								'tabord' => 'us.',
								),

				'user_status_inform_id' => array(
								'type' => 'select',
								'title' => $language['admin']['userStatusInform'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['user_status_inform_id'],
								//'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'values' => $UserStatusInformSelect,
								'orderby' => $TabFields['usi']['title'],
								'tabord' => 'usi.',
								),

				'language_id' => array(
								'type' => 'select',
								'title' => $language['admin']['userLanguage'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['language_id'],
								//'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'values' => $LanguagesSelect,
								//'orderby' => $TabFields['l']['title'],
								'tabord' => 'l.',
				),

				'date_registration' => array(
								'type' => 'value',
								'title' => $language['admin']['registrationDateInSystem'],
								'noUseInEdit' => 'y',
				),

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

	$NoUse['BackButton'] = 'y';
	$NoUse['DeleteButton'] = 'y';

?>