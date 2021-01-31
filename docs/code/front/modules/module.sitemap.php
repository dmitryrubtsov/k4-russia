<?php

    // Главное меню сайта
    $tpl->assign('siteMenuMain', $Menu->getMenu('main')->getSortedChildNodes('position'));

    // Список каталога
    $CategoriesArr = DFCms_Db_Select::factory()->from(array('pc' => $_SQL_TABLE['product_category']))
        ->join(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = pc.product_category_id')
        ->columns(
            array(
                'categoryTitle' => 'pci.title'.__FLANG,
                'categoryLinkname' => 'pci.linkname',
            )
        )
        ->join(array('ps' => $_SQL_TABLE['product_section']), 'ps.product_section_id = pc.product_section_id')
        ->where('pc.active = 1')
        ->where('ps.active = 1')
        ->order('ps.position ASC')
        ->order('pc.position ASC')
        ->group('pc.product_category_id')
        ->fetchAll();

    foreach($CategoriesArr as $n => $value)
    {
        $CategoriesArr[$n]['link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['categoryLinkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
    }

    $tpl->assign("CategoriesArr", $CategoriesArr);

    // Список услуг
    $ServicesArr = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->columns(
            array(
                'serviceTitle' => 'ai.title'.__FLANG,
                'serviceLinkname' => 'ai.linkname',
            )
        )
        ->where('a.active = 1')
        ->where('a.article_type_id = 5')
        ->order('a.position ASC')
        ->group('a.article_id')
        ->fetchAll();

    foreach($ServicesArr as $n => $value)
    {
        $ServicesArr[$n]['link'] = $BaseURL.'service'.$CONFIG['linkPartSeparator'].$value['serviceLinkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
    }

    $tpl->assign("ServicesArr", $ServicesArr);

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['siteMap'],
        'link' => '',
    ));

	$Page->Title = $language['front']['siteMap'];

	$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.sitemap.tpl";


?>