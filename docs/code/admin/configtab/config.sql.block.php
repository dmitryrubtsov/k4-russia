<?php

	$WorkTable = & $_SQL_TABLE[$GlobPart];
	$WorkTableKeyFieldName = 'block_id';

	$TabFields['c'] = getFieldNamesWithLangs($_SQL_TABLE['container'], array('title'));

	$TabFields['b'] = getFieldNamesWithLangs($WorkTable, array('title'));

	$ContainerSelect = array_kv(getTableAsArray($_SQL_TABLE['container'], $TabFields['c']['title'], array(), '', 'container_id,' . $TabFields['c']['title']), $TabFields['c']['title'], 'container_id');

	if ($_REQUEST['mode'] == $GlobPart)
	{
	    $PageTitle = '$language["admin"]["block"]." :: ".$Item["' . $TabFields['b']['title'] . '"];';
	}
	else
	{
	    $PageTitle = '$language["admin"]["block"];';
	    $AloneMode = $GlobPart;


	    $Query['FromTables'] = $WorkTable . " b
	  							LEFT JOIN " . $_SQL_TABLE['container'] . " c ON c.container_id = b.container_id";
	    $Query['Fields'] = "b.*, c." . $TabFields['c']['title'] . " AS container_id";
	    $Query['TabOrder'] = "b.";
	    $Query['Where'] = "";
	    $Query['GroupBy'] = "";
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
    'show_title' => array(
        'type' => 'select_link',
        'title' => $language['admin']['showTitle'],
        'formid' => $CONFIG['activeFormName'],
        'addVariable' => '1',
        'noUseInEdit' => 'y',
        'useInList' => $CONFIG['useInListSort'],
        'inListEdit' => 'select_link',
        'values' => array(
            1 => array(
                'title' => $language['admin']['yes'],
                'className' => 'active',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '0',
                    'varname' => 'show_title',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
            0 => array(
                'title' => $language['admin']['no'],
                'className' => 'inactive',
                'formFields' => array(
                    'act' => 'status',
                    'varvalue' => '1',
                    'varname' => 'show_title',
                    getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
                ),
            ),
        ),
    ),
    'cache_lifetime' => array(
        'type' => 'input',
        'title' => $language['admin']['cacheLifeTime'],
        'size' => '8',
        'useInAddForm' => 'y',
        'addVariable' => $_POST['cache_lifetime'],
        //'useInList' => $CONFIG['useInListSort'],
        'allowEmpty' => 'y',
        //'inListEdit' => 'list_input',
       	//'useInListEdit' => 'y',
    ),
    'container_id' => array(
        'type' => 'select',
        'title' => $language['admin']['container'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['container_id'],
        'required' => $CONFIG['AdminReqPatAll'],
        'useInList' => $CONFIG['useInListSort'],
        'values' => $ContainerSelect,
        'orderby' => $TabFields['c']['title'] . ',b.' . $TabFields['b']['title'],
        'tabord' => 'c.',
    ),
    'position' => array(
        'type' => 'input',
        'title' => $language['admin']['position'],
        'size' => '3',
        'useInAddForm' => 'y',
        'addVariable' => $_POST['position'],
        'useInList' => $CONFIG['useInListSort'],
        'allowEmpty' => 'y',
        'inListEdit' => 'list_input',
        'useInListEdit' => 'y',
    ),
    'code' => array(
        'type' => 'input',
        'title' => $language['admin']['code'],
        'useInAddForm' => 'y',
        'addVariable' => $_POST['code'],
        'useInList' => $CONFIG['useInListSort'],
        'required' => $CONFIG['AdminReqPatSymbols'],
        'editFormOther' => 'disabled',
        'maxlength' => '100',
        'size' => '15',
//        'unique' => 'y',
    ),

    'date' => array(
        'type' => 'unix_time',
        'title' => $language['admin']['date'],
        'addVariable' => time(),
        'addVarType' => $CONFIG['VarTypeSQLFunction'],
        //'useInList' => $CONFIG['useInListSort'],
        //'useInListEdit' => 'y',
        //'inListSmartyMods' => array('date_format:"%Y-%m-%e %k:%M:%S"'),
    ),

);
$NoUse['ActivateButton'] = 'y';
$NoUse['DeactivateButton'] = 'y';


function addActionsAddItem()
{
    global $NewRow, $CONFIG;
    if (@fopen(__CFG_PATH_CODE_FRONT . $CONFIG['BlocksFolder'] . 'block.' . $NewRow['code'] . '.php', "r"))
    {
        echo 'file  block.' . $NewRow['code'] . '.php exists!!!!';
        exit;
    }
    else
    {
        $temp = tmpfile();
        fwrite($temp, '<?php if(!$tpl->is_cached($blockTplPath)) { } ?>');
        require_once __CFG_PATH_LIBS . __CFG_PATH_CORE_CLASSES . "class.FTPAgent.php";
        $ftpa = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);

        $ftpa->uploadOpenedFile(str_replace(__CFG_CORE_PATH, "/", __CFG_PATH_CODE_FRONT . $CONFIG['BlocksFolder'] . 'block.' . $NewRow['code'] . '.php'), $temp);

        if (@fopen(__CFG_PATH_TEMPLATE_FRONT . $CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'] . 'block.' . $NewRow['code'] . '.tpl', "r"))
        {
            echo 'file  block.' . $NewRow['code'] . '.tpl exists!!!!';
            exit;

        }
        else
        {
            $temp = tmpfile();
            fwrite($temp, "<div class="."Item-block"."></div>");

            require_once __CFG_PATH_LIBS . __CFG_PATH_CORE_CLASSES . "class.FTPAgent.php";
            $ftpa = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);

            $ftpa->uploadOpenedFile(str_replace(__CFG_CORE_PATH, "/", __CFG_PATH_TEMPLATE_FRONT .$CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.' . $NewRow['code'] . '.tpl'), $temp);

            fclose($temp);
        }
    }
}
function AddFuncDeleteItem()
{
    global $_SQL_TABLE, $CONFIG;
    $block = getRowByField($_SQL_TABLE['block'], "block_id", current($_POST['item']) );

    require_once __CFG_PATH_LIBS . __CFG_PATH_CORE_CLASSES . "class.FTPAgent.php";
    $ftpa = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);

    $ftpa->deleteFile(str_replace(__CFG_CORE_PATH, "/", __CFG_PATH_CODE_FRONT . $CONFIG['BlocksFolder'] . 'block.' . $block['code'] . '.php'));
    $ftpa->deleteFile(str_replace(__CFG_CORE_PATH, "/", __CFG_PATH_TEMPLATE_FRONT .$CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.' . $block['code'] . '.tpl'));
}

$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

?>