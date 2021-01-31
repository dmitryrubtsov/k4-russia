<?PHP




require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "general.php";
//checkDomainName();

require_once __CFG_PATH_LIBS . "xx/class.Timer.php";
$Timer = new Timer();



$Timer->start("common");
$Timer->start("loader");
$GEOIP_COUNTRY_CODE = "";

require_once __CFG_PATH_LIBS . "xx/class.Session.php";
require_once __CFG_PATH_LIBS . "xx/class.Database.php";
require_once __CFG_PATH_LIBS . "xx/class.XMLPage.php";
require_once __CFG_PATH_LIBS . "xx/class.PageContent.php";
require_once __CFG_PATH_LIBS . "xx/class.Statistic.php";
require_once __SMARTY_DIR . "Smarty.class.php";
$xmlp = new XMLPage();
$pct = new PageContent();

$dbObj = new xxDatabase(__CFG_HOSTNAME, __CFG_USERNAME, __CFG_PASSWORD, __CFG_DATABASE);

$dbObj->open();

$dbSet = new xxDataset($dbObj, __CFG_TAB_PREFIX, __CFG_TAB_PREFIX_ID);

require_once __CFG_PATH_LIBS . "xx/class.ClientValidator.php";

require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "common.php";

$_SQL_TABLE = getTableAsArray(__CFG_TAB_PREFIX . __CFG_MAIN_SQL_TABLE);

foreach ($_SQL_TABLE as $key => $val) {
    $_SQL_TABLE[$val['code']] = __CFG_TAB_PREFIX . $val['table_name'];
    unset($_SQL_TABLE[$key]);
}
$ClientVLD = new ClientValidator($dbSet);
$CONFIG = $ClientVLD->getConfigArray();
define('__CFG_LINK_PART_SEPARATOR', $CONFIG['linkPartSeparator']);
$pct->setConfigArr($CONFIG);

/** Create session object */
if (!isBlank($_GET['sessid'])) {
    $sID = new xxSession($CONFIG['sessionTime'], __CFG_SESSION_NAME, $_GET['sessid']);
} else {
    $sID = new xxSession($CONFIG['sessionTime'], __CFG_SESSION_NAME);
}

define('__USER_REAL_IP', $_SERVER['HTTP_X_REAL_IP']);
define('__USER_CURRENT_IP', $_SERVER['REMOTE_ADDR']);
if (trim(__USER_REAL_IP)) {
    define('__USER_IP', __USER_REAL_IP);
} else {
    define('__USER_IP', __USER_CURRENT_IP);
}


define("__CFG_PATH_LANGUAGES_GENERATED", __CFG_PATH_LANGUAGES);
define("__CFG_ADMIN_PANEL", false);


$ClientVLD = new ClientValidator($dbSet);
$CONFIG = $ClientVLD->getConfigArray();
$pct->setConfigArr($CONFIG);

require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "languages.php";

$pct->setLanguage(__LANG);

$HOST = $CONFIG['SiteProtocol'] . "://" . $CONFIG['SiteDomain'];
$BaseURL = $HOST . getPath();
$HOST .= "/";

$languageLink = ($CONFIG['EnableMultiLanguage'] == 'y') ? '/'.__LANG : '' ;



$redirectLink = getRowByFields($_SQL_TABLE['short_link'], array(
    "main_link = '" .str_replace($languageLink,'',$_SERVER['REQUEST_URI']). "'",
    "active = '1'",
));
if($redirectLink['short_link'])
{
    go_to(str_replace(__CFG_LINK_PART_SEPARATOR, '', $BaseURL).$redirectLink['short_link']);
}

$CheckShortLink = false;

$main_link = getRowByFields($_SQL_TABLE['short_link'], array(
    "short_link = '" .str_replace($languageLink,'',$_SERVER['REQUEST_URI']). "'",
    "active = '1'",
));
$CheckShortLink = $main_link['main_link'] ? true : false;
$main_link['main_link'] = $main_link['main_link'] ? $languageLink.$main_link['main_link'] : "";

uriPathToGETParams($main_link['main_link'] ? $main_link['main_link'] : $_SERVER['REQUEST_URI'], $CONFIG);
//$_GET['act'] = ($_GET['act'] == '/') ? 'home' : $_GET['act'];



define('__LANG_CHARSET', $language['charset']);

$tpl = new Smarty;
$pct->setTemplater($tpl);

$tpl->compile_check = ($CONFIG['SmartyCompileCheck'] == 'y') ? true : false;
$tpl->template_dir = __CFG_PATH_TEMPLATE;
$tpl->compile_dir = __CFG_PATH_COMPILE . $CONFIG['SiteTypeFolder'];
$tpl->cache_dir = __CFG_PATH_CACHING;
$tpl->plugins_dir = array(__CFG_PATH_SMPLUGINS, 'plugins');
$tpl->left_delimiter = "{";
$tpl->right_delimiter = "}";
$tpl->default_modifiers = array('escape:"html"');
$tpl->caching = $CONFIG['SmartyCaching'];
$tpl->cache_lifetime = 0;


set_time_limit(25);

$tpl->assign("session", $sID->getSessionId());
$tpl->assign("pathJS", __CFG_PATH_JAVASCRIPT);
if (isset($SCRIPT_NAME)) {
    $tpl->assign("script_name", $SCRIPT_NAME);
}
$tpl->assign("SID", $sID->getSessionID());
$tpl->assign_by_ref("Config", $CONFIG);

$tpl->assign_by_ref("SiteTitle", $CONFIG['SiteName']);
$tpl->assign_by_ref("lang", $language);
$tpl->assign_by_ref("ERRORS", $ERRORS);
$tpl->assign_by_ref("MONTHS", $MONTHS);
$tpl->assign_by_ref("MONTHSOF", $MONTHSOF);
$tpl->assign_by_ref("DAYSOFWEEK", $DAYSOFWEEK);
$tpl->assign_by_ref("DAYSABB", $DAYSABB);
$tpl->assign_by_ref("langs", $langs);
$CLIENT = array();
$_FLAGS = array();
$tpl->assign_by_ref("Client", $CLIENT);
$tpl->assign_by_ref("FLAGS", $_FLAGS);
$tpl->assign("curr_link", $curr_link);

$tpl->assign('TRUE', __TRUE);
$tpl->assign('FALSE', __FALSE);
$tpl->assign('ERROR', __ERROR);

$LangVarsArr = array('title', 'description', 'body');
foreach ($LangVarsArr as $n => $varname) {
    $tpl->assign('F' . $varname, $varname . __FLANG);
}

$SubMenu = array();
$tpl->assign_by_ref('SubMenu', $SubMenu);

$tpl->assign("LANG", __LANG);
$tpl->assign('URL_WITHOUT_LANG', $sID->fetch("URL_WITHOUT_LANG"));
$tpl->assign("SITEPATH", getPath());

$tpl->assign_by_ref('BaseURL', $BaseURL);
$tpl->assign('HOST', $HOST);

$tpl->assign("GoogleSearchKey", __CFG_GOOGLE_SEARCH_KEY);

$ServerBaseURL = $CONFIG['ServerProtocol'] . "://" . $CONFIG['ServerDomain'] . "/";
$tpl->assign_by_ref('ServerBaseURL', $ServerBaseURL);


$Timer->stop("loader");
?>