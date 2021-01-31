<?php

	$WorkTableKeyFieldName = 'admin_user_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['aug'] = getFieldNamesWithLangs($_SQL_TABLE['admin_user_group'], array('title'));
	$UserGroupsSelect = array_kv(getTableAsArray($_SQL_TABLE['admin_user_group'], $TabFields['aug']['title'], array(), '', 'admin_user_group_id,'.$TabFields['aug']['title']), $TabFields['aug']['title'], 'admin_user_group_id');


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["adminUsers"]." :: ".$Item["login"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["adminUsers"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." au
  							LEFT JOIN ".$_SQL_TABLE['admin_user_group']." aug ON aug.admin_user_group_id = au.admin_user_group_id
  							";
		$Query['Fields'] = "au.*, aug.".$TabFields['aug']['title']." AS admin_user_group_id";
		$Query['TabOrder'] = "au.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "";

		$EnableFilter = true;

		$listInfo['where']['admin_user_group_d'] = array(
  								'simple' => 'y',
  								'SQLField' => "au.admin_user_group_id = '".$CONFIG['AdminFilterValuePat']."'",
  								'type' => 'select',
  								'title' => $language['admin']['userGroup'],
  								'values' => array('' => $language['admin']['all']) + $UserGroupsSelect,
  								'JSact' => '',
  								);

		require_once __CFG_PATH_CODE."admin.filter.inc";

	}

	$_SQL_TABLE_FIELDS[$GlobPart] = array(

				'name' => array(
								'type' => 'input',
								'title' => $language['admin']['adminUserName'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['name'],
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatVariable'],
								//'editFormOther' => 'disabled',
								//'other' => 'onclick="alert(\''.$language['admin']['latinAlphAttention'].'\');"',
								'maxlength' => '100',
								//'unique' => 'y',
                ),

				'login' => array(
								'type' => 'input',
								'title' => $language['admin']['login'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['login'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'editFormOther' => 'disabled',
								'other' => 'onclick="alert(\''.$language['admin']['latinAlphAttention'].'\');"',
								'maxlength' => '50',
								'unique' => 'y',
                ),

				'password' => array(
								'type' => 'input',
								'title' => $language['admin']['password'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['password'],
								//'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '32',
								'md5' => 'y',
								),

				'admin_user_group_id' => array(
								'type' => 'select',
								'title' => $language['admin']['userGroup'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['admin_user_group_id'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $UserGroupsSelect,
								'orderby' => $TabFields['aug']['title'].',au.login',
								'tabord' => 'aug.',
								'required' => $CONFIG['AdminReqPatAll'],
                ),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '1',
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'1' => array(
													'title' => $language['admin']['active'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '0',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'0' => array(
													'title' => $language['admin']['inactive'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

				'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
                ),

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>