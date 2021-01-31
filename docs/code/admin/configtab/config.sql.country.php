<?php

	$WorkTableKeyFieldName = 'country_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	//$_FLAGS['NoCheckLangFieldsInTable'] = __TRUE;

	$TabFields['ci'] = getFieldNamesWithLangs($_SQL_TABLE['country_info'], array('title'));

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["countries"]." :: ".$Item["'.$TabFields['ci']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["countries"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." c
  							INNER JOIN ".$_SQL_TABLE['country_info']." ci ON ci.".$WorkTableKeyFieldName." = c.".$WorkTableKeyFieldName."
  							";
		$Query['Fields'] = "c.*, ci.".$TabFields['ci']['title'].", ci.linkname";
		$Query['TabOrder'] = "c.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "c.".$WorkTableKeyFieldName;
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['country_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'makeSameValue' => 'linkname',
								'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '50',
								'size' => '60',
								));

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$LinkName = make_linkname($_POST['linkname']);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => '\w{2}',
								'size' => 2,
								'maxlength' => '2',
								'unique' => 'y',
								),

				'code3' => array(
								'type' => 'input',
								'title' => $language['admin']['code']." A3",
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code3'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => '\w{3}',
								'size' => 3,
								'maxlength' => '3',
								'unique' => 'y',
								),

				'number' => array(
								'type' => 'input',
								'title' => $language['admin']['number'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['number'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => '\d{3}',
								'size' => 3,
								'maxlength' => '3',
								'unique' => 'y',
								),

				'linkname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['country_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['linkName'],
								'addVariable' => $LinkName,
								'useInAddForm' => 'y',
								'unique' => 'y',
								//'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatLinkName'],
								'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '50',
								'size' => '60',
								),

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