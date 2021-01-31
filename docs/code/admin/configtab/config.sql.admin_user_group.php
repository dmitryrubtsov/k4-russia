<?php

	$WorkTableKeyFieldName = 'admin_user_group_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['aug'] = getFieldNamesWithLangs($WorkTable, array('title'));
	$TabFields['am'] = getFieldNamesWithLangs($_SQL_TABLE['menu_admin'], array('title'));

	//$AdminMenuSelect = array_kv(getTableAsArray($_SQL_TABLE['admin_menu'], 'menu_group', array(), '', 'id,'.$TabFields['am']['title']), $TabFields['am']['title'], 'id');
   // $AdminMenuSelected = array_kv(getTableAsArray($_SQL_TABLE['admin_menu'], 'position', array(), '', 'admin_menu_id,'.$TabFields['am']['title']), $TabFields['am']['title'], 'admin_menu_id');


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["adminUserGroups"]." :: ".$Item["'.$TabFields['aug']['title'].'"];';

		$query = "	SELECT am.admin_menu_id, am.title".__FLANG." AS title
					FROM ".$_SQL_TABLE['admin_user_group_admin_menu']." augam
	 				LEFT JOIN ".$_SQL_TABLE['admin_menu']." am ON am.admin_menu_id = augam.admin_menu_id
	 				WHERE augam.".$WorkTableKeyFieldName." = '".$_REQUEST[getKeyVarName()]."'
				";
        $dbSet->open($query);
        $AdminMenuSelect = $dbSet->fetchRowsAll();
        $AdminMenuSelected = array_kv($AdminMenuSelect, 'title', 'admin_menu_id');
	}
	else
	{
		$PageTitle = '$language["admin"]["adminUserGroups"];';
		$AloneMode = $GlobPart;
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								//'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '100',
                )
    );

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				/*'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatSymbols'],
								'editFormOther' => 'disabled',
								'maxlength' => '50',
								'size' => '30',
								'unique' => 'y',
								), */

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

                'admin_menu_list' => array(
                                'type' => 'relation_field',
                                'title' => $language['admin']['adminMenuForUserGroup'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['admin_menu_list'],
                                //'required' => $CONFIG['AdminReqPatAll'],
                                'listValues' => $AdminMenuSelected,
                                'listOfRelations' => 'y',
                                'relationType' => 'idsOnly',
                                'size' => '10',
                                'maxlength' => '10',
                                'other' => 'disabled',
                                'openLink' => '',
                                'value' => join(',', array_keys($AdminMenuSelected)),
                                'openLinkParams' => array(
                                            'mode' => 'get_values',
                                            'elemid' => 'admin_menu_list',
                                            'tsk' => 'get_admin_menu_lists',
                                            'cntonly' => 'y',
                                            'resize_win' => 'y',
                                            'currval' => '"+document.getElementById("admin_menu_list").value+"',

                                ),
                                'relationTable' => array(
                                            'name' => $_SQL_TABLE['admin_user_group_admin_menu'],
                                            'keyField' => $WorkTableKeyFieldName,
                                            'relatedField' => 'admin_menu_id',
                                            'keyFieldValue' => $_REQUEST[getKeyVarName()],
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