<?php

    $WorkTableKeyFieldName = 'article_id';

    $WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
    $WorkTable = $_SQL_TABLE['article'];


    $TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));


    if ($_REQUEST['mode'] == $GlobPart)
    {
        $PageTitle = '$language["site"]["landingPageSteps"]." :: ".$Item["' . $TabFields['ai']['title'] . '"];';
        //$RowItem = getRowByField($_SQL_TABLE['article_info'], $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
    }
    else
    {
        $PageTitle = '$language["site"]["landingPageSteps"];';
        $AloneMode = $GlobPart;

        $emptyPageTooltip = $language['site']['landingPageStepsEmptyList'];

        $Query['FromTables'] = $WorkTable . " a
                                INNER JOIN " . $_SQL_TABLE['article_info'] . " ai ON ai." . $WorkTableKeyFieldName . " = a." . $WorkTableKeyFieldName . "
                                ";
        $Query['Fields'] = "a.*, ai.*";
        $Query['TabOrder'] = "a.";
        $Query['Where'] = "a.article_type_id = 6";
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
            /*
            'makeSameValue' => 'linkname',
            'makeSameValueFrom' => 'title_' . $CONFIG['SiteLanguage'],
            'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
            */
            'maxlength' => '255',
            'size' => '60',
        ),

        'description_' => array(
            'type' => 'fckeditor',
            'subTable' => array(
                'table' => $_SQL_TABLE['article_info'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['site']['landingPageStepDescription'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST,
            'SmartyMods' => array('unescape'),
            //'maxlength' => '255',
            //'id' => 'meta',
        ),

        /*
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
        */
    );

    $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);
    //$LinkName = make_linkname($_POST['linkname']);
    $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

        'article_type_id' => array(
            'type' => 'hidden',
            'addVariable' => '6',
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
            'title' => $language['site']['landingPageStepImage'],
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