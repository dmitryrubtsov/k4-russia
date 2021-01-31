<?php

	$WorkTableKeyFieldName = 'gallery_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];


	$TabFields['gi'] = getFieldNamesWithLangs($_SQL_TABLE['gallery_info'], array('title'));


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["photoGallery"]." :: ".$Item["'.$TabFields['gi']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["photoGalleries"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." g
							INNER JOIN ".$_SQL_TABLE['gallery_info']." gi ON gi.".$WorkTableKeyFieldName." = g.".$WorkTableKeyFieldName."
  							";
		$Query['Fields'] = "g.*, gi.*";
		$Query['TabOrder'] = "g.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "g.".$WorkTableKeyFieldName;

		//$listInfo['order'] 	= 'p_date';
		//$listInfo['order_type']	= 'DESC';
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['galleryTitle'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'makeSameValue' => 'linkname',
								'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '255',
								'size' => '60',
								'tabord' => 'gi.',
				),

		  		/*
		  		'description_' => array(
				  				'type' => 'textarea',
				  				'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
				  				'title' => $language['admin']['galleryDescription'],
				  				'useInAddForm' => 'y',
				  				'addVariable' => $_POST,
								'id' => 'description-area',
  				),
  				*/

  				'text_' => array(
								'type' => 'fckeditor',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['photoGalleryText'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'SmartyMods' => array('unescape'),
								'useInAddFormLocation' => 'full',
				),

				'meta_keywords_' => array(
								'type' => 'textarea',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['metaKeywords'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'id' => 'meta',
								),

				'meta_description_' => array(
								'type' => 'textarea',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['metaDescription'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'id' => 'meta',
								),

				'meta_title_' => array(
								'type' => 'textarea',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['metaTitle'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								//'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								'id' => 'meta',
								),
				);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$LinkName = make_linkname($_POST['linkname']);
	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'linkname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['gallery_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['linkName'],
								'addVariable' => $LinkName,
								'useInAddForm' => 'y',
								'unique' => 'y',
								//'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatLinkName'],
								'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '255',
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
				  				'title' => $language['admin']['photoGalleryPreviewImage'],
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
				  				'listOfRelations' => 'y',
								'relationType' => 'idOne',
								'storeFolder' => 'image',
				  				'storeTable' => array(
									'keyField' => 'image_id',
									'tableName' => $_SQL_TABLE['image'],
									'tableInfoName' => $_SQL_TABLE['image_info'],
								),
								'relationTable' => array(
									'name' => $_SQL_TABLE['gallery_preview'],
									'keyField' => $WorkTableKeyFieldName,
									'relatedField' => 'image_id',
									'keyFieldValue' => $_REQUEST[getKeyVarName()],
								),
		  		),

		  		'image_ids' => array(
				  				'type' => 'multi_image',
				  				'useInAddFormLocation' => 'full',
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				'filenameLength' => 12,
				  				'filenameSymbols' => 'DL',
				  				'filePathFolderCount' => 4,
				  				'filePathFolderSymbol' => 2,
                                'addVariable' => $_POST['image_ids'],
                                'sizes' => array(
                                	'orig' => array(
                                		'handler' => null,
                                		'folderName' => 'orig',
                                		'tableFieldPath' => 'orig_path',
                                		'tableFieldWidth' => 'orig_width',
                                		'tableFieldHeight' => 'orig_height',
                                	),
                                ),
				  				'title' => $language['admin']['photoGalleryImages'],
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
				  				'listOfRelations' => 'y',
								'relationType' => 'idsOnlyAdd',
								'storeFolder' => 'image',
				  				'storeTable' => array(
									'keyField' => 'image_id',
									'tableName' => $_SQL_TABLE['image'],
									'tableInfoName' => $_SQL_TABLE['image_info'],
								),
								'relationTable' => array(
									'name' => $_SQL_TABLE['gallery_image'],
									'keyField' => $WorkTableKeyFieldName,
									'relatedField' => 'image_id',
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