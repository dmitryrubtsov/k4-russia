<?php

$WorkTableKeyFieldName = 'site_callback_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
$WorkTable = &$_SQL_TABLE[$GlobPart];

$TabFields['sc'] = getFieldNamesWithLangs($WorkTable, array('name'));


$StatusSelect = array(
    '1' => $language['admin']['callbackNewMessage'],
    '1' => $language['admin']['callbackReadMessage'],
    '2' => $language['admin']['callbackPerformedMessage'],
    '3' => $language['admin']['callbackDelayedMessage'],
);

if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["siteCallback"]." :: ".$Item["'.$TabFields['sc']['name'].'"];';
}
else
{
    $PageTitle = '$language["admin"]["siteCallback"];';
    $AloneMode = $GlobPart;

    $Query['FromTables'] = 	$WorkTable." sc
							";
    $Query['Fields'] = "sc.*";
    $Query['TabOrder'] = "sc.";
    $Query['Where'] = "";
    $Query['GroupBy'] = "sc.".$WorkTableKeyFieldName;

    $listInfo['order'] 	= 'date_sent';
    $listInfo['order_type']	= 'DESC';
/*
    $EnableFilter = true;

    $listInfo['where']['branch_id'] = array(
        'simple' => 'y',
        'SQLField' => "r.branch_id = '".$_REQUEST['branch_id']."'",
        'type' => 'select',
        'title' => $language['admin']['branch'],
        'values' => array('' => $language['admin']['all']) + $BranchesSelect,
        'JSact' => '',
    );

    $listInfo['where']['status'] = array(
        'simple' => 'y',
        'SQLField' => "r.status = '".$_REQUEST['status']."'",
        'type' => 'select',
        'title' => $language['admin']['status'],
        'values' => array('' => $language['admin']['all']) + $StatusSelect,
        'JSact' => '',
    );

    require_once __CFG_PATH_CODE."admin.filter.inc";
*/
}


$_SQL_TABLE_FIELDS[$GlobPart] = array(

    'name' => array(
        'type' => 'input',
        'title' => $language['admin']['callbackName'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['name'],
        'required' => $CONFIG['AdminReqPatAll'],
        'useInList' => $CONFIG['useInListSort'],
        //'inListEdit' => 'list_input',
        'useInListEdit' => 'y',
    ),

    'phone' => array(
        'type' => 'input',
        'title' => $language['admin']['callbackPhone'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['phone'],
        //'required' => $CONFIG['AdminReqPatAll'],
        'useInList' => $CONFIG['useInListSort'],
        //'inListEdit' => 'list_input',
        'useInListEdit' => 'y',
    ),

    'email' => array(
        'type' => 'input',
        'title' => $language['admin']['callbackEmail'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['email'],
        //'required' => $CONFIG['AdminReqPatAll'],
        'useInList' => $CONFIG['useInListSort'],
        //'inListEdit' => 'list_input',
        'useInListEdit' => 'y',
    ),

    'status' => array(
        'type' => 'select_link',
        'title' => $language['admin']['status'],
        'formid' => $CONFIG['activeFormName'],
        'addVariable' => '0',
        //'noUseInEdit' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'inListEdit' => 'select_link',
        'values' => array(
            '1' => array(
                'title' => $language['admin']['callbackNewMessage'],
                'className' => 'active',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '2',
                    'varname' => 'status',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
            '2' => array(
                'title' => $language['admin']['callbackReadMessage'],
                'className' => 'gray',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '3',
                    'varname' => 'status',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
            '3' => array(
                'title' => $language['admin']['callbackPerformedMessage'],
                'className' => 'blue',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '4',
                    'varname' => 'status',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
            '4' => array(
                'title' => $language['admin']['callbackDelayedMessage'],
                'className' => 'black',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '2',
                    'varname' => 'status',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
        ),
    ),

    'date_sent' => array(
        'type' => 'value',
        'title' => $language['admin']['callbackDateSent'],
        //'addVariable' => 'NOW()',
        'notUsedInDB' => 'y',
        'addVarType' => $CONFIG['VarTypeSQLFunction'],
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
    ),


);

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

$NoUse['Edit'] = 'y';
$NoUse['AddButton'] = 'y';
$NoUse['SaveButton'] = 'y';
$NoUse['SaveItemButton'] = 'y';

?>