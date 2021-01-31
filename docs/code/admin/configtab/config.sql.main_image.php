<?php

$WorkTableKeyFieldName = 'article_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
$WorkTable = $_SQL_TABLE['article'];


$TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title','body'));


if ($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["site"]["landingPageFeature"]." :: ".$Item["' . $TabFields['ai']['title'] . '"];';
    //$RowItem = getRowByField($_SQL_TABLE['article_info'], $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
}
else
{
    $PageTitle = '$language["site"]["landingPageFeatures"];';
    $AloneMode = $GlobPart;

    $emptyPageTooltip = $language['site']['landingPageFeaturesEmptyList'];

    $Query['FromTables'] = $WorkTable . " a
                                INNER JOIN " . $_SQL_TABLE['article_info'] . " ai ON ai." . $WorkTableKeyFieldName . " = a." . $WorkTableKeyFieldName . "
                                ";
    $Query['Fields'] = "a.*, ai.*";
    $Query['TabOrder'] = "a.";
    $Query['Where'] = "a.article_type_id = 7";
    $Query['GroupBy'] = "a." . $WorkTableKeyFieldName;

    if(!$listInfo['order'])
    {
        $listInfo['order'] = "position";
        $listInfo['order_type'] = "ASC";
    }
}

$ConfLangArr = array(

    'title_' => array(
        'type' => 'input',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['title'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'useInList' => $CONFIG['useInListSort'],
        'required' => $CONFIG['AdminReqPatAll'],
        'makeSameValue' => 'linkname',
        'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
        'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
        'maxlength' => '255',
        'size' => '60',
    ),

    'text_' => array(
        'type' => 'fckeditor',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['text'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'SmartyMods' => array('unescape'),
        'useInAddFormLocation' => 'full',
    ),

    'meta_keywords_' => array(
        'type' => 'textarea',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaKeywords'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'maxlength' => '255',
        'id' => 'meta',
    ),

    'meta_description_' => array(
        'type' => 'textarea',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaDescription'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'maxlength' => '255',
        'id' => 'meta',
    ),

    'meta_title_' => array(
        'type' => 'textarea',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaTitle'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'maxlength' => '255',
        'id' => 'meta',
    ),
);

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

/*
if(__LAMER)
	{
		$ArticleFolderArray = array(

				'article_folder_id' => array(
                                'type' => 'select',
                                'title' => $language['admin']['articlesFolder'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['article_folder_id'],
                                'useInList' => $CONFIG['useInListSort'],
                                'required' => $CONFIG['AdminReqPatAll'],
                                'values' => array('' => $language['admin']['selectArticlesFolder']) + $ArticlesFoldersSelect,
                                'orderby' => $TabFields['af']['title'].',a.'.$TabFields['a']['title'],
                                'tabord' => 'af.',
    			),
		);
	}
	else
	{
		$ArticleFolderArray = array(

				'article_folder_id' => array(
                                'type' => 'hidden',
								'addVariable' => 1,
    			),
		);
	}
*/

$LinkName = make_linkname($_POST['linkname']);
$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

    'linkname' => array(
        'type' => 'input',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['linkNameArticle'],
        'addVariable' => $LinkName,
        'useInAddForm' => 'y',
        'unique' => 'y',
        //'useInList' => $CONFIG['useInListSort'],
        //'useInListEdit' => 'y',
        'required' => $CONFIG['AdminReqPatLinkName'],
        'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
        'maxlength' => '50',
        'size' => '60',
    ),

    'article_type_id' => array(
        'type' => 'hidden',
        'addVariable' => '7',
    ),
);

$_SQL_TABLE_FIELDS[$GlobPart] = $_SQL_TABLE_FIELDS[$GlobPart] + array(

    /*
    'article_group_id' => array(
                            'type' => 'select',
                            'title' => $language['admin']['articlesGroup'],
                            'useInAddForm' => 'y',
                            'addVariable' => $_POST['article_group_id'],
                            'useInList' => $CONFIG['useInListSort'],
                            'required' => $CONFIG['AdminReqPatAll'],
                            'values' => array('' => $language['admin']['selectArticlesGroup']) + $ArticlesGroupSelect,
                            'orderby' => $TabFields['ag']['title'].',a.'.$TabFields['a']['title'],
                            'tabord' => 'ag.',
            ),
    */

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

    /*
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
                            'title' => $language['admin']['articleImage'],
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
    */

    'date' => array(
        'type' => 'value',
        'title' => $language['admin']['date'],
        'addVariable' => 'NOW()',
        'addVarType' => $CONFIG['VarTypeSQLFunction'],
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
    ),

    'pageurl' => array(
        'type' => 'input',
        'title' => $language['admin']['linkToThisArticle'],
        'defaultValue' => $CONFIG['SiteProtocol'].'://'.$CONFIG['SiteDomain'].'/articles'.$CONFIG['linkPartSeparator'].$Article['linkname'].'-'.$Article[$WorkTableKeyFieldName].$CONFIG['webPageFileType'],
        'useInListEdit' => 'y',
        'noUseInEdit' => 'y',
        'editFormOther' => 'readonly',
        'other' => 'onclick="this.select();"',
    ),
);

$NoUse['CopyButton'] = 'y';

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>