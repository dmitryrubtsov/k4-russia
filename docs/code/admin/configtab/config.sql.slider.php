<?php


	$WorkTableKeyFieldName = 'slider_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

    $TabFields['s'] = getFieldNamesWithLangs($WorkTable, array('title'));
    $TabFields['st'] = getFieldNamesWithLangs($_SQL_TABLE['slider_type'], array('title'));

    $SliderTypeSelect = array_kv(getTableAsArray($_SQL_TABLE['slider_type'], 'position', array(), '', 'slider_type_id,'.$TabFields['st']['title']), $TabFields['st']['title'], 'slider_type_id');

    $LinkTargetSelect = array(
        '0' => $language['admin']['targetCurrWindow'],
        '1' => $language['admin']['targetNewWindow'],
    );

    if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["slider"]." :: ".$Item["'.$TabFields['s']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["sliders"];';
		$AloneMode = $GlobPart;

        $emptyPageTooltip = $language['admin']['sliderEmptyList'];

        $Query['FromTables'] = 	$WorkTable." s
							INNER JOIN ".$_SQL_TABLE['slider_type']." st ON st.slider_type_id = s.slider_type_id";
        $Query['Fields'] = "s.*, st.".$TabFields['st']['title']." AS slider_type_id";
        $Query['TabOrder'] = "s.";
        $Query['Where'] = "";
        $Query['GroupBy'] = "s.".$WorkTableKeyFieldName;

        if(!$listInfo['order'])
        {
            $listInfo['order'] = "position";
            $listInfo['order_type'] = "ASC";
        }

        $EnableFilter = true;

        $listInfo['where']['slider_type_id'] = array(
                    'simple' => 'y',
                    'SQLField' => "s.slider_type_id = '".$_REQUEST['slider_type_id']."'",
                    'type' => 'select',
                    'title' => $language['admin']['sliderType'],
                    'values' => array('' => $language['admin']['all']) + $SliderTypeSelect,
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
                                'maxlength' => '255',
                                'size' => '60',
                ),
    );

    $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

    $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

                'slider_type_id' => array(
                                'type' => 'select',
                                'title' => $language['admin']['sliderType'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['slider_type_id'],
                                'useInList' => $CONFIG['useInListSort'],
                                'required' => $CONFIG['AdminReqPatAll'],
                                'values' => array('' => $language['admin']['selectSliderType']) + $SliderTypeSelect,
                                'orderby' => $TabFields['st']['title'].',s.'.$TabFields['s']['title'],
                                'tabord' => 'st.',
                ),

                'url' => array(
								'type' => 'input',
								'title' => $language['admin']['link'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['url'],
								'textUnderField' => '<span class="red">'.$language['admin']['sliderLinkExample'].'</span>',
								//'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'size' => '60',
								//'tabord' => 'gi.',
                ),

                'target' => array(
                                'type' => 'select',
                                'title' => $language['admin']['linkTarget'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['target'],
                                //'useInList' => $CONFIG['useInListSort'],
                                'required' => $CONFIG['AdminReqPatAll'],
                                'values' => $LinkTargetSelect,
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
                                'title' => $language['admin']['sliderImage'],
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