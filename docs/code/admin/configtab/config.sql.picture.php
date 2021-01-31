<?php

	$WorkTableKeyFieldName = 'picture_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];


	$TabFields['pi'] = getFieldNamesWithLangs($_SQL_TABLE['picture_info'], array('title'));
	$TabFields['gi'] = getFieldNamesWithLangs($_SQL_TABLE['gallery_info'], array('title'));

	$GalleriesSelect = array_kv(getTableAsArray($_SQL_TABLE['gallery_info'], $TabFields['gi']['title'], array(), '', 'gallery_id,'.$TabFields['gi']['title']), $TabFields['gi']['title'], 'gallery_id');


	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["picture"]." :: ".$Item["'.$TabFields['pi']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["pictures"];';
		$AloneMode = $GlobPart;

		$Query['FromTables'] = 	$WorkTable." p
							INNER JOIN ".$_SQL_TABLE['picture_info']." pi ON pi.".$WorkTableKeyFieldName." = p.".$WorkTableKeyFieldName."
  							LEFT JOIN ".$_SQL_TABLE['gallery_info']." gi ON gi.gallery_id = p.gallery_id";
		$Query['Fields'] = "p.*, pi.*, gi.".$TabFields['gi']['title']." AS gallery_id";
		$Query['TabOrder'] = "p.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "p.".$WorkTableKeyFieldName;

		$listInfo['order'] 	= 'position';
		$listInfo['order_type']	= 'ASC';

		$EnableFilter = true;

		$listInfo['where']['gallery_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "p.gallery_id = '".$_REQUEST['gallery_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['photoGallery'],
  								'values' => array('' => $language['admin']['all']) + $GalleriesSelect,
  								'JSact' => '',
   								);

		require_once __CFG_PATH_CODE."admin.filter.inc";
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'subTable' => array(
										'table' => $_SQL_TABLE['picture_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								'title' => $language['admin']['pictureTitle'],
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
										'table' => $_SQL_TABLE['news_info'],
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
								),  */

				'gallery_id' => array(
								'type' => 'select',
								'title' => $language['admin']['photoGallery'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['gallery_id'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'values' => $GalleriesSelect,
								'orderby' => $TabFields['gi']['title'],
								'tabord' => 'gi.',
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

				'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								),

				'picture_logo_image' => array(
				  				'type' => 'image',
				  				'subTable' => array(
										'table' => $_SQL_TABLE['picture_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				//'filetype' => '.jpg,.gif',
				  				'filenameLength' => 10,
				  				'filenameSymbols' => 'DL',
				  				//'filenamePrefix' => $CONFIG['partnerImagePrefix'],
				  				'old_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'].$CONFIG['galleryLogoImageFolder'],
				  				'dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'].$CONFIG['galleryLogoImageFolder'],
				  				'docroot_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'].$CONFIG['galleryLogoImageFolder'],
				  				'title' => $language['admin']['logoImage']." (".str_replace('x', ' x ', $CONFIG['galleryLogoImageSize']).")",
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
		  		),

		  		'picture_image' => array(
				  				'type' => 'image',
				  				'subTable' => array(
										'table' => $_SQL_TABLE['picture_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
				  				'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
				  				//'filetype' => '.jpg,.gif',
				  				'filenameLength' => 10,
				  				'filenameSymbols' => 'DL',
				  				//'filenamePrefix' => $CONFIG['partnerImagePrefix'],
				  				'old_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'],
				  				'dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'],
				  				'docroot_dirname' => __CFG_PATH_IMAGES_URL.$CONFIG['galleryImageFolder'],
				  				'title' => $language['admin']['mainImage'],
				  				'useInAddForm' => 'y',
				  				'noResize' => 'y',
				  				'useFTP' => 'y',
				  				//'remoteServerLink' => $CONFIG['FTPImageServerURL'],
				  				'ftpServer' => __CFG_PTF_HOSTNAME,
				  				'ftpUserName' => __CFG_PTF_USERNAME,
				  				'ftpPassword' => __CFG_PTF_PASSWORD,
				  				'ftpRootPath' => __CFG_PTF_CORE_PATH,
		  		),

  );

  $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>