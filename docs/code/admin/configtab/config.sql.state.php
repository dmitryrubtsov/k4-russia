<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  $_FLAGS['NoCheckLangFieldsInTable'] = __TRUE;

  $TabFields['c'] = getFieldNamesWithLangs($_SQL_TABLE['country'], array('title'));
  $TabFields['s'] = getFieldNamesWithLangs($WorkTable, array('title'));
  $CountriesSelect = array_kv(getTableAsArray($_SQL_TABLE['country'], $TabFields['c']['title'], array(), '', $CONFIG['CountryCodeField'].','.$TabFields['c']['title']), $TabFields['c']['title'], $CONFIG['CountryCodeField']);

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["states"]." :: ".$Item["'.$TabFields['s']['title'].'"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["states"];';
  	$AloneMode = $GlobPart;

  	$Query['FromTables'] = 	$WorkTable." s
  							LEFT JOIN ".$_SQL_TABLE['country']." c ON c.".$CONFIG['CountryCodeField']." = s.country
  							";
  	$Query['Fields'] = "s.*, c.".$TabFields['c']['title']." AS country";
  	$Query['TabOrder'] = "s.";
  	$Query['Where'] = "";
  	$Query['GroupBy'] = "";

  	$EnableFilter = true;

  	$listInfo['where']['country'] = array(
  								'simple' => 'y',
  								'SQLField' => "s.country = '".$CONFIG['AdminFilterValuePat']."'",
  								'type' => 'select',
  								'title' => $language['admin']['country'],
  								'values' => array('' => $language['admin']['all']) + $CountriesSelect,
  								'JSact' => '',
  								);

    require_once __CFG_PATH_CODE."admin.filter.inc";
  }

  $ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								));

  $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

  $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => $CONFIG['AdminReqPatSymbols'],
								'size' => 3,
								'maxlength' => '3',
								),

                'country' => array(
								'type' => 'select',
								'title' => $language['admin']['country'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['country'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $CountriesSelect,
								'orderby' => $TabFields['c']['title'].',s.'.$TabFields['s']['title'],
								'tabord' => 'c.',
								'required' => $CONFIG['AdminReqPatAll'],
								),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => $CONFIG['addStateActive'],
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'y' => array(
													'title' => $language['admin']['active'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'n',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'n' => array(
													'title' => $language['admin']['inactive'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'y',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

  );
  $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

  $NoUse['SaveButton'] = 'y';

?>