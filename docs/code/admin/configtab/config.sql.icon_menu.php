<?php

	$WorkTableKeyFieldName = 'icon_menu_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['im'] = getFieldNamesWithLangs($WorkTable, array('title'));

	$LinkTagrets = array(
    	'1' => $language['admin']['targetNewWindow'],
    	'0' => $language['admin']['targetCurrWindow'],
    );

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["iconMenu"]." :: ".$Item["'.$TabFields['im']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["iconMenu"];';
		$AloneMode = $GlobPart;

        $emptyPageTooltip = $language['admin']['iconMenuEmptyList'];
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
								//'makeSameValueFrom' => 'title_ru',
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'size' => '50',
								'maxlength' => '100',
				),

	);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);

	$_SQL_TABLE_FIELDS[$GlobPart] =  $GeneratedLangArr + array(

				'link' => array(
								'type' => 'input',
								'title' => $language['admin']['link'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['link'],
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'size' => '50',
				),

				'target' => array(
								'type' => 'select',
								'title' => $language['admin']['linkTarget'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['target'],
								//'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'values' => $LinkTagrets,
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

        'image_id' => array(
            'type' => 'image',
            //'useInAddFormLocation' => 'full',
            'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
            'filenameLength' => 12,
            'filenameSymbols' => 'DL',
            'filePathFolderCount' => 4,
            'filePathFolderSymbol' => 2,
            'addVariable' => $_POST['image_id'],
            'sizes' => array(
                'orig' => array(
                    'handler' => null,
                    'folderName' => 'orig',
                    'tableFieldPath' => 'orig_path',
                    'tableFieldWidth' => 'orig_width',
                    'tableFieldHeight' => 'orig_height',
                ),
            ),
            'title' => $language['admin']['imageOfIconMenu'],
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
            'storeFolder' => 'image',
            'storeTable' => array(
                'keyField' => 'image_id',
                'tableName' => $_SQL_TABLE['image'],
                'tableInfoName' => $_SQL_TABLE['image_info'],
            ),
            /*'relationTable' => array(
                'name' => $_SQL_TABLE['slider_banner_image'],
                'keyField' => $WorkTableKeyFieldName,
                'relatedField' => 'image_id',
                'keyFieldValue' => $_REQUEST[getKeyVarName()],
            ),*/
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