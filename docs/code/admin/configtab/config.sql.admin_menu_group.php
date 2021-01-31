<?php

	$WorkTableKeyFieldName = 'admin_menu_group_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['amg'] = getFieldNamesWithLangs($WorkTable, array('title'));


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["menuGroups"]." :: ".$Item["'.$TabFields['amg']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["menuGroups"];';
		$AloneMode = $GlobPart;
	}

  $ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '80',
								));

  $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);

  $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'langvarname' => array(
								'type' => 'input',
								'title' => $language['admin']['langVarName'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['langvarname'],
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '70',
								),

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatSymbols'],
								'editFormOther' => 'disabled',
								'maxlength' => '10',
								'size' => '10',
								'unique' => 'y',
								),

				'position' => array(
								'type' => 'input',
								'title' => $language['admin']['sorting'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['position'],
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'size' => '3',
								'maxlength' => '2',
								'required' => $CONFIG['AdminReqPatDigits'],
								),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => $CONFIG['addAdminMenuGroupActive'],
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