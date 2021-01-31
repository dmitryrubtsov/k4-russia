<?php

	$WorkTableKeyFieldName = 'lang_variable_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;

	$WorkTable = &$_SQL_TABLE[$GlobPart];
	$group = getTableAsArray($_SQL_TABLE['lang_variable_group']);

	$groupSelect = array_kv($group, 'lang_variable_group_name', 'lang_variable_group_id');
	$zoneSelect = array_kv(getTableAsArray($_SQL_TABLE['site_zone']), 'site_zone_name', 'site_zone_id');


	if($_REQUEST['mode'] == $GlobPart)
	{
	    $PageTitle = '$language["admin"]["languageVariables"]." :: ".$Item["lang_variable_name"];';

	    if(!__LAMER)
	    {	    	$query = "	SELECT lvg.lang_variable_group_name AS lang_variable_group_id, sz.site_zone_name AS site_zone_id
						FROM ".$_SQL_TABLE['lang_variable']." lv
						INNER JOIN ".$_SQL_TABLE['lang_variable_group']." lvg ON lvg.lang_variable_group_id = lv.lang_variable_group_id
						INNER JOIN ".$_SQL_TABLE['site_zone']." sz ON sz.site_zone_id = lv.site_zone_id
		 				WHERE lv.".$WorkTableKeyFieldName." = '".$_REQUEST[$WorkTableKeyVarName]."'
					";
			$dbSet->open($query);
			$LangVarInfo = $dbSet->fetchArray();	    }
	}
	else
	{
	    $PageTitle = '$language["admin"]["languageVariables"];';
	    $AloneMode = $GlobPart;

	    $emptyPageTooltip = $language['admin']['langVariableEmptyList'];

	    $Query['FromTables'] = 	$WorkTable." lv
								INNER JOIN ".$_SQL_TABLE['lang_variable_group']." lvg ON lvg.lang_variable_group_id = lv.lang_variable_group_id
								INNER JOIN ".$_SQL_TABLE['site_zone']." sz ON sz.site_zone_id = lv.site_zone_id
								";
	    $Query['Fields'] = "lv.*, lvg.lang_variable_group_name AS lang_variable_group_id, sz.site_zone_name AS site_zone_id";
	    $Query['TabOrder'] = "lv.";

	    $EnableFilter = true;

	    $listInfo['where']['lang_variable_group_id'] = array(
	        'simple' => 'y',
	        'SQLField' => "lv.lang_variable_group_id = '".$_REQUEST['lang_variable_group_id']."'",
	        'type' => 'select',
	        'title' => $language["admin"]["groupLanguageVariables"],
	        'values' => array('' => $language['admin']['all']) + $groupSelect,
	        'JSact' => '',
	    );
	    $listInfo['where']['site_zone_id'] = array(
	        'simple' => 'y',
	        'SQLField' => "lv.site_zone_id = '".$_REQUEST['site_zone_id']."'",
	        'type' => 'select',
	        'title' => $language["admin"]["areaSite"],
	        'values' => array('' => $language['admin']['all']) + $zoneSelect,
	        'JSact' => '',
	    );

	    if(__LAMER)
	    {
		    $listInfo['where']['name'] = array(
		        'simple' => 'y',
		        'SQLField' => "lv.lang_variable_name LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
		        'type' => 'input',
		        'title' => $language["admin"]["langVarName"],
		        'JSact' => '',
		    );
		}

	    $i = null;
	    foreach($LANGS as $key => $val)
	    {
	        $newRow = ($i) ? 'n': 'y';
	        $listInfo['where']['lang_variable_value_'.$key] = array(
	            'simple' => 'y',
	            'SQLField' => "lv.lang_variable_value_".$key." LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
	            'type' => 'input',
	            'title' => $key,
	            'JSact' => '',
	            'newRow' => $newRow,
	        );
	        ++$i;
	    }

	    require_once __CFG_PATH_CODE."admin.filter.inc";
	}


	if(__LAMER)
	{		$LangVariableName = array(

			'lang_variable_name' => array(
			        'type' => 'input',
			        'title' => $language['admin']['name'],
			        'useInAddForm' => 'y',
			        'addVariable' => $_POST['lang_variable_name'],
			        'useInList' => $CONFIG['useInListSort'],

		    ),
		);

		$LangVariableParams = array(

			'lang_variable_group_id' => array(
			        'type' => 'select',
			        'title' => $language['admin']['groupLanguageVariables'],
			        'useInAddForm' => 'y',
			        'addVariable' => $_POST['lang_variable_group_id'],
			        'useInList' => $CONFIG['useInListSort'],
			        'required' => $CONFIG['AdminReqPatAll'],
			        'values' => $groupSelect,
		    ),

		    'site_zone_id' => array(
			        'type' => 'select',
			        'title' => $language['admin']['areaSite'],
			        'useInAddForm' => 'y',
			        'addVariable' => $_POST['site_zone_id'],
			        'useInList' => $CONFIG['useInListSort'],
			        'required' => $CONFIG['AdminReqPatAll'],
			        'values' => $zoneSelect,
		    ),
		);	}
	else
	{		$LangVariableName = array();

		$LangVariableParams = array(

			'lang_variable_group_id' => array(
			        'type' => 'value',
			        'title' => $language['admin']['groupLanguageVariables'],
			        'defaultValue' => $LangVarInfo['lang_variable_group_id'],
					'useInList' => $CONFIG['useInListSort'],
					'notUsedInDB' => 'y',
		    ),

		    'site_zone_id' => array(
			        'type' => 'value',
			        'title' => $language['admin']['areaSite'],
			        'defaultValue' => $LangVarInfo['site_zone_id'],
					'useInList' => $CONFIG['useInListSort'],
					'notUsedInDB' => 'y',
		    ),
		);	}


	$ConfLangArr = array(

		    'lang_variable_value_' => array(
			        'type' => 'input',
			        'title' => $language['admin']['title'],
			        'useInAddForm' => 'y',
			        'addVariable' => $_POST,
			        'useInList' => $CONFIG['useInListSort'],
			        'required' => $CONFIG['AdminReqPatAll'],
			        'maxlength' => '255',
			        'size' => '50',
		    ),
	);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$_SQL_TABLE_FIELDS[$GlobPart] = $LangVariableName + $GeneratedLangArr + $LangVariableParams;

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

	if(!__LAMER)
	{		$NoUse['Checkbox'] = 'y';
		$NoUse['AddButton'] = 'y';
		$NoUse['DeleteButton'] = 'y';	}

	$NoUse['SaveButton'] = 'y';

?>