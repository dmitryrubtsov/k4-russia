<?php

    $WorkTableKeyFieldName = 'article_id';

    $WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
    $WorkTable = $_SQL_TABLE['article'];


    $TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));


    if ($_REQUEST['mode'] == $GlobPart)
    {
        $PageTitle = '$language["admin"]["structureInfo"]." :: ".$Item["' . $TabFields['ai']['title'] . '"];';
        //$RowItem = getRowByField($_SQL_TABLE['article_info'], $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
    }
    else
    {
        $PageTitle = '$language["admin"]["structureInfo"];';
        $AloneMode = $GlobPart;

        $emptyPageTooltip = $language['admin']['structureInfoEmptyList'];

        $Query['FromTables'] = $WorkTable . " a
                                INNER JOIN " . $_SQL_TABLE['article_info'] . " ai ON ai." . $WorkTableKeyFieldName . " = a." . $WorkTableKeyFieldName . "
                                ";
        $Query['Fields'] = "a.*, ai.*";
        $Query['TabOrder'] = "a.";
        $Query['Where'] = "a.article_type_id = 4";
        $Query['GroupBy'] = "a." . $WorkTableKeyFieldName;

        if(!$listInfo['order'])
        {
            $listInfo['order'] = "date";
            $listInfo['order_type'] = "DESC";
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
            'makeSameValueFrom' => 'title_' . $CONFIG['SiteLanguage'],
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
    $LinkName = make_linkname($_POST['linkname']);
    $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

        'article_type_id' => array(
            'type' => 'hidden',
            'addVariable' => '4',
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

    );

    $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

    ?>