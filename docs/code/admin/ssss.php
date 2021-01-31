<?PHP
//require_once __CFG_PATH_LIBS . "xx/class.Timer.php";
$adminTamplate = array(
    'title' => 'aquincum',
    'name' => 'aquincum',
    'folderName' => 'aquincum',
);
//$Timer = new Timer();

//$Timer->start("common");
//$Timer->start("loader");

require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "grab_globals.php";
//require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "general.php";
//require_once __CFG_PATH_LIBS . "xx/class.PageContent.php";
//$pct = new PageContent();

// date format
define("DATE_FORMAT","'%m/%d/%Y'"); // date format used in MySQL


//require_once __CFG_PATH_LIBS . "xx/class.Session.php";
//require_once __CFG_PATH_LIBS . "xx/class.Database.php";
//require_once __SMARTY_DIR . "Smarty.class.php";

//$dbObj=new xxDatabase(__CFG_HOSTNAME, __CFG_USERNAME, __CFG_PASSWORD, __CFG_DATABASE);
//$dbObj->open();
//$dbSet=new xxDataset($dbObj, __CFG_TAB_PREFIX, __CFG_TAB_PREFIX_ID);
$DB_TIME = $dbSet->getDBTime();

//require_once __CFG_PATH_LIBS . "xx/class.ClientValidator.php";

//require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "common.php";
//$_SQL_TABLE = getTableAsArray(__CFG_TAB_PREFIX . __CFG_MAIN_SQL_TABLE);

//foreach($_SQL_TABLE as $key=>$val){
//    $_SQL_TABLE[$val['code']] = __CFG_TAB_PREFIX.$val['table_name'];
//    unset($_SQL_TABLE[$key]);
//}

//$ClientVLD = new ClientValidator($dbSet, 'AdminPanel');
//$CONFIG = $ClientVLD->getConfigArray();
if(is_dir(__CFG_PATH_TEMPLATE.$adminTamplate['folderName']))
{
    define('__CFG_THEME', $CONFIG['adminTheme']);
}
else
{
    define('__CFG_THEME', __CFG_THEME_DEFAULT);
}

//$pct->setConfigArr($CONFIG);

$sID = new xxSession((int) $CONFIG['sessionTime'], __CFG_SESSION_NAME);

define("__CFG_PATH_LANGUAGES_GENERATED", __CFG_PATH_LANGUAGES);
define("__CFG_PANEL", true);

require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "user.inc";
require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "languages.php";
require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "confparts.inc";
require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "filter.inc";

define('__LANG_CHARSET', $language['charset']);

$self = basename($PHP_SELF);

$tpl = new Smarty;
$pct->setTemplater($tpl);
$tpl->compile_check = true;
$tpl->template_dir = __CFG_PATH_TEMPLATE.__CFG_THEME.'/';
$tpl->compile_dir = __CFG_PATH_COMPILE.__CFG_THEME.'/';
$tpl->plugins_dir = array(__CFG_PATH_SMPLUGINS, 'plugins');
$tpl->left_delimiter = "{";
$tpl->right_delimiter = "}";
$tpl->default_modifiers = array('escape:"html"');


$safemode_value = (bool) ini_get ("safe_mode");
if ($safemode_value)
{
    $tpl->use_sub_dirs = false;
}
else
{
    set_time_limit (3600);
}

if (ini_get("open_basedir"))
{
    $tpl->use_sub_dirs = false;
}

$tpl->assign("session", $sID->getSessionId());
$tpl->assign("pathJS", __CFG_PATH_JAVASCRIPT);
if (isset($SCRIPT_NAME))
{
    $tpl->assign("script_name", $SCRIPT_NAME);
}
$pct->setLanguage(__LANG);
//
$tpl->assign("SID", $sID->getSessionID());
$tpl->assign_by_ref("Config", $CONFIG);

$tpl->assign("SiteTitle", $CONFIG['SiteName']);

$tpl->assign_by_ref("lang", $language);
$tpl->assign_by_ref("LANGS", $LANGS);
$tpl->assign("DB_TIME", $DB_TIME);
$tpl->assign_by_ref("ERRORS", $ERRORS);
$tpl->assign_by_ref("MONTHS", $MONTHS);
$tpl->assign_by_ref("DAYSOFWEEK", $DAYSOFWEEK);
$tpl->assign("langs", $langs);
$tpl->assign("language", __LANG);
$tpl->assign("curr_link", $curr_link);
$tpl->assign("URL_WITHOUT_LANG", $sID->fetch("URL_WITHOUT_LANG"));
$tpl->assign("lang_alert", $lang_alert);
$tpl->assign("lang1_alert", $lang1_alert);
$tpl->assign_by_ref("FLAGS", $_FLAGS);
$_FLAGS['NoReadDB'] = __FALSE;

$ItemButtons = array();
//example
/*
$ItemButtons['makeJoinVals'] = array(
                                              'cssClass' => '',
                                              'newRow' => '',
                                              'value' => $language['admin']['submitButton'],
                                              'onclick' => 'document.forms[\'{$Config.AddFormName}\'].act.value=\'AddKeywordsForm\';document.forms[\'{$Config.activeFormName}\'].submit();',
);*/
$tpl->assign_by_ref("ItemButtons", $ItemButtons);

$ListItemsButtons = array();
$ListItemsButtons['AddButton'] = array(
    'title' => $language['admin']['addButton'],
    'img' => 'add_ico.png',
    'onclick' => 'showAddNewForm();',
);
$ListItemsButtons['SaveButton'] = array(
    'title' => $language['admin']['saveButton'],
    'img' => 'save_ico.png',
    'onclick' => 'document.forms[\'{$Config.mainFormName}\'].act.value=\'edit\';document.forms[\'{$Config.mainFormName}\'].submit();',
);
$ListItemsButtons['DeleteButton'] = array(
    'title' => $language['admin']['delete'],
    'img' => 'delete_ico.png',
    'onclick' => 'if(confirm(\'{$lang.admin.askToDelSelectedItems}\')){ldelim}document.forms[\'{$Config.mainFormName}\'].act.value=\'delete\';document.forms[\'{$Config.mainFormName}\'].submit();{rdelim}else{ldelim}return false;{rdelim}',
);
$ListItemsButtons['ActivateButton'] = array(
    'title' => $language['admin']['activate'],
    'onclick' => 'document.forms[\'{$Config.mainFormName}\'].act.value=\'activate\';document.forms[\'{$Config.mainFormName}\'].task.value=\'active\';document.forms[\'{$Config.mainFormName}\'].subtask.value=\'y\';document.forms[\'{$Config.mainFormName}\'].submit();',
);
$ListItemsButtons['DeactivateButton'] = array(
    'title' => $language['admin']['deactivate'],
    'onclick' => 'document.forms[\'{$Config.mainFormName}\'].act.value=\'activate\';document.forms[\'{$Config.mainFormName}\'].task.value=\'active\';document.forms[\'{$Config.mainFormName}\'].subtask.value=\'n\';document.forms[\'{$Config.mainFormName}\'].submit();',
);
$ListItemsButtons['CopyButton'] = array(
    'title' => $language['admin']['copyButton'],
    'onclick' => 'showMessage(\'copy\');',
);

$tpl->assign_by_ref("ListItemsButtons", $ListItemsButtons);

$ListItemIconButtons = array();
$tpl->assign_by_ref("ListItemIconButtons", $ListItemIconButtons);

$FilterButtons['filter_submit'] = array(
    'value' => $language['admin']['filterButton'],
    'onclick' => "submitFilter();",
    'other' => "",
);
$tpl->assign_by_ref("FilterButtons", $FilterButtons);

$onPageList = explode(',', $CONFIG[onPageList]);
$tpl->assign('onPageList', $onPageList);
$NoUse = array(
    'Nomer' => '',
    'Checkbox' => '',
    'Edit' => '',
    'EditBlock' => '',
    'Status' => '',
    'BackButton' => '',
    'DeleteButton' => '',
    'AddButton' => '',
    'SaveButton' => '',
    'SaveItemButton' => '',
    'ActivateButton' => 'y',
    'DeactivateButton' => 'y',
    'PresentButton' => 'y',
    'SoldOutButton' => 'y',
    'CopyButton' => 'y',
);
$tpl->assign_by_ref('NoUse', $NoUse);
$listInfo = array();
$listInfo['pmode'] 	= $_GET['pmode'];
$listInfo['page'] 	= $_GET['page'];
$listInfo['onpage'] = $_GET['onpage'];
$listInfo['order'] 	= $_GET['order'];
$listInfo['order_type'] 	= $_GET['order_type'];
$listInfo['tabord'] = $_GET['tabord'];


$listInfo['useInLink'] = array(
    'tabord' => 'tabord',
    //'pmode' => 'pmode',
    'onpage' => 'onpage',
    'page' => 'page',
    'order' => 'order',
    'order_type' => 'order_type',
);

$tpl->assign_by_ref("listInfo", $listInfo);
$tpl->assign_by_ref('AloneMode', $AloneMode);
$tpl->assign_by_ref('MegaError', $MegaError);
$tpl->assign_by_ref('MegaMessage', $MegaMessage);
$tpl->assign('TRUE', __TRUE);
$tpl->assign('FALSE', __FALSE);
$tpl->assign('ERROR', __ERROR);
$EnableFilter = false;
$tpl->assign_by_ref('EnableFilter', $EnableFilter);
$HOST = '/';
$tpl->assign('HOST', '/');

$Query = array();
$Query['FromTables'] = "";
$Query['Fields'] = "";
$Query['TabOrder'] = "";
$Query['Where'] = "";
$Query['GroupBy'] = "";

$ErrorMessages=array();
$tpl->assign_by_ref('ErrorMessages', $ErrorMessages);

$BodyTemplate = 'admin.body_listing.tpl';

$Result = getRowsByField($_SQL_TABLE['symbol_code'], 'active', 'y');
$i=count($MakeLinkNameSearchArrJVSC);
$MakeLinkNameSearchArr1 = array();
$MakeLinkNameSearchArrJVSC1 = array();
$MakeLinkNameReplaceArr1 = array();
$DialectSymbolSearch = array();
$DialectSymbolReplace = array();
$k=0;
foreach($Result as $n => $arr)
{
    if(!isBlank($arr['code']))
    {
        $MakeLinkNameSearchArr1[$i] = $arr['code'];
        $MakeLinkNameSearchArrJVSC1[$i] = str_replace($MakeLinkNameSearchArr, $MakeLinkNameSearchArrJVSC, $arr['code']);
        $MakeLinkNameReplaceArr1[$i] = $arr['linkname_code'];
        $i++;

        $DialectSymbolSearch[$k] = $arr['code'];
        $DialectSymbolReplace[$k] = $arr['symbol'];
        $k++;
    }

    if(!isBlank($arr['symbol']))
    {
        $MakeLinkNameSearchArr1[$i] = $arr['symbol'];
        $MakeLinkNameSearchArrJVSC1[$i] = $arr['symbol'];
        $MakeLinkNameReplaceArr1[$i] = $arr['linkname_code'];
        $i++;
    }

    if(!isBlank($arr['html_code']))
    {
        $MakeLinkNameSearchArr1[$i] = $arr['html_code'];
        $MakeLinkNameSearchArrJVSC1[$i] = str_replace($MakeLinkNameSearchArr, $MakeLinkNameSearchArrJVSC, $arr['html_code']);;
        $MakeLinkNameReplaceArr1[$i] = $arr['linkname_code'];
        $i++;

        $DialectSymbolSearch[$k] = $arr['html_code'];
        $DialectSymbolReplace[$k] = $arr['symbol'];
        $k++;
    }
}

$MakeLinkNameSearchArrJVSC = $MakeLinkNameSearchArrJVSC1 + $MakeLinkNameSearchArrJVSC;
$MakeLinkNameSearchArr = $MakeLinkNameSearchArr1 + $MakeLinkNameSearchArr;
$MakeLinkNameReplaceArr = $MakeLinkNameReplaceArr1 + $MakeLinkNameReplaceArr;

$tpl->assign_by_ref('MakeLinkNameSearchArr', $MakeLinkNameSearchArr);
$tpl->assign_by_ref('MakeLinkNameSearchArrJVSC', $MakeLinkNameSearchArrJVSC);
$tpl->assign_by_ref('MakeLinkNameReplaceArr', $MakeLinkNameReplaceArr);
$tpl->assign_by_ref('DialectSymbolSearch', $DialectSymbolSearch);
$tpl->assign_by_ref('DialectSymbolReplace', $DialectSymbolReplace);

$Timer->stop("loader");

?>