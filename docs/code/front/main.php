<?

    header('Content-type: text/html; charset='.$language['charset']);

	if($_GET['task'] && $_GET['act'] == '/articles')
	{
		$linkIDArray = explode('-', $_GET['task']);
		$linkID = array_pop($linkIDArray);
	}

    /*
    if($_GET['task'] && ($_GET['act'] == '/publication' || $_GET['act'] == '/news' || $_GET['act'] == '/articles'))
    {
        $leftColumn = true;
        $tpl->assign('leftColumn', $leftColumn);
    }
    */

	$menuTree = DFCms_Db_Select::factory()
    ->from(array('m' => $_SQL_TABLE['menu']), array(
        'menu_id',
        'menu_image_id',
        'title' => 'title'.__FLANG,
        'parent_menu_id', 'menu_id',
        'link' => new Zend_Db_Expr('@link:=IF(m.outerlink="", CONCAT("articles'.$CONFIG['linkPartSeparator'].'", ai.linkname,"-", a.article_id, "'.$CONFIG['webPageFileType'].'"), IF(m.outerlink = "/", "", m.outerlink))'),
        //'description' => 'ai.description'.__FLANG,
        'image_path' =>'ii.orig_path',
        //'curr' => new Zend_Db_Expr("IF(CONCAT('/', @link) = '".$currLink."', 'Y', 'N')"),
        'curr' => 'IF(a.article_id = "'.$linkID.'", "y", "n")',
        'm.outerlink',
        'ai.article_id',
        'm.position',
    ))
    //->joinLeft(array('mi' => $_SQL_TABLE['menu_image']), 'mi.menu_id = m.menu_id', array())
    ->joinLeft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = m.menu_image_id', array())
    ->joinLeft(array('a' => $_SQL_TABLE['article']), 'a.article_id = m.article_id', array())
    ->joinLeft(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id', array())
    ->where('m.active = "1"')
    ->order(array('m.position ASC'));

	$menuGroup = DFCms_Db_Select::factory()->from(array($_SQL_TABLE['menu_group']));

	$Menu = new DFCms_Menu($menuTree, $menuGroup);

	$pct->setParam('lang', $_GET['lang']);
	$pct->setParam('task', $_GET['task']);
	$pct->setParam('subtask', $_GET['subtask']);
	$pct->setParam('param1', $_GET['param1']);
	$pct->setParam('action', str_replace('/', "", $_GET['act']));



/*
//$pct->setParam('action', 'articles');
if ($_GET[$CONFIG['partOfReferralLink']] && strlen($_GET[$CONFIG['partOfReferralLink']]) == 32) {
    $userRefererID = getFieldByEnother('user_id', $_SQL_TABLE['user'], "MD5(user_id)", $_GET[$CONFIG['partOfReferralLink']]);
    if ($userRefererID) {
        setcookie($CONFIG['cookieReferer'], $_GET[$CONFIG['partOfReferralLink']], time() + floatval($CONFIG['cookieRefererLiveTime']) * 3600);

        $userReferer = $userRefererID;
        $tpl->assign('userReferer', $userReferer);
    }
} elseif ($_GET[$CONFIG['partOfInviteLink']]) {
    $userInviteID = getFieldByEnother('user_id', $_SQL_TABLE['user_info'], 'user_invite', $_GET[$CONFIG['partOfInviteLink']]);
    if ($userInviteID) {
        setcookie($CONFIG['cookieReferer'], md5($userInviteID), time() + floatval($CONFIG['cookieRefererLiveTime']) * 3600);

        $userReferer = $userInviteID;
        $tpl->assign('userReferer', $userReferer);
    }
}
*/

$URL_NO_PARAMETERS = explode("?",getSameUriWithoutLangPath($_GET['lang']));
$redirect = getRowByFields($_SQL_TABLE['redirect'],array("old_article = '".$URL_NO_PARAMETERS[0]."'", "active = '1'"));
if($redirect['new_article'])
{
    go_to($HOST.$_GET['lang'].$redirect['new_article']);
    exit;
}

	if(isBlank($pct->getParam('action')))
	{
	    $pct->setParam('action', 'home');
	    $isHome = true;
	    $tpl->assign('isHome', $isHome);
	}


    if ($_GET['test'] == 'test') {
        $isTest = true;
        $tpl->assign('isTest', $isTest);
    }

	$action = $pct->getParam('action');
	$tpl->assign('action', $action);

	$task = $pct->getParam('task');
	$tpl->assign('task', $task);

	$param1 = $pct->getParam('param1');
	$tpl->assign('param1', $param1);



	$blocktype = 'list';
	$tpl->assign_by_ref("blocktype", $blocktype);

	if($isHome == true)
    {
        $ContentPageBlocks = array(

            'Footer' => array(
                'cache_lifetime' => 0,
            ),
            'HomeImage' => array(
                'cache_lifetime' => 0,
            ),
            'HeaderBlock' => array(
                'cache_lifetime' => 0,
            ),
            'MainMenuBlock' => array(
                'cache_lifetime' => 0,
            ),
        );
    }
    else
    {
        $ContentPageBlocks = array(

            'Footer' => array(
                'cache_lifetime' => 0,
            ),
            'HeaderBlock' => array(
                'cache_lifetime' => 0,
            ),
            'MainMenuBlock' => array(
                'cache_lifetime' => 0,
            ),
        );
    }

    $Page = new StdClass();
    $tpl->assign('Page', $Page);
    $Page->ContentPathArr = array(
        array(
            'title' => $language['front']['mainPage'],
            'link' => '/',
        )
    );


    $Page->Title = $language['front']['mainPage'];
    $Page->MetaTitle = "";
    $Page->MetaKeywords = "";
    $Page->MetaDescription = "";



	if(is_file(__CFG_PATH_CODE . $CONFIG['ModulesFolder'] . 'module.' . str_replace("-", "_", $pct->getParam('action')) . ".php"))
	{
        include_once __CFG_PATH_CODE . $CONFIG['ModulesFolder'] . 'module.' . str_replace("-", "_", $pct->getParam('action')) . ".php";
	    //print_r(__CFG_PATH_CODE . $CONFIG['ModulesFolder'] . 'module.' . str_replace("-", "_", $pct->getParam('action')) . ".php");
        $SmartyTplName = 'frontend.main.tpl';
	}
	else
	{
        include_once __CFG_PATH_CODE . $CONFIG['ModulesFolder'] . "module.error.php";
        $isError = true;
        $tpl->assign('isError', $isError);
	    //$SmartyTplName = 'frontend.error.tpl';
        $SmartyTplName = 'frontend.main.tpl';
	}




    $pct->setCachingFor(0);


    foreach ($ContentPageBlocks as $blockName => $cashParams) {
        foreach ($cashParams as $k => $value) {
            //$tpl->$k = $value;
            //$pct->setCacheParams($k, $value);
            $pct->setCachingFor($value);
        }
        include_once __CFG_PATH_CODE . $CONFIG['BlocksFolder'] . 'block.' . $blockName . '.php';
    }

    $pct->setCachingFor(0);

	/******** Blocks ***********/
	$query = "	SELECT b.title" . __FLANG . " as title, b.block_id, b.code, b.container_id, b.code as code_block, c.code as code_container, b.show_title, b.cache_lifetime
				FROM " . $_SQL_TABLE['block'] . " b
				INNER JOIN " . $_SQL_TABLE['container'] . " c ON c.container_id	 = b.container_id
				WHERE c.active = '1' AND b.active = '1'
				ORDER BY b.position
	";
	$dbSet->open($query);
	$Blocks = $dbSet->fetchRowsAll();
	$Page->BlockContainers = new StdClass();


	foreach ($Blocks as $k => $arr) {

	    $Block = $arr;
	    $tpl->assign("Block", $Block);
	    $codeContainer = $arr['code_container'];
	    if (!isset($Page->BlockContainers->$codeContainer)) {
	        $Page->BlockContainers->$codeContainer = array();
	    }

	    $blockTplPath = $CONFIG['ModulesFolder'] . $CONFIG['BlocksFolder'] . "block." . $arr['code_block'] . ".tpl";
	    $wrapperTplPath = $CONFIG['ModulesFolder'] . $CONFIG['BlocksFolder'] . "block.wrapper_" . $codeContainer . ".tpl";

	    $tpl->caching = $arr['cache_lifetime'] ? $CONFIG['SmartyCaching'] : 0;
	    $tpl->cache_lifetime = $arr['cache_lifetime'];

	    include_once __CFG_PATH_CODE . $CONFIG['BlocksFolder'] . 'block.' . $arr['code_block'] . ".php";

	    $tpl->assign("blockContent", $tpl->fetch($blockTplPath));

	    $tpl->cache_lifetime = 0;
	    $tpl->caching = 0;

	    array_push($Page->BlockContainers->$codeContainer, $tpl->fetch($wrapperTplPath));

	}

	//$pct->setBlock("header", $pct->fetch($CONFIG['ModulesFolder'] . $CONFIG['BlocksFolder'] . 'block.header.tpl'));
    //$pct->setBlock("content_path", $pct->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.content_path.tpl'));

    //$pct->setBlock("registration_block", $pct->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.registration_block.tpl'));

	$pct->setCachingFor(0);
	$pct->setMainContent($pct->fetch($_BODY_SMARTY_TEMPLATE));


	$pct->assignParams();
	$tpl->cache_lifetime = 0;
	$tpl->caching = 0;
	$output = $tpl->fetch($SmartyTplName);
	echo $output;

	$Timer->stop("common");
	//$Timer->display();


?>