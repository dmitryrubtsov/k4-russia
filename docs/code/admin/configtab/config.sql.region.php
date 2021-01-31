<?php

	$WorkTableKeyFieldName = 'region_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['ri'] = getFieldNamesWithLangs($_SQL_TABLE['region_info'], array('title'));
	$TabFields['ci'] = getFieldNamesWithLangs($_SQL_TABLE['country_info'], array('title'));

	$CountriesSelect = array_kv(getTableAsArray($_SQL_TABLE['country_info'], $TabFields['ci']['title'], array(), '', 'country_id,'.$TabFields['ci']['title']), $TabFields['ci']['title'], 'country_id');

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["region"]." :: ".$Item["'.$TabFields['ci']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["regions"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." r
  							INNER JOIN ".$_SQL_TABLE['region_info']." ri ON ri.".$WorkTableKeyFieldName." = r.".$WorkTableKeyFieldName."
  							LEFT JOIN ".$_SQL_TABLE['country_info']." ci ON ci.country_id = r.country_id
  							";
		$Query['Fields'] = "r.*, ri.".$TabFields['ri']['title'].", ri.linkname, ci.".$TabFields['ci']['title']." AS country_id";
		$Query['TabOrder'] = "r.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "r.".$WorkTableKeyFieldName;

		$EnableFilter = true;

		$listInfo['where']['country_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "r.country_id = '".$_REQUEST['country_id']."'",
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
								'subTable' => array(
										'table' => $_SQL_TABLE['region_info'],
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

				'country_id' => array(
								'type' => 'select',
								'title' => $language['admin']['country'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['country_id'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => $CountriesSelect,
								'orderby' => $TabFields['ci']['title'],
								'tabord' => 'ci.',
								),

				'linkname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['region_info'],
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