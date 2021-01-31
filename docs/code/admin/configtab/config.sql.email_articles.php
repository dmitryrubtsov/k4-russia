<?php

$WorkTableKeyFieldName = 'article_id';

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
$WorkTable = "core_article";

$TabFields['af'] = getFieldNamesWithLangs($_SQL_TABLE['article_folder'], array('title'));
$TabFields['ai'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title','body'));
$TabFields['am'] = getFieldNamesWithLangs($_SQL_TABLE['article_meta'], array('meta_keywords','meta_description','meta_title'));

//$ArticlesFoldersSelect = array_kv(getTableAsArray($_SQL_TABLE['article_folder'], $TabFields['af']['title'], array(), '', 'id,'.$TabFields['af']['title']), $TabFields['af']['title'], 'id');
//$MenuSelect = array_kv(getTableAsArray($_SQL_TABLE['menu'], 'position', array("parent_menu_id = '0'"), '', 'article_id,'.$TabFields['m']['title']), $TabFields['m']['title'], 'article_id');

if($_REQUEST['mode'] == $GlobPart)
{
    $PageTitle = '$language["admin"]["articlePages"]." :: ".$Item["'.$TabFields['ai']['title'].'"];';
}
else
{
    $PageTitle = '$language["admin"]["articlePages"];';
    $AloneMode = $GlobPart;

    $Query['FromTables'] = 	$WorkTable." a
							INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.".$WorkTableKeyFieldName." = a.".$WorkTableKeyFieldName."
  							INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.".$WorkTableKeyFieldName." = a.".$WorkTableKeyFieldName."
  							LEFT JOIN ".$_SQL_TABLE['article_folder']." af ON af.id = a.article_folder_id";
    $Query['Fields'] = "a.*, ai.*, af.".$TabFields['af']['title']." AS article_folder_id, am.".$TabFields['am']['meta_title']."";
    $Query['TabOrder'] = "a.";
    $Query['Where'] = "a.article_folder_id = 3";
    $Query['GroupBy'] = "a.".$WorkTableKeyFieldName;

//    $EnableFilter = true;
//
//    require_once __CFG_PATH_CODE."admin.filter.inc";
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
        'makeSameValue' => 'linkname',
        'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
        'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
        'maxlength' => '255',
        'size' => '80',
        'tabord' => 'ai.',
    ),

    /*'description_' => array(
                    'type' => 'fckeditor',
                    'subTable' => array(
                          'table' => $_SQL_TABLE['article_info'],
                          'primaryKey' => $WorkTableKeyFieldName,
                  ),
                    'title' => $language['admin']['description'],
                    'useInAddForm' => 'y',
                    'addVariable' => $_POST,
                    'SmartyMods' => array('unescape'),
                    ),*/

    'body_' => array(
        'type' => 'fckeditor',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['text'],
        'useInAddForm' => 'y',
        'useInAddFormLocation' => 'full',
        'addVariable' => $_POST,
        'SmartyMods' => array('unescape'),

    ),

    'meta_keywords_' => array(
        'type' => 'textarea',
        'className' => 'validate[required]',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaKeywords'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        //'required' => $CONFIG['AdminReqPatAll'],
        'maxlength' => '255',
        'rows' => '8',
    ),

    'meta_description_' => array(
        'type' => 'textarea',
        'className' => 'validate[required]',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaDescription'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        //'required' => $CONFIG['AdminReqPatAll'],
        'maxlength' => '255',
        'rows' => '8',
    ),

    'meta_title_' => array(
        'type' => 'textarea',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_meta'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['metaTitle'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST,
        //'required' => $CONFIG['AdminReqPatAll'],
        'maxlength' => '255',
        'rows' => '8',
    ),
);

$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

$LinkName = make_linkname($_POST['linkname']);
$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

    'linkname' => array(
        'type' => 'input',
        'subTable' => array(
            'table' => $_SQL_TABLE['article_info'],
            'primaryKey' => $WorkTableKeyFieldName,
        ),
        'title' => $language['admin']['linkName'],
        'addVariable' => $LinkName,
        'useInAddForm' => 'y',
        'unique' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'useInListEdit' => 'y',
        'required' => $CONFIG['AdminReqPatLinkName'],
        'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
        'maxlength' => '100',
        'size' => '90',
        'tabord' => 'ai.',
    ),

    'article_folder_id' => array(
        'type' => 'hidden',
        'addVariable' => '3',
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