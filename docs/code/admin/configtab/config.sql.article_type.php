<?php

	$WorkTableKeyFieldName = 'article_type_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['at'] = getFieldNamesWithLangs($WorkTable, array('title'));

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["siteInformationType"]." :: ".$Item["'.$TabFields['at']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["siteInformationTypes"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['siteInformationTypesEmptyList'];

		if(!$listInfo['order'])
		{
			$listInfo['order'] = "position";
			$listInfo['order_type'] = "ASC";
		}
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '100',
				),

	);

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
				),

				/*
                'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '1',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'noUseInEdit' => 'y',
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
				*/

		        /*
                'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
				),
		        */

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');


?>