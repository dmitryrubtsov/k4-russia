<?php

    /*
    // main slider
    $mainSlideArray = DFCms_Db_Select::factory()->from(array('mse' => $_SQL_TABLE['main_slider_element']))
        ->join(array('ms' => $_SQL_TABLE['main_slider']), 'ms.main_slider_id = mse.main_slider_id')
        ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = mse.image_id')
        ->joinleft(array('bgii' => $_SQL_TABLE['image_info']), 'bgii.image_id = ms.bg_image_id')
        ->columns(
            array(
                'imagePath' => 'ii.orig_path',
                'bgPath' => 'bgii.orig_path',
            )
        )
        ->where('mse.active = 1')
        ->where('ms.active = 1')
        ->order('ms.position ASC')
        ->group('mse.main_slider_element_id')
        ->fetchAll();
    $mainSlider = array();
    foreach($mainSlideArray as $n => $val)
    {
        $mainSlider[$val['main_slider_id']]['bg'] = $val['bgPath'];
        $mainSlider[$val['main_slider_id']]['elements'][$val['main_slider_element_id']] = $val;
    }
    $tpl->assign("mainSlider", $mainSlider);

    // services block
    $servicesArray = DFCms_Db_Select::factory()->from(array('s' => $_SQL_TABLE['service']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = s.article_id')
        ->joinleft(array('i' => $_SQL_TABLE['image']), 'i.image_id = s.image_id')
        ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = s.image_id')
        ->columns(
            array(
                'servicesTitle' => 's.title'.__FLANG
            )
        )
        ->where('s.active = 1')
        ->order('s.position ASC')
        ->group('s.service_id')
        ->limit(3, 0)
        ->fetchAll();

    foreach($servicesArray as $n => $value)
    {
        if(is_file(__CFG_CORE_PATH.$value['orig_path']))
        {
            $servicesArray[$n]['image'] = $HOST.$value['orig_path'];
        }
        else
        {
            $servicesArray[$n]['image'] = $HOST.'images/tpl/service_logo.jpg';
        }
        $servicesArray[$n]['link'] = $BaseURL.'service'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
    }

    $tpl->assign("servicesArray", $servicesArray);


    // news block
    $newsArray = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->columns(
            array(
                'newsTitle' => 'ai.title'.__FLANG,
                'newsDescription' => 'ai.description'.__FLANG
            )
        )
        ->where('a.article_type_id = 2')
        ->where('a.active = 1')
        ->order('a.publication_date DESC')
        ->group('a.article_id')
        ->limit($CONFIG['countNewsOnHomePage'], 0)
        ->fetchAll();

    foreach($newsArray as $n => $value)
    {
        $newsArray[$n]['link'] = $BaseURL.'news'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
    }

    $tpl->assign("newsArray", $newsArray);

    // banner (right section)
    $BannerArr = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
            array(
                'text' => 'text'.__FLANG
            )
        )
        ->where('a.article_id = 25')
        ->where('a.active = 1')
        ->fetchRow();

    $tpl->assign('Banner', $BannerArr['text']);


    // Product blocks info
    $ProductBlockArray = DFCms_Db_Select::factory()->from(array('pmb' => $_SQL_TABLE['product_mapping_block']))
        ->columns(
            array(
                'blockTitle' => 'pmb.title'.__FLANG,
                'blockId' => 'pmb.product_mapping_block_id',
            )
        )
        ->order('pmb.position ASC')
        ->group('pmb.product_mapping_block_id')
        ->fetchAll();
    $ProductBlock = array();
    foreach($ProductBlockArray as $n => $val)
    {
        $ProductBlock[$val['blockId']] = $val;
    }
    $tpl->assign('ProductBlock', $ProductBlock);

    if($ProductBlock[1]['active'] == 1)
    {
        // Popular carousel block
        $productPopularArray = DFCms_Db_Select::factory()->from(array('pmbr' => $_SQL_TABLE['product_mapping_block_relation']))
            ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pmbr.product_id')
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pmbr.product_id')
            ->joinleft(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = p.product_category_id')
            ->joinleft(array('pli' => $_SQL_TABLE['product_label_info']), 'pli.product_label_id = p.product_label_id')
            ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_item_id')
            ->joinleft(array('iih' => $_SQL_TABLE['image_info']), 'iih.image_id = p.image_item_hover_id')
            ->columns(
                array(
                    'productTitle' => 'pi.title'.__FLANG,
                    'imagePath' => 'ii.orig_path',
                    'imagePathHover' => 'iih.orig_path',
                    'categoryTitle' => 'pci.title'.__FLANG,
                    'product_category_id' => 'pci.product_category_id',
                    'labelTitle' => 'pli.title'.__FLANG,
                    'labelClass' => 'pli.class'
                )
            )
            ->where('pmbr.product_mapping_block_id = 1')
            ->where('p.active = 1')
            ->order('p.position ASC')
            ->group('p.product_id')
            ->fetchAll();

        foreach($productPopularArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['imagePath']))
            {
                $productPopularArray[$n]['image_item'] = $HOST.$value['imagePath'];
            }
            else
            {
                $productPopularArray[$n]['image_item'] = $HOST.'images/items/item_bg.jpg';
            }
            if(is_file(__CFG_CORE_PATH.$value['imagePathHover']))
            {
                $productPopularArray[$n]['image_item_hover'] = $HOST.$value['imagePathHover'];
            }
            else
            {
                $productPopularArray[$n]['image_item_hover'] = $HOST.'images/items/item_bg.jpg';
            }
            $productPopularArray[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
            $productPopularArray[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['product_id'].$CONFIG['webPageFileType'];
        }

        for($i=0; $i<(4/count($productPopularArray)); $i++)
        {
            if(count($productPopularArray) < 4)
            {
                foreach($productPopularArray as $n => $value)
                {
                    $productPopularArray[] = $value;
                }
            }
        }

        $tpl->assign("productPopularArray", $productPopularArray);
    }

    if($ProductBlock[2]['active'] == 1)
    {
        // Popular carousel block
        $productDiscountArray = DFCms_Db_Select::factory()->from(array('pmbr' => $_SQL_TABLE['product_mapping_block_relation']))
            ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pmbr.product_id')
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pmbr.product_id')
            ->joinleft(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = p.product_category_id')
            ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_logo_id')
            ->columns(
                array(
                    'productTitle' => 'pi.title'.__FLANG,
                    'imageLogo' => 'ii.orig_path',
                    'categoryTitle' => 'pci.title'.__FLANG,
                    'product_category_id' => 'pci.product_category_id',
                )
            )
            ->where('pmbr.product_mapping_block_id = 2')
            ->where('p.active = 1')
            ->order('RAND()')
            ->group('p.product_id')
            ->limit(3)
            ->fetchAll();

        foreach($productDiscountArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['imageLogo']))
            {
                $productDiscountArray[$n]['image_logo'] = $HOST.$value['imageLogo'];
            }
            else
            {
                $productDiscountArray[$n]['image_logo'] = $HOST.'images/items/item_logo.jpg';
            }

            $productDiscountArray[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
            $productDiscountArray[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['product_id'].$CONFIG['webPageFileType'];
        }

        $tpl->assign("productDiscountArray", $productDiscountArray);
    }

    if($ProductBlock[3]['active'] == 1)
    {
        // Popular carousel block
        $productBestArray = DFCms_Db_Select::factory()->from(array('pmbr' => $_SQL_TABLE['product_mapping_block_relation']))
            ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pmbr.product_id')
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pmbr.product_id')
            ->joinleft(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = p.product_category_id')
            ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_logo_id')
            ->columns(
                array(
                    'productTitle' => 'pi.title'.__FLANG,
                    'imageLogo' => 'ii.orig_path',
                    'categoryTitle' => 'pci.title'.__FLANG,
                    'product_category_id' => 'pci.product_category_id',
                )
            )
            ->where('pmbr.product_mapping_block_id = 3')
            ->where('p.active = 1')
            ->order('RAND()')
            ->group('p.product_id')
            ->limit(3)
            ->fetchAll();

        foreach($productBestArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['imageLogo']))
            {
                $productBestArray[$n]['image_logo'] = $HOST.$value['imageLogo'];
            }
            else
            {
                $productBestArray[$n]['image_logo'] = $HOST.'images/items/item_logo.jpg';
            }

            $productBestArray[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
            $productBestArray[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['product_id'].$CONFIG['webPageFileType'];
        }

        $tpl->assign("productBestArray", $productBestArray);
    }



/*
$articleQuery = $db->select();
	$articleQuery->from(array('a' => $_SQL_TABLE['article']))
	    ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
	        array(
	            'title' => 'title'.__FLANG,
	            'text' => 'text'.__FLANG,
	            'linkname'
	        )
	    )
	    ->where('a.article_id = 9');
	$article = $db->fetchRow($articleQuery);
	$tpl->assign('Article', $article);
*/
	$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.home.tpl";

?>