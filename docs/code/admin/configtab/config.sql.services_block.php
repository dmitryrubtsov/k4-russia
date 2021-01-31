<?php

    $WorkTableKeyFieldName = 'service_id';

    $WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
    $WorkTable = $_SQL_TABLE['service'];

    $TabFields['s'] = getFieldNamesWithLangs($_SQL_TABLE['service'], array('title'));
    $TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));

    $Services = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->where('a.article_type_id = 5')
        ->order('a.position ASC')
        ->fetchAll();

    $ServicesSelect = array_kv($Services, 'title'.__FLANG, 'article_id');


    if ($_REQUEST['mode'] == $GlobPart)
    {
        $PageTitle = '$language["admin"]["blockSiteService"]." :: ".$Item["' . $TabFields['s']['title'] . '"];';
    }
    else
    {
        $PageTitle = '$language["admin"]["blockSiteService"];';
        $AloneMode = $GlobPart;

        $emptyPageTooltip = $language['admin']['blockSiteServiceEmptyList'];


        $Query['FromTables'] = $WorkTable . " s
                                INNER JOIN " . $_SQL_TABLE['article'] . " a ON a.article_id = s.article_id
                                INNER JOIN " . $_SQL_TABLE['article_info'] . " ai ON ai.article_id = a.article_id
                                ";
        $Query['Fields'] = "s.*, ai.".$TabFields['ai']['title']." AS article_id";
        $Query['TabOrder'] = "s.";
        $Query['Where'] = "a.article_type_id = 5";
        $Query['GroupBy'] = "s." . $WorkTableKeyFieldName;



        if(!$listInfo['order'])
        {
            $listInfo['order'] = "position";
            $listInfo['order_type'] = "ASC";
        }
    }

    $ConfLangArr = array(
        'title_' => array(
            'type' => 'input',
            'title' => $language['admin']['titleOnSite'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST,
            'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatAll'],
            //'makeSameValue' => 'linkname',
            //'makeSameValueFrom' => 'title_' . $CONFIG['SiteLanguage'],
            //'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
            'maxlength' => '100',
            'size' => '60',
        ),
    );

    $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);
    //$LinkName = make_linkname($_POST['linkname']);
    $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

        /*
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
            'useInList' => $CONFIG['useInListSort'],
            'useInListEdit' => 'y',
            'required' => $CONFIG['AdminReqPatLinkName'],
            'textUnderField' => '<span class="red">' . $language['admin']['latinAlphAttention'] . '</span>',
            'maxlength' => '50',
            'size' => '60',
        ),

        'article_type_id' => array(
            'type' => 'hidden',
            'addVariable' => '5',
        ),
        */

        'article_id' => array(
            'type' => 'select',
            'title' => $language['admin']['linkOnSiteService'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['article_id'],
            'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatAll'],
            'values' => array('' => $language['admin']['selectLinkOnSiteService']) + $ServicesSelect,
            'orderby' => $TabFields['ai']['title'],
            'tabord' => 'ai.',
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

        /*
        'publication_date' => array(
            'type' => 'date',
            'title' => $language['admin']['publicationDate'],
            'addVariable' => $_POST['publication_date'],
            'useInList' => $CONFIG['useInListSort'],
            'useInAddForm' => 'y',
            'startYear' => '-1',
            'endYear' => '+0',
            'reverseYears' => true,
        ),
        */

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
            'title' => $language['admin']['siteServiceImage'],
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


    );

    $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

    ?>