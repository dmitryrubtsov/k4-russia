<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];

  /*$TabFields['ct'] = getFieldNamesWithLangs($_SQL_TABLE['client_type'], array('title'));
  $ClientTypesSelect = array_kv(getTableAsArray($_SQL_TABLE['client_type'], $TabFields['ct']['title'], array(), '', 'id,'.$TabFields['ct']['title']), $TabFields['ct']['title'], 'id');
  $ClientDomainsSelect = array_kv(getTableAsArray($_SQL_TABLE['client_domain'], 'sitedomain', array(), '', 'id,sitename'), 'sitename', 'id');
  $LanguagesSelect = array_kv($SITE_LANGS, 'title', 'code');
  foreach($ClientTypesSelect as $code => $title)
  {
    $ClientDomainsFilterSelect[$code] = array('' => $language['admin']['all']) + array_kv(getTableAsArray($_SQL_TABLE['client_domain'], 'sitedomain', array("client_type = '".$code."'"), '', 'id,sitename'), 'sitename', 'id');
  }*/

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["subscribers"]." :: ".$Item["email"];';
  }
  else
  {

  	$PageTitle = '$language["admin"]["subscribers"];';
  	$AloneMode = $GlobPart;

  	$Query['FromTables'] = 	$WorkTable." s
  							";
  	$Query['Fields'] = "s.*";
  	$Query['TabOrder'] = "s.";
  	$Query['Where'] = "";
  	$Query['GroupBy'] = "";

  	/*$EnableFilter = true;

  	$listInfo['where']['sitedomain'] = array(
  								'simple' => 'y',
  								'SQLField' => "cd.sitedomain LIKE '%".$_REQUEST['sitedomain']."%'",
  								'type' => 'input',
  								'title' => $language['admin']['siteDomain'],
  								);

  	$listInfo['where']['client_type'] = array(
  								'simple' => 'y',
  								'SQLField' => "cd.client_type = '".$_REQUEST['client_type']."'",
  								'type' => 'select',
  								'title' => $language['admin']['clientType'],
  								'values' => array('' => $language['admin']['all']) + $ClientTypesSelect,
  								'other' => 'onchange="setfilter_client_domain(this.value);"',
  								'newRow' => 'y',
  								);

  	$listInfo['where']['client_domain'] = array(
  								'simple' => 'y',
  								'SQLField' => "s.client_domain = '".$_REQUEST['client_domain']."'",
  								'type' => 'JSselect',
  								'title' => $language['admin']['clientDomain'],
  								'values' => $ClientDomainsFilterSelect,
  								'parentID' => 'filter_client_type',
  								'emptyValue' => $language['admin']['all'],
  								);

    require_once __CFG_PATH_CODE."admin.filter.inc";  */
  }


  $_SQL_TABLE_FIELDS[$GlobPart] = array(

				'email' => array(
								'type' => 'input',
								'title' => $language['admin']['email'],
								'addVariable' => $_POST['email'],
								'useInAddForm' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['emailPattern'],
								'textUnderField' => '<span class="red">'.$language['admin']['example'].': test@example.com</span>',
								'maxlength' => '50',
								),

				/*'name' => array(
								'type' => 'input',
								'title' => $language['admin']['username'],
								'addVariable' => $_POST['name'],
								'useInAddForm' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								),

				'language' => array(
								'type' => 'select',
								'title' => $language['admin']['language'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['language'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $LanguagesSelect,
								'required' => $CONFIG['AdminReqPatAll'],
								),

				'client_domain' => array(
								'type' => 'select',
								'title' => $language['admin']['clientDomain'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $ClientDomainsSelect,
								'addVariable' => $_POST['client_domain'],
								'useInAddForm' => 'y',
								'orderby' => 'sitename,s.date DESC',
								'tabord' => 'cd.',
								'required' => $CONFIG['AdminReqPatAll'],
								),  */

				'send' => array(
								'type' => 'select_link',
								'title' => $language['admin']['sendNewsletters'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => 'y',
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'y' => array(
													'title' => $language['admin']['yes'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'n',
																	'varname' => 'send',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'n' => array(
													'title' => $language['admin']['no'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'y',
																	'varname' => 'send',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => $CONFIG['addClientDomainActive'],
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

				'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								'inListSmartyMods' => array('date_format:"%d.%m.%Y"'),
								'inListWzTooltip' => 'y',
								'inListWzTooltipSmartyMods' => array('date_format:"%d.%m.%Y %H:%M:%S"'),
								),

  );

  $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

  $NoUse['SaveButton'] = 'y';


?>