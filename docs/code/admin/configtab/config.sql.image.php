<?php

	$WorkTableKeyFieldName = 'image_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];


	$TabFields['ii'] = getFieldNamesWithLangs($_SQL_TABLE['image_info'], array('title'));


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["image"]." :: ".$Item["'.$TabFields['ii']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["images"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." i
							INNER JOIN ".$_SQL_TABLE['image_info']." ii ON ii.".$WorkTableKeyFieldName." = i.".$WorkTableKeyFieldName."";
		$Query['Fields'] = "i.*, ii.*";
		$Query['TabOrder'] = "i.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "i.".$WorkTableKeyFieldName;
        /*
		$EnableFilter = true;

		$listInfo['where']['gallery_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "p.gallery_id = '".$_REQUEST['gallery_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['photoGallery'],
  								'values' => array('' => $language['admin']['all']) + $GalleriesSelect,
  								'JSact' => '',
   								);

		require_once __CFG_PATH_CODE."admin.filter.inc";   */
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['image_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								//'makeSameValue' => 'linkname',
								//'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '255',
								'size' => '60',
								),

				'alt_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['image_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['title'].' alt',
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								//'makeSameValue' => 'linkname',
								//'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '255',
								'size' => '60',
								),
				);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

  //$LinkName = make_linkname($_POST['linkname']);
	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				/*'linkname' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['partner_info'],
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
								), */

				/*'link' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['partner_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['link'],
								'addVariable' => $_POST['link'],
								'useInAddForm' => 'y',
								//'unique' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								//'required' => $CONFIG['AdminReqPatLinkName'],
								'maxlength' => '255',
								'size' => '60',
								),*/

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

				/*'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								),

		  		/*'partner_image' => array(
				  				'type' => 'image',
				  				'subTable' => array(
										'table' => $_SQL_TABLE['partner_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				//'filetype' => '.jpg,.gif',
				  				'filenameLength' => 10,
				  				'filenameSymbols' => 'DL',
				  				//'filenamePrefix' => $CONFIG['partnerImagePrefix'],
				  				'old_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['partnerImageFolder'],
				  				'dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['partnerImageFolder'],
				  				'docroot_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['partnerImageFolder'],
				  				'title' => $language['admin']['image']." - ".$language['admin']['maxSizeForPartnerLogo'],
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
		  		),*/

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>