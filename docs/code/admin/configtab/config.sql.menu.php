<?php

	$WorkTableKeyFieldName = 'menu_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['m'] = getFieldNamesWithLangs($WorkTable, array('title'));
	$TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));
	$TabFields['mb'] = getFieldNamesWithLangs($_SQL_TABLE['menu_block'], array('title'));

	$MenuList = getTableAsArray($WorkTable, 'position', array(), '', 'menu_id, parent_menu_id,'.$TabFields['m']['title']);
	$MenuListTree = arrayToTree($MenuList, $root=0, $rootField='parent_menu_id', $idField='menu_id', $childField='children');
	$MenuList = treeToSelectList($MenuListTree, $root=0, $rootField="parent_menu_id", $TabFields['m']['title'], $childField='children', $prefix="&nbsp;&nbsp;&nbsp;&nbsp;");
	$MenuListSelect = array_kv($MenuList, $TabFields['m']['title'], 'menu_id');

//    $menu_group = $DfSelect->from(array($_SQL_TABLE['menu_group']), array('menu_group_id', 'title'.__FLANG))->fetchPairs();
	unset($MenuListTree,$MenuList);

	$query = "	SELECT a.article_id, ai.title".__FLANG." AS title
				FROM ".$_SQL_TABLE['article']." a
				INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
				WHERE a.active = 1
				AND a.article_type_id = 3
				ORDER BY ai.title".__FLANG."
			";
	$dbSet->open($query);
	$ArticleArray = $dbSet->fetchRowsAll();
	$ArticlesSelect = array();
	foreach($ArticleArray as $n => $array)
	{
		$ArticlesSelect[$array['article_id']] = $array['title'];
	}

	$MenuBlocksSelect = array_kv(getTableAsArray($_SQL_TABLE['menu_block'], $TabFields['mb']['title'], array("active = 1"), '', 'id,'.$TabFields['mb']['title']), $TabFields['mb']['title'], 'id');

	if($_REQUEST[mode] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["siteMenu"]." :: ".$Item["'.$TabFields['m']['title'].'"];';
		$RowItem = getRowByField($WorkTable, $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
		$MenuBlocksSelected = array_kv(getTableAsArray($_SQL_TABLE['menu_block'], 'id', array("id IN ('".str_replace($CONFIG['AdminListInRowDelim'], "','", $RowItem['menu_block'])."')"), '', 'id,'.$TabFields['mb']['title']), $TabFields['mb']['title'], 'id');
	}
	else
	{
		$PageTitle = '$language["admin"]["siteMenu"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['menuEmptyList'];

		$Query['FromTables'] = 	$WorkTable." m
  							LEFT JOIN ".$WorkTable." mp ON mp.menu_id = m.parent_menu_id
  							LEFT JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = m.article_id";
		$Query['Fields'] = "m.*, mp.".$TabFields['m']['title']." AS parent_menu_id, ai.".$TabFields['ai']['title']." AS article_id";
		$Query['TabOrder'] = "m.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "";

		if(!$listInfo['order'])
		{
			$listInfo['order'] = "position";
			$listInfo['order_type'] = "ASC";
		}

		$EnableFilter = true;

		/*$listInfo['where']['menu_block'] = array(
  								'simple' => 'y',
  								'SQLField' => "FIND_IN_SET('".$_REQUEST['menu_block']."', m.menu_block) > 0",
  								'type' => 'select',
  								'title' => $language['admin']['frontMenuBlock'],
  								'values' => array('' => ucfirst($language['admin']['all'])) + $MenuBlocksSelect,
  								'JSact' => '',
  								);  */

		$listInfo['where']['parent_menu_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "m.parent_menu_id = '".$_REQUEST['parent_menu_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['mainSection'],
  								'values' => array('' => $language['admin']['all'], '0' => $language['admin']['allMainSections']) + $MenuListSelect,
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
								'makeSameValue' => 'linkname',
								'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '100',
								'size' => '50',
				),
	);


	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	$LinkName = make_linkname($_POST['linkname']);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'parent_menu_id' => array(
								'type' => 'select',
								'title' => $language['admin']['mainSection'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['parent_menu_id'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => array('0' => " -- ".strToUpperCase($language['admin']['mainSection'])." -- ") + $MenuListSelect,
								'orderby' => 'sc.'.$TabFields['sc']['title'],
								),
//              'menu_group_id' => array(
//                  'type' => 'select',
//                  'title' => $language["admin"]["menuGroups"],
//                  'useInAddForm' => 'y',
//                  'addVariable' => $_POST['menu_group_id'],
//                  'required' => $CONFIG['AdminReqPatAll'],
//                  'values' => array('0' => " -- ".strToUpperCase($language['admin']['none'])." -- ") + $menu_group,
////                  'orderby' => 'sc.'.$TabFields['sc']['title'],
//              ),

				/*'menu_block' => array(

								'type' => 'relation_field',
								'title' => $language['admin']['frontMenuBlock'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['menu_block'],
								'required' => $CONFIG['AdminReqPatAll'],
								'listValues' => $MenuBlocksSelected,
								'listToField' => 'y',
								'size' => '10',
								'maxlength' => '10',
								'other' => 'disabled',
								'openLink' => '',
								'openLinkParams' => array(
													'mode' => 'get_values',
													'elemid' => 'menu_block',
													'tsk' => 'get_menu_blocks',
													'cntonly' => 'y',
													'resize_win' => 'y',
													'currval' => '"+document.getElementById("menu_block").value+"',

										),
								),  */
/*
				'linkname' => array(
								'type' => 'input',
								'title' => $language['admin']['linkName'],
								'addVariable' => $LinkName,
								'useInAddForm' => 'y',
								'unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatLinkName'],
								'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '100',
								'size' => '50',
								),*/
/*
		  		'code' => array(
				  				'type' => 'input',
				  				'title' => $language['admin']['code'],
				  				'useInAddForm' => 'y',
				  				//'editFormOther' => 'disabled',
				  				'addVariable' => $_POST['code'],
				  				'useInList' => $CONFIG['useInListSort'],
				  				//'required' => $CONFIG['AdminReqPatVariable'],
				  				'maxlength' => '50',
				  				'size' => '25',
				  				//'unique' => 'y',
				  				),
    */
				/*
				'color' => array(
								'type' => 'input',
								'title' => $language['admin']['color'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['color'],
								'useInListEdit' => 'y',
								'size' => '10',
								'maxlength' => '10',
				),
				*/

  				'outerlink' => array(
				  				'type' => 'input',
				  				'title' => $language['admin']['outerLink'],
				  				'useInAddForm' => 'y',
				  				'addVariable' => $_POST['outerlink'],
				  				'useInList' => $CONFIG['useInListSort'],
				  				//'allowEmpty' => 'y',
				  				//'inListEdit' => 'list_input',
				  				'useInListEdit' => 'y',
				  				'size' => '50',
				  				'maxlength' => '255',
				  				),

		  		'article_id' => array(
				  				'type' => 'select',
				  				'title' => $language['admin']['pageOnSite'],
				  				'useInAddForm' => 'y',
				  				'addVariable' => $_POST['article_id'],
				  				'useInList' => $CONFIG['useInListSort'],
				  				//'required' => $CONFIG['AdminReqPatAll'],
				  				'values' => array('' => $language['admin']['selectPageOnSite']) + $ArticlesSelect,
				  				'orderby' => $TabFields['ai']['title'],
				  				'tabord' => 'af.',
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


				'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
				),

                /*
		  		'multi_image' => array(
				  				'type' => 'multi_image',
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				'useInAddFormLocation' => 'full',
				  				//'filetype' => '.jpg,.gif',
				  				'filenameLength' => 10,
				  				//'id' => getmicrotime().''.generate_password(4),
				  				'id' => 'uploader1',
				  				'maxFileSize' => '100kb',
				  				'uniqueNames' => true,
				  				'filenameSymbols' => 'DL',
				  				//'filenamePrefix' => $CONFIG['partnerImagePrefix'],
				  				'old_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['menuImageFolder'],
				  				'dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['menuImageFolder'],
				  				'docroot_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['menuImageFolder'],
				  				'title' => $language['admin']['multiImagesUploadeField'],
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
		  		),  */

	);

/*
if($RowItem['parent_menu_id'] == 1)
	{
		$_SQL_TABLE_FIELDS[$GlobPart] = $_SQL_TABLE_FIELDS[$GlobPart] + array(

				'menu_image_id' => array(
				  				'type' => 'image',
				  				//'useInAddFormLocation' => 'full',
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				'filenameLength' => 12,
				  				'filenameSymbols' => 'DL',
				  				'filePathFolderCount' => 4,
				  				'filePathFolderSymbol' => 2,
                                'addVariable' => $_POST['menu_image_id'],
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
								'storeFolder' => 'image',
				  				'storeTable' => array(
									'keyField' => 'image_id',
									'tableName' => $_SQL_TABLE['image'],
									'tableInfoName' => $_SQL_TABLE['image_info'],
								),
		  		),
		);
	}
*/

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');


?>