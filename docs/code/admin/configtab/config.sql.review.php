<?php

	$WorkTableKeyFieldName = 'review_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];


	$TabFields['ri'] = getFieldNamesWithLangs($_SQL_TABLE['review_info'], array('name'));
	$TabFields['bi'] = getFieldNamesWithLangs($_SQL_TABLE['branch_info'], array('title'));

	$BranchesSelect = array_kv(getTableAsArray($_SQL_TABLE['branch_info'], $TabFields['bi']['title'], array(), '', 'branch_id,'.$TabFields['bi']['title']), $TabFields['bi']['title'], 'branch_id');

	$StatusSelect = array(
		'0' => $language['admin']['reviewNew'],
		'1' => $language['admin']['reviewRead'],
		'2' => $language['admin']['reviewPublication'],
		'3' => $language['admin']['reviewDelayed'],
	);

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["review"]." :: ".$Item["'.$TabFields['ri']['name'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["reviews"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." r
							INNER JOIN ".$_SQL_TABLE['review_info']." ri ON ri.".$WorkTableKeyFieldName." = r.".$WorkTableKeyFieldName."
  							LEFT JOIN ".$_SQL_TABLE['branch_info']." bi ON bi.branch_id = r.branch_id";
		$Query['Fields'] = "r.*, ri.*, bi.".$TabFields['bi']['title']." AS branch_id";
		$Query['TabOrder'] = "r.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "r.".$WorkTableKeyFieldName;

		$listInfo['order'] 	= 'p_date';
		$listInfo['order_type']	= 'DESC';

		$EnableFilter = true;

		$listInfo['where']['branch_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "r.branch_id = '".$_REQUEST['branch_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['branch'],
  								'values' => array('' => $language['admin']['all']) + $BranchesSelect,
  								'JSact' => '',
   								);

		$listInfo['where']['status'] = array(
  								'simple' => 'y',
  								'SQLField' => "r.status = '".$_REQUEST['status']."'",
  								'type' => 'select',
  								'title' => $language['admin']['status'],
  								'values' => array('' => $language['admin']['all']) + $StatusSelect,
  								'JSact' => '',
   								);

		require_once __CFG_PATH_CODE."admin.filter.inc";
	}

	$ConfLangArr = array(
				'name_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['review_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['reviewName'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								//'makeSameValue' => 'linkname',
								//'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '255',
								'size' => '60',
								),

		  		'text_' => array(
				  				'type' => 'textarea',
				  				'subTable' => array(
										'table' => $_SQL_TABLE['review_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
				  				'title' => $language['admin']['reviewText'],
				  				'useInAddForm' => 'y',
				  				'addVariable' => $_POST,
								'id' => 'description-area',
				  				),

  				/*'text_' => array(
								'type' => 'fckeditor',
								'subTable' => array(
										'table' => $_SQL_TABLE['news_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['text'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'SmartyMods' => array('unescape'),
								), */
				);

  $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

  $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'branch_id' => array(
								'type' => 'select',
								'title' => $language['admin']['branch'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['branch_id'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => $BranchesSelect,
								'orderby' => $TabFields['bi']['title'],
								'tabord' => 'bi.',
								),

				'email' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['review_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['email'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['email'],
								'required' => $CONFIG['AdminReqPatAll'],
								'useInList' => $CONFIG['useInListSort'],
								//'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'maxlength' => '50',
								'size' => '30',
								),

				'phone' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['review_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['phone'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['phone'],
								//'required' => $CONFIG['AdminReqPatAll'],
								//'useInList' => $CONFIG['useInListSort'],
								//'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'maxlength' => '50',
								'size' => '30',
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
								),

				'status' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '0',
								//'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'0' => array(
													'title' => $language['admin']['reviewNew'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'status',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'1' => array(
													'title' => $language['admin']['reviewRead'],
													'className' => 'gray',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '2',
																	'varname' => 'status',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'2' => array(
													'title' => $language['admin']['reviewPublication'],
													'className' => 'blue',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '3',
																	'varname' => 'status',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'3' => array(
													'title' => $language['admin']['reviewDelayed'],
													'className' => 'black',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'status',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

				'p_date' => array(
								'type' => 'value',
								'title' => $language['admin']['reviewDate'],
								//'addVariable' => 'NOW()',
								'notUsedInDB' => 'y',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
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