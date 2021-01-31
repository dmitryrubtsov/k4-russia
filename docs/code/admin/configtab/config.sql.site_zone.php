<?php
$WorkTableKeyFieldName = 'site_zone_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;

$WorkTable = &$_SQL_TABLE[$GlobPart];
//$zoneSelect = array_kv($zone, 'lang_variable_group_name', 'lang_variable_group_id');
if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["siteAreas"]." :: ".$Item["site_zone_name"];';
}
else
{
    $PageTitle = '$language["admin"]["siteAreas"];';
    $AloneMode = $GlobPart;
}

$ConfLangArr = array();

$_SQL_TABLE_FIELDS[$GlobPart] = array(

    'site_zone_name' => array(
        'type' => 'input',
        'title' => $language['admin']['name'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['site_zone_name'],
        'useInList' => $CONFIG['useInListSort'],

    ),
    'site_zone_code' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['site_zone_code'],
        'useInList' => $CONFIG['useInListSort'],

    ),
);

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>