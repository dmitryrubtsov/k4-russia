<?php

$Mode = $_REQUEST['mode'];
if(!$Mode)
{
    $Mode = $CONFIG['defaultAdminMode'];
}

$ADMIN = array();
$tpl->assign_by_ref('Admin', $ADMIN);

$noAuthModes = explode(',', $CONFIG['noAuthModes']);
//        echo time();
//        $_SESSION['test'] ++;
//        print_r($_SESSION);

checkAuthentication();


/****** Language Menu *********/
$query = "
	SELECT l.language_id, l.locale, l.title, l.admin_image_id, aii.orig_path, aii.orig_width, aii.orig_height
	FROM ".$_SQL_TABLE['language']." l
	LEFT JOIN ".$_SQL_TABLE['admin_image_info']." aii ON aii.admin_image_id = l.admin_image_id
	WHERE l.status_id = 1
	AND l.admin_lang = 1
	ORDER BY l.position
";

$dbSet->open($query);
$LangMenuArr = $dbSet->fetchRowsAll();
$LangMenu = array();
foreach($LangMenuArr as $lang)
{
    $LangMenu[$lang['language_id']] = $lang;
}
$tpl->assign('LangMenu', $LangMenu);

if($Mode == 'main')
{
    if(!__LAMER)
    {
        go_to('index.php?mode=config_owner_list&menu=1');
    }
    else
    {
        go_to('index.php?mode=config_owner_list&menu=1');
    }
    exit;
}

if(($ADMIN['user']['admin_user_group_id']) || __LAMER)
{

    //$TabFields['am'] = getFieldNamesWithLangs($_SQL_TABLE['menu_admin'], array('title'));

    $query = "
                        SELECT DISTINCT am.*, am.title".__FLANG." AS title, aii.orig_path
                        FROM ".$_SQL_TABLE['admin_menu']." am
                        LEFT JOIN ".$_SQL_TABLE['admin_user_group_admin_menu']." augam ON augam.admin_menu_id = am.admin_menu_id
                        LEFT JOIN ".$_SQL_TABLE['admin_image_info']." aii ON aii.admin_image_id = am.admin_image_id
                        WHERE am.active = 1
                        ".(__LAMER ? '' : "AND (augam.admin_user_group_id = ".$ADMIN['user']['admin_user_group_id']." OR am.linkvar = '')")."
                        ORDER BY am.position
            ";

    $dbSet->open($query);
    $AdminMenu = $dbSet->fetchRowsAll();

    foreach($AdminMenu as $n => $arr)
    {
        if(is_file(__CFG_CORE_PATH.$arr['orig_path']))
        {
            $AdminMenu[$n]['logo'] = '../'.$arr['orig_path'];
        }
        else
        {
            $AdminMenu[$n]['logo'] = '../images/folder.png';
        }

        $AdminMenu[$n]['link'] = 'index.php?mode='.$arr['linkvar'].$CONFIG['adminListPart'].$arr['addlinkvars'].'&menu=';
        if($_GET['menu'] == $arr['admin_menu_id'])
        {
            $AdminMenu[$n]['maincurr'] = 'curr';
            $MainMenuCurr = $AdminMenu[$n]['title'.__FLANG];
            $tpl->assign('MainMenuCurr', $MainMenuCurr);
        }
        if($Mode == $arr['linkvar'].$CONFIG['adminListPart'].$arr['addlinkvars'] || $Mode == $arr['linkvar'])
        {
            $AdminMenu[$n]['subcurr'] = 'curr';
            $SubMenuCurr = $AdminMenu[$n]['title'.__FLANG];
            $tpl->assign('SubMenuCurr', $SubMenuCurr);
        }
    }

    $AdminMenuTreeUnsorted = arrayToTree($AdminMenu, '0', $rootField='parent_admin_menu_id', $idField='admin_menu_id', $childField='children');

    $AdminMenuTree = array();
    foreach($AdminMenuTreeUnsorted as $n => $arr)
    {
        if($arr['parent_admin_menu_id'] == 0)
        {
            if($arr['children'][0]['linkvar'])
            {
            	$AdminMenuTreeUnsorted[$n]['link'] = 'index.php?mode='.$arr['children'][0]['linkvar'].$CONFIG['adminListPart'].$arr['children'][0]['addlinkvars'].'&menu=';
            }
            else
            {
            	unset($AdminMenuTreeUnsorted[$n]);
            }
        }
        $AdminMenuTree[$arr['admin_menu_id']] = $AdminMenuTreeUnsorted[$n];
    }
    $tpl->assign('AdminMenuTree', $AdminMenuTree);
    if($_GET['menu'] && is_array($AdminMenuTree[$_GET['menu']]))
    {
        $AdminSubmenuTree = $AdminMenuTree[$_GET['menu']]['children'];
        $tpl->assign('AdminSubmenuTree', $AdminSubmenuTree);
    }

}


//$tpl->assign('adminMenu', $adminMenu);
//$ADMIN = $sID->fetch('admin');

//print_r($ADMIN);
$tpl->assign('headAdmin', $ADMIN);
$tpl->assign('adminMode', $Mode);
$tpl->assign('menu', $_REQUEST['menu']);
include_once "config_sql_tab.php";

if(is_file(__CFG_PATH_CODE."admin.".$_REQUEST['mode'].".php"))
    include_once __CFG_PATH_CODE."admin.".$_REQUEST['mode'].".php";

// set blocks in admin part
$pct->setBlock("loginForm", $pct->fetch('admin.login_form.tpl'));
$pct->setBlock("topRow", $pct->fetch('admin.top_row.tpl'));
$pct->setBlock("userLogoBlock", $pct->fetch('admin.user_logo_block.tpl'));
$pct->setBlock("userAltNavi", $pct->fetch('admin.user_alt_navi.tpl'));
$pct->setBlock("mainMenuBlock", $pct->fetch('admin.main_menu_block.tpl'));
$pct->setBlock("submenuBlock", $pct->fetch('admin.submenu_block.tpl'));
$pct->setBlock("submenuTopSection", $pct->fetch('admin.submenu_top_section.tpl'));
$pct->setBlock("statsBlock", $pct->fetch('admin.stats_block.tpl'));
$pct->setBlock("breadCrumbs", $pct->fetch('admin.bread_crumbs.tpl'));

foreach($AdminMenu as $n => $arr)
{
    if(preg_match("/index\.php\?mode\=".$arr['menuLinkvar']."[^\?]*".$arr['menuAddlinkvars']."/Uis", $_SERVER['REQUEST_URI']))
    {
        $AccessFlag = __TRUE;
    }
}
if($AccessFlag != __TRUE && $_REQUEST['mode'] != 'main' && $_REQUEST['mode'] != 'ckeditor_templates_js' && $_REQUEST['mode'] != 'login' && $_REQUEST['mode'] != 'logout' && $_REQUEST['mode'] != 'get_values' && $sID->fetch('isGlobalAdmin') == false)
{
    include_once __CFG_PATH_CODE ."admin.noaccess.php";
}
elseif(is_file(__CFG_PATH_CODE."admin.".$_REQUEST['mode'].".php"))
{
    include_once __CFG_PATH_CODE."admin.".$_REQUEST['mode'].".php";
}
elseif(is_file(__CFG_PATH_CODE."admin.".str_replace($CONFIG['adminListPart'], "", $_REQUEST['mode']).".php"))
{
    go_to(str_replace($CONFIG['adminListPart'], "", getSameUri()));
    exit;
}
elseif(!is_file(__CFG_PATH_CODE ."admin.".$_REQUEST['mode'].".php") && isBlank(strstr($_REQUEST['mode'], $CONFIG['adminListPart'])) && !isEmptyArr($_SQL_TABLE_FIELDS[$GlobPart]))
{
    include_once __CFG_PATH_CODE ."admin.item.php";
}
elseif(!is_file(__CFG_PATH_CODE ."admin.".$_REQUEST['mode'].".php") && !isBlank(strstr($_REQUEST['mode'], $CONFIG['adminListPart'])) && !isEmptyArr($_SQL_TABLE_FIELDS[$GlobPart]))
{
    stripslashesResult($_POST,$recursive=1);
    include_once __CFG_PATH_CODE."admin.items.php";
}
else
{
    stripslashesResult($_POST,$recursive=1);
    include_once __CFG_PATH_CODE."admin.main.php";
}

$pct->setMainContent($pct->fetch($_BODY_SMARTY_TEMPLATE));

$pct->assignParams();

$_ADMIN_SMARTY_TEMPLATE = $adminTamplate['smartyTemplate'];

$pct->display($_ADMIN_SMARTY_TEMPLATE);
$Timer->stop("common");
//$Timer->getTimerInfo();
//$Timer->display();
?>