<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  $WorkTableKeyFieldName = 'name';

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["errors"]." :: ".$Item["name"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["errors"];';
  	$AloneMode = $GlobPart;
  }

  $_SQL_TABLE_FIELDS[$GlobPart] = array(
				'name' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'size' => '47',
								'useInAddForm' => 'y',
								'editFormOther' => 'disabled',
								'addVariable' => $_POST['name'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '50',
								'unique' => 'y',
								),

				'description' => array(
								'type' => 'fckeditor',
								'title' => $language['admin']['description'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['description'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
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
  $NoUse['SaveButton'] = 'y';

?>