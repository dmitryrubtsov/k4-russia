<?php

$WorkTable = &$_SQL_TABLE[$GlobPart];
$WorkTableKeyFieldName = 'short_link_id';


if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["shortLinks"]." :: ".$Item["short_link"];';
}
else
{
    $PageTitle = '$language["admin"]["shortLinks"];';
    $AloneMode = $GlobPart;
}

$ConfLangArr = array();

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);
$LinkName = make_linkname($_POST['linkname']);

$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(
    'short_link' => array(
        'type' => 'input',
        'title' => $language['admin']['shortLink'],
        'addVariable' => $_POST['short_link'],
        'useInAddForm' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
//        'required' => $CONFIG['AdminReqPatLinkName'],
        'maxlength' => '100',
    ),
    'main_link' => array(
        'type' => 'input',
        'title' => $language['admin']['mainLink'],
        'addVariable' => $_POST['main_link'],
        'useInAddForm' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
//        'required' => $CONFIG['AdminReqPatLinkName'],
        'maxlength' => '100',
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
            1 => array(
                'title' => $language['admin']['active'],
                'className' => 'active',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '0',
                    'varname' => 'active',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
            0 => array(
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
        'type' => 'unix_time',
        'title' => $language['admin']['date'],
        'addVariable' => time(),
        'addVarType' => $CONFIG['VarTypeSQLFunction'],
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
        'inListSmartyMods' => array('date_format:"%Y-%m-%e %k:%M:%S"'),
    ),

);
$NoUse['ActivateButton'] = 'y';
$NoUse['DeactivateButton'] = 'y';

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>