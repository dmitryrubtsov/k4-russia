<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  $TabFields['mb'] = getFieldNamesWithLangs($_SQL_TABLE['menu_block'], array('title'));

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["frontMenuBlocks"]." :: ".$Item["'.$TabFields['mb']['title'].'"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["frontMenuBlocks"];';
  	$AloneMode = $GlobPart;
  }

  $ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '80',
								'size' => '50',
								));

  $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);


  $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								'maxlength' => '10',
								'required' => $CONFIG['AdminReqPatVariable'],
								),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '1',
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