<?

    if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.main_menu_block.tpl'))
    {
        $tpl->assign('siteMainMenu', $Menu->getMenu('main')->getSortedChildNodes('position'));
    }

    $pct->setBlock("MainMenuBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.main_menu_block.tpl'));

?>