<?php

$WorkTableKeyFieldName = 'container_id';
$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
$WorkTable = &$_SQL_TABLE[$GlobPart];


$TabFields['c'] = getFieldNamesWithLangs($WorkTable, array('title'));

if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["container"]." :: ".$Item["'.$TabFields['c']['title'].'"];';
}
else
{
    $PageTitle = '$language["admin"]["container"];';
    $AloneMode = $GlobPart;

}

$ConfLangArr = array(
    'title_' => array(
        'type' => 'input',
        'title' => $language['admin']['title'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'useInList' => $CONFIG['useInListSort'],
        'required' => $CONFIG['AdminReqPatAll'],
        'size' => '60',
    ),

);

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);
$LinkName = make_linkname($_POST['linkname']);

$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(
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
    'code' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['code'],
        'useInList' => $CONFIG['useInListSort'],
        'required' => $CONFIG['AdminReqPatSymbols'],
        'editFormOther' => 'disabled',
        'maxlength' => '255',
        'size' => '255',
        'unique' => 'y',
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