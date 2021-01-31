<?php
$WorkTableKeyFieldName = 'lang_variable_group_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;

$WorkTable = &$_SQL_TABLE[$GlobPart];
//$zoneSelect = array_kv(getTableAsArray($_SQL_TABLE['site_zone']), 'site_zone_name', 'site_zone_id');
if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["groupsLanguageVariables"]." :: ".$Item["lang_variable_group_name"];';
}
else
{
    $PageTitle = '$language["admin"]["groupsLanguageVariables"];';
    $AloneMode = $GlobPart;
//
//    $Query['FromTables'] = 	$WorkTable." lvg
//							LEFT JOIN ".$_SQL_TABLE['site_zone']." sz ON sz.site_zone_id = lvg.site_zone_id";
//    $Query['Fields'] = "lvg.*, sz.site_zone_name AS site_zone_id";
//    $Query['TabOrder'] = "lvg.";
}

$ConfLangArr = array();

$_SQL_TABLE_FIELDS[$GlobPart] = array(

    'lang_variable_group_name' => array(
        'type' => 'input',
        'title' => $language['admin']['name'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['lang_variable_group_name'],
        'useInList' => $CONFIG['useInListSort'],

    ),
//    'site_zone_id' => array(
//        'type' => 'select',
//        'title' => 'zone',
//        'useInAddForm' => 'y',
//        'addVariable' => $_POST['site_zone_id'],
//        'useInList' => $CONFIG['useInListSort'],
//        'required' => $CONFIG['AdminReqPatAll'],
//        'values' => $zoneSelect,
//    ),
);

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>