<?php
    
    $WorkTableKeyFieldName = 'admin_menu_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['am'] = getFieldNamesWithLangs($WorkTable, array('title'));

	$AdminMenuList = getTableAsArray($WorkTable, 'position', array(), '', 'admin_menu_id, parent_admin_menu_id,'.$TabFields['am']['title']);
	$AdminMenuListTree = arrayToTree($AdminMenuList, $root=0, $rootField='parent_admin_menu_id', $idField='admin_menu_id', $childField='children');
	$AdminMenuList = treeToSelectList($AdminMenuListTree, $root=0, $rootField="parent_admin_menu_id", $TabFields['am']['title'], $childField='children', $prefix="----");
	$AdminMenuListSelect = array_kv($AdminMenuList, $TabFields['am']['title'], 'admin_menu_id');
	unset($AdminMenuListTree,$AdminMenuList);

	if($_REQUEST[mode] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["adminMenu"]." :: ".$Item["'.$TabFields['am']['title'].'"];';

        $query = "	SELECT aug.admin_user_group_id, aug.title".__FLANG." AS title
					FROM ".$_SQL_TABLE['admin_user_group_admin_menu']." augam
	 				LEFT JOIN ".$_SQL_TABLE['admin_user_group']." aug ON aug.admin_user_group_id = augam.admin_user_group_id
	 				WHERE augam.".$WorkTableKeyFieldName." = '".$_REQUEST[getKeyVarName()]."'
				";
        $dbSet->open($query);
        $AdminUserGroupSelect = $dbSet->fetchRowsAll();
        $AdminUserGroupSelected = array_kv($AdminUserGroupSelect, 'title', 'admin_user_group_id');
	}
	else
	{
		$PageTitle = '$language["admin"]["adminMenu"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['adminMenuEmptyList'];

		$Query['FromTables'] = 	$WorkTable." am
  							LEFT JOIN ".$WorkTable." pam ON pam.admin_menu_id = am.parent_admin_menu_id";
		$Query['Fields'] = "am.*, pam.".$TabFields['am']['title']." AS parent_admin_menu_id";
		$Query['TabOrder'] = "am.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "";

		if(!$listInfo['order'])
		{
			$listInfo['order'] = "position";
			$listInfo['order_type'] = "ASC";
		}

		$EnableFilter = true;

		$listInfo['where']['parent_admin_menu_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "am.parent_admin_menu_id = '".$_REQUEST['parent_admin_menu_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['parentAdminMenu'],
  								'values' => array('' => $language['admin']['all'], '0' => $language['admin']['allMainSections']) + $AdminMenuListSelect,
  								'JSact' => '',
   								);

		require_once __CFG_PATH_CODE."admin.filter.inc";
	}


	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								//'makeSameValue' => 'linkname',
								//'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '100',
								'size' => '50',
								),

				);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

    //$LinkName = make_linkname($_POST['linkname']);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'parent_admin_menu_id' => array(
								'type' => 'select',
								'title' => $language['admin']['parentAdminMenu'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['parent_admin_menu_id'],
								//'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => array('0' => " -- ".strToUpperCase($language['admin']['mainSection'])." -- ") + $AdminMenuListSelect,
								'orderby' => 'an.'.$TabFields['am']['title'],
                ),

		  		'linkvar' => array(
								'type' => 'input',
								'title' => $language['admin']['linkVar'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['linkvar'],
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '50',
                ),

				'addlinkvars' => array(
								'type' => 'input',
								'title' => $language['admin']['addLinkVars'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['addlinkvars'],
								//'useInList' => $CONFIG['useInListSort'],
								'maxlength' => '255',
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

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '1',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'noUseInEdit' => 'y',
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

				'admin_image_id' => array(
				  				'type' => 'image',
				  				//'useInAddFormLocation' => 'full',
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				'filenameLength' => 12,
				  				'filenameSymbols' => 'DL',
				  				'filePathFolderCount' => 4,
				  				'filePathFolderSymbol' => 2,
                                'addVariable' => $_POST['admin_image_id'],
                                'sizes' => array(
                                	'orig' => array(
                                		'handler' => null,
                                		'folderName' => 'orig',
                                		'tableFieldPath' => 'orig_path',
                                		'tableFieldWidth' => 'orig_width',
                                		'tableFieldHeight' => 'orig_height',
                                	),
                                ),
				  				'title' => $language['admin']['adminImageIcon'],
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				//'notUsedInDB' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'FTP' => array(
									'ftpServer' => __CFG_PTF_HOSTNAME,
					  				'ftpUserName' => __CFG_PTF_USERNAME,
					  				'ftpPassword' => __CFG_PTF_PASSWORD,
					  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
				  				),
				  				//'listOfRelations' => 'y',
								//'relationType' => 'idOne',
								'storeFolder' => 'admin_image',
				  				'storeTable' => array(
									'keyField' => 'admin_image_id',
									'tableName' => $_SQL_TABLE['admin_image'],
									'tableInfoName' => $_SQL_TABLE['admin_image_info'],
								),
								/*'relationTable' => array(
									'name' => $_SQL_TABLE['slider_banner_image'],
									'keyField' => $WorkTableKeyFieldName,
									'relatedField' => 'image_id',
									'keyFieldValue' => $_REQUEST[getKeyVarName()],
								),*/
		  		),

                'admin_user_group' => array(
                                'type' => 'relation_field',
                                'title' => $language['admin']['adminUserGroupForAdminMenu'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['admin_user_group'],
                                //'required' => $CONFIG['AdminReqPatAll'],
                                'listValues' => $AdminUserGroupSelected,
                                'listOfRelations' => 'y',
                                'relationType' => 'idsOnly',
                                'size' => '10',
                                'maxlength' => '10',
                                'other' => 'disabled',
                                'openLink' => '',
                                'value' => join(',', array_keys($AdminUserGroupSelected)),
                                'openLinkParams' => array(
                                    'mode' => 'get_values',
                                    'elemid' => 'admin_user_group',
                                    'tsk' => 'get_admin_user_group',
                                    'cntonly' => 'y',
                                    'resize_win' => 'y',
                                    'currval' => '"+document.getElementById("admin_user_group").value+"',

                                ),
                                'relationTable' => array(
                                    'name' => $_SQL_TABLE['admin_user_group_admin_menu'],
                                    'keyField' => $WorkTableKeyFieldName,
                                    'relatedField' => 'admin_user_group_id',
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

    if(!__LAMER)
    {
        $NoUse['AddButton'] = 'y';
        $NoUse['DeleteButton'] = 'y';
    }


?>