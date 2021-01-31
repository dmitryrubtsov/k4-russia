<?php
$WorkTableKeyFieldName = 'template_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;

$WorkTable = &$_SQL_TABLE[$GlobPart];
if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["templates"]." :: ".$Item["title'.__FLANG.'"];';
}
else
{
    $PageTitle = '$language["admin"]["templates"];';
    $AloneMode = $GlobPart;
}

$ConfLangArr = array();
//
$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

$LinkName = make_linkname($_POST['linkname']);
// $_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr;
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
    'description_' => array(
        'type' => 'textarea',
        'title' => $language['admin']['description'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        //'required' => $CONFIG['AdminReqPatAll'],
        'maxlength' => '255',
    ),
);

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);
//
//
$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(
//
    'template' => array(
        'type' => 'textarea',
        'title' => $language['admin']['text'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['template'],

    ),
    'multi_image' => array(
        'type' => 'multi_image',
        'count' => 30,
        'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
        'StoreFilePath' => array(
            'filenameLength' => 12,
            'filenameSymbols' => 'DL',
            'filePathFolderCount' => 4,
            'filePathFolderSymbol' => 2,
        ),
        'addVariable' => $_POST['multi_image'],
        'sizesInfo' => array(
            'orig' => array(
                'handler' => null,
                'folderName' => 'orig',
                'tableFieldPath' => 'orig_path',
                'tableFieldWidth' => 'orig_width',
                'tableFieldHeight' => 'orig_height',
            ),
            /*'small' => array(
                'handler' => 'inside',
                'folderName' => 'small',
                'tableFieldPath' => 'small_path',
                'tableFieldWidth' => 'small_width',
                'tableFieldHeight' => 'small_height',
                'width' => 110,
                'height' => 65,
            ),*/
        ),
        'title' => "multi_image",
        'useInAddForm' => 'y',
        'noResize' => 'y',
        'FTP' => array(
            'ftpServer' => __CFG_PTF_HOSTNAME,
            'ftpUserName' => __CFG_PTF_USERNAME,
            'ftpPassword' => __CFG_PTF_PASSWORD,
            'ftpRootPath' => __CFG_PTF_CORE_PATH,

        ),
        'storePath' => 'upl/image_template/',
        'storeTable' => array(
            'keyField' => 'image_id',
            'tableName' => $_SQL_TABLE['image'],
            'tableInfoName' => $_SQL_TABLE['image_info'],
        ),
        'listOfRelations' => 'y',
        'relationType' => 'idsOnlyAdd',
        'relationTable' => array(
            'name' => $_SQL_TABLE['ckeditor_template_image'],
            'keyField' => $WorkTableKeyFieldName,
            'relatedField' => 'image_id',
            'keyFieldValue' => $_REQUEST[getKeyVarName()],
        ),
    ),


);
//
$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>