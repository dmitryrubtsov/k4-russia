<?php

$WorkTableKeyFieldName = 'article_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
$WorkTable = $_SQL_TABLE['article'];


$TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));


if ($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["site"]["landingPageAdvantage"]." :: ".$Item["' . $TabFields['ai']['title'] . '"];';
    //$RowItem = getRowByField($_SQL_TABLE['article_info'], $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
}
else
{
    $PageTitle = '$language["site"]["landingPageAdvantages"];';
    $AloneMode = $GlobPart;

    $emptyPageTooltip = $language['site']['landingPageAdvantagesEmptyList'];

    $Query['FromTables'] = $WorkTable . " a
                                INNER JOIN " . $_SQL_TABLE['article_info'] . " ai ON ai." . $WorkTableKeyFieldName . " = a." . $WorkTableKeyFieldName . "
                                ";
    $Query['Fields'] = "a.*, ai.*";
    $Query['TabOrder'] = "a.";
    $Query['Where'] = "a.article_type_id = 5";
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
        'type' => 'textarea',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['textOnLandingPage'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'maxlength' => '255',
        'id' => 'meta',
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
        'addVariable' => '5',
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