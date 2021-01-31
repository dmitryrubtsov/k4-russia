<?

    if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.site_main_menu.tpl'))
    {
        $tpl->assign('siteMainMenu', $Menu->getMenu('main')->getSortedChildNodes('position'));

        $productsArray = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']))
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = p.product_id',
                array(
                    'product_id',
                    'title' => 'pi.title'.__FLANG,
                    'linkname'
                )
            )
            ->where('p.active = 1')
            ->order('p.position ASC')
            ->fetchAll();

        $tpl->assign('productsArray', $productsArray);
    }

    $pct->setBlock("SiteMainMenu", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.site_main_menu.tpl'));

?>