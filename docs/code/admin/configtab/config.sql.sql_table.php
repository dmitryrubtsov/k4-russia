<?php

$WorkTable = & $_SQL_TABLE[$GlobPart];
$WorkTableKeyFieldName = 'code';


if ($_REQUEST['mode'] == $GlobPart) {

    $PageTitle = '$language["admin"]["table"]." :: ".$Item["code"];';

}
else
{
    $PageTitle = '$language["admin"]["table"];';
    $AloneMode = $GlobPart;

    $emptyPageTooltip = $language['admin']['sqlTableEmptyList'];

    $Query['FromTables'] = 	$WorkTable." t ";
    $Query['Fields'] = "t.*";
    $Query['TabOrder'] = "t.";

    $EnableFilter = true;

    $listInfo['where']['code'] = array(
        'simple' => 'y',
        'SQLField' => "t.code LIKE '%".$CONFIG['AdminFilterValuePat']."%'",
        'type' => 'input',
        'title' => $language["admin"]["code"],
        'JSact' => '',
    );

    require_once __CFG_PATH_CODE."admin.filter.inc";

}

//$ConfLangArr = array();

//$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $LANGS);

$_SQL_TABLE_FIELDS[$GlobPart] = array(

    'code' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['code'],
        'useInList' => $CONFIG['useInListSort'],
        'editFormOther' => 'disabled',
        'required' => $CONFIG['AdminReqPatVariable'],
        'maxlength' => '255',
        'size' => '50',
    ),
    'table_name' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['table_name'],
        'useInList' => $CONFIG['useInListSort'],
        'editFormOther' => 'disabled',
        'required' => $CONFIG['AdminReqPatVariable'],
        'maxlength' => '255',
        'size' => '50',
    ),



);
$NoUse['ActivateButton'] = 'y';
$NoUse['DeactivateButton'] = 'y';


$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>