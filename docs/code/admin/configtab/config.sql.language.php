<?php

	$WorkTableKeyFieldName = 'language_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["languages"]." :: ".$Item["title_system"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["languages"];';
		$AloneMode = $GlobPart;
	}

	$_SQL_TABLE_FIELDS[$GlobPart] = array(

				'code2' => array(
								'type' => 'input',
								'title' => $language['admin']['languageCode2'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code2'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => '\w{2}',
								'size' => '2',
								'maxlength' => '2',
								'unique' => 'y',
								),

				'code3' => array(
								'type' => 'input',
								'title' => $language['admin']['languageCode3'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code3'],
								//'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => '\w{3}',
								'size' => '3',
								'maxlength' => '3',
								'unique' => 'y',
								),

				'title' => array(
								'type' => 'input',
								'title' => $language['admin']['languageTitle'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['title'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								),

				'title_system' => array(
								'type' => 'input',
								'title' => $language['admin']['languageTitleSystem'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['title_system'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								),

				'title_short' => array(
								'type' => 'input',
								'title' => $language['admin']['languageTitleShort'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['title_short'],
								//'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								//'required' => '\w{3}',
								'size' => '3',
								'maxlength' => '3',
								//'unique' => 'y',
								),

				'locale' => array(
								'type' => 'input',
								'title' => $language['admin']['languageLocale'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['locale'],
								//'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								),

				'filename' => array(
								'type' => 'input',
								'title' => $language['admin']['languageFileName'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['filename'],
								'useInList' => $CONFIG['useInListSort'],
								//'noUseInEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '50',
								),

                'site_lang' => array(
								'type' => 'select_link',
								'title' => $language['admin']['siteLanguage'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '0',
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'1' => array(
													'title' => $language['admin']['yes'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '0',
																	'varname' => 'site_lang',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'0' => array(
													'title' => $language['admin']['no'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'site_lang',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

				'admin_lang' => array(
								'type' => 'select_link',
								'title' => $language['admin']['adminLanguage'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '0',
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'1' => array(
													'title' => $language['admin']['yes'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '0',
																	'varname' => 'admin_lang',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'0' => array(
													'title' => $language['admin']['no'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'admin_lang',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				),

				/*'db_created' => array(
								'type' => 'select_link',
								'title' => $language['admin']['dbCreated'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => 'n',
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
																	'varname' => 'db_created',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'n' => array(
													'title' => $language['admin']['no'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'y',
																	'varname' => 'db_created',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
				), */

				'position' => array(
								'type' => 'input',
								'title' => $language['admin']['position'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['position'],
								'useInList' => $CONFIG['useInListSort'],
								'size' => 2,
								'maxlength' => '2',
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								),

				'status_id' => array(
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
																	'varname' => 'status_id',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'0' => array(
													'title' => $language['admin']['inactive'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'status_id',
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
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
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

		  		'front_image_id' => array(
				  				'type' => 'image',
				  				//'useInAddFormLocation' => 'full',
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				'filenameLength' => 12,
				  				'filenameSymbols' => 'DL',
				  				'filePathFolderCount' => 4,
				  				'filePathFolderSymbol' => 2,
                                'addVariable' => $_POST['front_image_id'],
                                'sizes' => array(
                                	'orig' => array(
                                		'handler' => null,
                                		'folderName' => 'orig',
                                		'tableFieldPath' => 'orig_path',
                                		'tableFieldWidth' => 'orig_width',
                                		'tableFieldHeight' => 'orig_height',
                                	),
                                ),
				  				'title' => $language['admin']['frontImageIcon'],
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				//'notUsedInDB' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
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

				/*'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								),*/

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>