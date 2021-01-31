<?php


    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    ini_set('display_errors', -1);

    include_once "config.php";

    define('__CFG_CLIENT_SCRIPT', __FALSE);

    include_once __CFG_PATH_CODE_ROOT . "loader.php";

    if (substr($_SERVER['REQUEST_URI'], 0, strlen(__CFG_ZONE_ADMIN_ACCESSOR)) == __CFG_ZONE_ADMIN_ACCESSOR)
    {
        define("__CFG_ZONE", "admin");
    }
    else
    {
        define("__CFG_ZONE", "front");
    }

    define("__CFG_PATH_CODE", __CFG_PATH_CODE_ROOT . __CFG_ZONE . "/");
    define("__CFG_PATH_TEMPLATE", __CFG_PATH_TEMPLATES_ROOT . __CFG_ZONE . "/");
//echo __CFG_PATH_CODE;


    include_once __CFG_PATH_CODE . "loader.php";



    include_once __CFG_PATH_CODE . "main.php";


?>
