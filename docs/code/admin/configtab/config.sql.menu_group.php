<?php
$WorkTableKeyFieldName = 'menu_group_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;

$WorkTable = &$_SQL_TABLE[$GlobPart];

$menuObj = Bike_Tree_ArrayList::factory(array(
    'keyFields' => 'menu_id',
    'parentFields' => 'parent_menu_id',
    'rootKey' => '0',

))->setList(DFCms_Db_Select::factory()->from(array($_SQL_TABLE['menu']) )->fetchAll())->buildModel();
$rootMenu = $menuObj->getMultiOptions('menu_id', 'title'.__FLANG, '&nbsp;&nbsp;');

if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["menuGroups"]." :: ".$Item["title".__FLANG];';
}
else
{
    $PageTitle = '$language["admin"]["menuGroups"];';
    $AloneMode = $GlobPart;
}

$ConfLangArr = array();
$ConfLangArr = array(
    'title_' => array(
        'type' => 'input',
        'title' => $language['admin']['title'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        'useInList' => $CONFIG['useInListSort'],
        'required' => $CONFIG['AdminReqPatAll'],
        'maxlength' => '100',
        'size' => '50',
    ),
);

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);
//
//
$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

    'code' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['code'],
        'useInList' => $CONFIG['useInListSort'],

    ),
              'menu_id' => array(
                  'type' => 'select',
                  'title' => $language["admin"]["menu"],
                  'useInAddForm' => 'y',
                  'addVariable' => $_POST['menu_id'],
                  'required' => $CONFIG['AdminReqPatAll'],
                  'values' => $rootMenu,
              ),


);

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>