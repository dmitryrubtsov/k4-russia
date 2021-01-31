<?php

	$WorkTableKeyFieldName = 'city_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['ci'] = getFieldNamesWithLangs($_SQL_TABLE['city_info'], array('title'));
	//$TabFields['ri'] = getFieldNamesWithLangs($_SQL_TABLE['region_info'], array('title'));

	//$RegionsSelect = array_kv(getTableAsArray($_SQL_TABLE['region_info'], $TabFields['ri']['title'], array(), '', 'region_id,'.$TabFields['ri']['title']), $TabFields['ri']['title'], 'region_id');

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["city"]." :: ".$Item["'.$TabFields['ci']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["cities"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['citiesEmptyList'];


		$Query['FromTables'] = 	$WorkTable." c
  							INNER JOIN ".$_SQL_TABLE['city_info']." ci ON ci.".$WorkTableKeyFieldName." = c.".$WorkTableKeyFieldName."
  							";
		$Query['Fields'] = "c.*, ci.*, ci.linkname";
		$Query['TabOrder'] = "c.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "c.".$WorkTableKeyFieldName;


		$Query['FromTables'] = 	$WorkTable." c
  							INNER JOIN ".$_SQL_TABLE['city_info']." ci ON ci.".$WorkTableKeyFieldName." = c.".$WorkTableKeyFieldName."
  							";
		$Query['Fields'] = "c.*, ci.*";
		$Query['TabOrder'] = "c.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "c.".$WorkTableKeyFieldName;

		$EnableFilter = true;


        $i = null;
        foreach($LANGS as $key => $val)
        {
            $newRow = ($i) ? 'n': 'y';
            $listInfo['where']['title_'.$key] = array(
                'simple' => 'y',
                'SQLField' => "ci.title_".$key." LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
                'type' => 'input',
                'title' => $key,
                'JSact' => '',
                'newRow' => $newRow,
            );
            ++$i;
        }


		/*
        $listInfo['where']['region_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "c.region_id = '".$_REQUEST['region_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['region'],
  								'values' => array('' => $language['admin']['all']) + $RegionsSelect,
  								'JSact' => '',
   								);
		*/

		require_once __CFG_PATH_CODE."admin.filter.inc";
	}

	$ConfLangArr = array(

				'title_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['city_info'],
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
				)
	);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$LinkName = make_linkname($_POST['linkname']);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				/*
				'region_id' => array(
								'type' => 'select',
								'title' => $language['admin']['region'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['region_id'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => $RegionsSelect,
								'orderby' => $TabFields['ri']['title'],
								'tabord' => 'ri.',
				),
				*/

				'linkname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['city_info'],
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