<?php

$WorkTable = &$_SQL_TABLE[$GlobPart];
$WorkTableKeyFieldName = 'redirect_article_id';


if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["redirectArticle"]." :: ".$Item["old_article"];';
}
else
{
    $PageTitle = '$language["admin"]["redirectArticle"];';
    $AloneMode = $GlobPart;
    
}

$ConfLangArr = array();

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);
$LinkName = make_linkname($_POST['linkname']);

$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(
    'old_article' => array(
        'type' => 'input',
        'title' => $language['admin']['fromRedirecting'],
        'addVariable' => $_POST['old_article'],
        'useInAddForm' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
//        'required' => $CONFIG['AdminReqPatLinkName'],
        'maxlength' => '100',
    ),
    'new_article' => array(
        'type' => 'input',
        'title' => $language['admin']['whitherRedirect'],
        'addVariable' => $_POST['new_article'],
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