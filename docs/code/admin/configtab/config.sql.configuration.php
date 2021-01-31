<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  $WorkTableKeyFieldName = 'name';

  $TabFields['ct'] = getFieldNamesWithLangs($_SQL_TABLE['configuration_type'], array('title'));
  $ConfigurationTypesSelect = array_kv(getTableAsArray($_SQL_TABLE['configuration_type'], $TabFields['ct']['title'], array(), '', 'code,'.$TabFields['ct']['title']), $TabFields['ct']['title'], 'code');


  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["configuration"]." :: ".$Item["name"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["configuration"];';
  	$AloneMode = $GlobPart;

  	$Query['FromTables'] = 	$WorkTable." c
  							LEFT JOIN ".$_SQL_TABLE['configuration_type']." ct ON ct.code = c.configuration_type
  							";
  	$Query['Fields'] = "c.*, ct.".$TabFields['ct']['title']." AS configuration_type";
  	$Query['TabOrder'] = "c.";
  	$Query['Where'] = "";
  	$Query['GroupBy'] = "";

  	$EnableFilter = true;

  	$listInfo['where']['configuration_type'] = array(
  								'simple' => 'y',
  								'SQLField' => "c.configuration_type = '".$CONFIG['AdminFilterValuePat']."'",
  								'type' => 'select',
  								'title' => $language['admin']['type'],
  								'values' => array('' => $language['admin']['all']) + $ConfigurationTypesSelect,
  								'JSact' => '',
  								);

  	$listInfo['where']['name'] = array(
  								'simple' => 'y',
  								'SQLField' => "c.name LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
  								'type' => 'input',
  								'title' => $language['admin']['name'],
  								'JSact' => '',
  								);

  	$listInfo['where']['val'] = array(
  								'simple' => 'y',
  								'SQLField' => "c.value LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
  								'type' => 'input',
  								'title' => $language['admin']['value'],
  								'JSact' => '',
  								);

    require_once __CFG_PATH_CODE."admin.filter.inc";

  }


  $_SQL_TABLE_FIELDS[$GlobPart] = array(
				'name' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'editFormOther' => 'disabled',
								'addVariable' => $_POST['name'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '50',
								'size' => '40',
								'unique' => 'y',
								),

				'value' => array(
								'type' => 'input',
								'title' => $language['admin']['value'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['value'],
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'size' => '40',
								//'SmartyMods' => array('slashes'),
								//'inListSmartyMods' => array('slashes'),
								),

				'configuration_type' => array(
								'type' => 'select',
								'title' => $language['admin']['type'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['configuration_type'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								'values' => $ConfigurationTypesSelect,
								'orderby' => $TabFields['ct']['title'].',c.name',
								'tabord' => 'ct.',
								'required' => $CONFIG['AdminReqPatAll'],
								),

				'description' => array(
								'type' => 'textarea',
								'title' => $language['admin']['description'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['description'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
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

  //$NoUse['DeleteButton'] = 'y';
  $NoUse['ActivateButton'] = 'y';
  $NoUse['DeactivateButton'] = 'y';

?>