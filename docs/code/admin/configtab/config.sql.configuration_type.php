<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  $WorkTableKeyFieldName = 'code';
  $_FLAGS['NoCheckLangFieldsInTable'] = __TRUE;

  $TabFields['ct'] = getFieldNamesWithLangs($WorkTable, array('title'));

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["configurationTypes"]." :: ".$Item["'.$TabFields['ct']['title'].'"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["configurationTypes"];';
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
								'maxlength' => '30',
								));

  $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);

  $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

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

  $NoUse['DeleteButton'] = 'y';
  $NoUse['ActivateButton'] = 'y';
  $NoUse['DeactivateButton'] = 'y';

?>