<?php

	$WorkTableKeyFieldName = 'user_status_inform_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['usi'] = getFieldNamesWithLangs($_SQL_TABLE['user_status_inform'], array('title'));

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["userStatusInform"]." :: ".$Item["'.$TabFields['usi']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["userStatusesInform"];';
		$AloneMode = $GlobPart;
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'maxlength' => '50',
								'size' => '40',
								));

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'position' => array(
								'type' => 'input',
								'title' => $language['admin']['position'],
								'size' => '3',
								'useInAddForm' => 'y',
								'addVariable' => $_POST['position'],
								'useInList' => $CONFIG['useInListSort'],
								'allowEmpty' => 'y',
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'maxlength' => '3',
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
	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

	$NoUse['Edit'] = 'y';

?>