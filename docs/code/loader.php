<?PHP
    require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "general.php";

    require_once __CFG_PATH_LIBS . "xx/class.Timer.php";
    $Timer = new Timer();

    set_include_path(get_include_path().PATH_SEPARATOR.__CFG_PATH_LIBS);

    require_once 'Zend/Loader/Autoloader.php';
    $zendLoader = Zend_Loader_Autoloader::getInstance();
    $zendLoader->registerNamespace('DFCms');
    $zendLoader->registerNamespace('Bike');


    //$db = new mysqli( __CFG_HOSTNAME, __CFG_USERNAME, __CFG_PASSWORD, __CFG_MAIN_DATABASE);

    $db = new Zend_Db_Adapter_Mysqli(array(
        'host'     => __CFG_HOSTNAME,
        'username' => __CFG_USERNAME,
        'password' => __CFG_PASSWORD,
        'dbname'   => __CFG_MAIN_DATABASE,
        'charset' => 'UTF8'
    ));


    DFCms_Db_Select::setDefaultAdapter($db);

    $Timer->start("common");
    $Timer->start("loader");

    require_once __CFG_PATH_LIBS . "xx/class.Session.php";
    require_once __CFG_PATH_LIBS . "xx/class.Database.php";
    require_once __CFG_PATH_LIBS . "xx/class.PageContent.php";

    $pct = new PageContent();

    require_once __SMARTY_DIR . "Smarty.class.php";

    $dbObj=new xxDatabase(__CFG_HOSTNAME, __CFG_USERNAME, __CFG_PASSWORD, __CFG_DATABASE);
    $dbObj->open();
    $dbSet=new xxDataset($dbObj, __CFG_TAB_PREFIX, __CFG_TAB_PREFIX_ID);

    require_once __CFG_PATH_LIBS . "xx/class.ClientValidator.php";
    require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "common.php";

    $_SQL_TABLE = $db->fetchPairs("SELECT code, CONCAT('".__CFG_TAB_PREFIX."', table_name) FROM ".__CFG_TAB_PREFIX . __CFG_MAIN_SQL_TABLE);

    $ClientVLD = new ClientValidator($dbSet, __CFG_ZONE == "admin" ? 'AdminPanel': null);
    $CONFIG = $ClientVLD->getConfigArray();

    $pct->setConfigArr($CONFIG);
?>