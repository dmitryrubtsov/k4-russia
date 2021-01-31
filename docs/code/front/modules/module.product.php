<?php

    if(isBlank($pct->getParam('task')))
    {
        pageNotFound();
    }

    if(!isBlank($pct->getParam('subtask')))
    {
        pageNotFound();
    }

    if(is_array($_POST) && $_POST['itemtocart'])
    {
        print_r($_POST);
    }

    $linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $pct->getParam('task'))));
    if(is_int($linkID))
    {
        $where = "p.product_id = ".$linkID;
    }

    $productInfo = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']))
        ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = p.product_id',
            array(
                'title' => 'title'.__FLANG,
                'description' => 'description'.__FLANG,
                'number',
                'price2',
                'price3'
            )
        )
        ->join(array('pm' => $_SQL_TABLE['product_meta']), 'pm.product_id = p.product_id',
            array(
                'meta_title' => 'meta_title'.__FLANG,
                'meta_keywords' => 'meta_keywords'.__FLANG,
                'meta_description' => 'meta_description'.__FLANG
            )
        )
        ->join(array('pc' => $_SQL_TABLE['product_category']), 'pc.product_category_id = p.product_category_id',
            array(
                'product_section_id'
            )
        )
        ->join(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = p.product_category_id',
            array(
                'category_title' => 'title'.__FLANG,
                'product_category_id',
                'category_linkname' => 'linkname'
            )
        )
        ->joinleft(array('ppv' => $_SQL_TABLE['product_param_value']), 'ppv.product_id = p.product_id',
            array(
                'product_width' => 'width',
                'product_height' => 'height',
                'product_scale' => 'scale'
            )
        )
        ->joinleft(array('psti' => $_SQL_TABLE['product_section_type_info']), 'psti.product_section_type_id = p.product_section_type_id',
            array(
                'product_section_type_title' => 'title'.__FLANG,
            )
    )
    ->where('p.active = 1')
    ->where($where)
    ->fetchRow();

    if($productInfo && count($productInfo))
    {
        $productInfo['price'] = getMinPresentValue(array($productInfo['price'], $productInfo['price1'], $productInfo['price2'], $productInfo['price3']));

        // Список всех товаров в этой категории
        $ProductsOfCategory = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']))
            ->where('p.active = 1')
            ->where('p.product_category_id = '.$productInfo['product_category_id'])
            ->order('p.position ASC')
            ->fetchAll();

        foreach($ProductsOfCategory as $n => $val)
        {
            if($val['product_id'] == $productInfo['product_id'])
            {
                $productInfo['prev_product_id'] = $ProductsOfCategory[$n - 1]['product_id'];
                if($productInfo['prev_product_id'])
                {
                    $productInfo['prev_product_link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$productInfo['prev_product_id'].$CONFIG['webPageFileType'];
                }
                $productInfo['next_product_id'] = $ProductsOfCategory[$n + 1]['product_id'];
                if($productInfo['next_product_id'])
                {
                    $productInfo['next_product_link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$productInfo['next_product_id'].$CONFIG['webPageFileType'];
                }
            }
        }

        // Выборка картинок для галереи
        $ProductImagesArr = DFCms_Db_Select::factory()->from(array('pim' => $_SQL_TABLE['product_image']))
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = pim.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = pim.image_id')
            ->where('i.active = 1')
            ->where('pim.product_id = '.$productInfo['product_id'])
            ->order('i.position ASC')
            ->group('i.image_id')
            ->fetchAll();

        if($ProductImagesArr)
        {
            foreach($ProductImagesArr as $n => $value)
            {
                if(is_file(__CFG_CORE_PATH.$value['orig_path']))
                {
                    $productInfo['images'][$n]['image'] = $HOST.$value['orig_path'];
                }
                else
                {
                    unset($ProductImagesArr[$n]);
                }
            }
        }

        if(!$productInfo['images'])
        {
            $productInfo['images'][0]['image'] = $HOST.$CONFIG['MainImageFolder'].'items/item_big.jpg';
        }
        else
        {
            $productInfo['gallery'] = true;
        }

        // Recommend product carousel block
        $productRecommend = DFCms_Db_Select::factory()->from(array('pr' => $_SQL_TABLE['product_recommend']))
            ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pr.recommend_product_id')
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pr.recommend_product_id')
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
            ->where('pr.product_id = '.$productInfo['product_id'])
            ->where('p.active = 1')
            ->order('p.position ASC')
            ->group('pr.recommend_product_id')
            ->fetchAll();


        foreach($productRecommend as $n => $value)
        {
            $productRecommend[$n]['price'] = getMinPresentValue(array($value['price'], $value['price1'], $value['price2'], $value['price3']));
            if(is_file(__CFG_CORE_PATH.$value['imagePath']))
            {
                $productRecommend[$n]['image_item'] = $HOST.$value['imagePath'];
            }
            else
            {
                $productRecommend[$n]['image_item'] = $HOST.'images/items/item_bg.jpg';
            }
            if(is_file(__CFG_CORE_PATH.$value['imagePathHover']))
            {
                $productRecommend[$n]['image_item_hover'] = $HOST.$value['imagePathHover'];
            }
            else
            {
                $productRecommend[$n]['image_item_hover'] = $HOST.'images/items/item_bg.jpg';
            }
            $productRecommend[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
            $productRecommend[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['product_id'].$CONFIG['webPageFileType'];
        }

        $productInfo['recommend'] = $productRecommend;


        if($_GET['test']=='test')
        {
            getMinPresentValue(array(2500, 0, 8410, 14300));
        }


        $tpl->assign("productInfo", $productInfo);

        $Page->Title = $productInfo['title'];
        $Page->MetaKeywords = $productInfo['meta_keywords'];
        $Page->MetaDescription = $productInfo['meta_description'];
        $Page->MetaTitle = $productInfo['meta_title'];

        array_push($Page->ContentPathArr, array(
            'title' => $productInfo['category_title'],
            'link' => $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$productInfo['category_linkname'].$CONFIG['AdminLinkNameDelim'].$productInfo['product_category_id'].$CONFIG['webPageFileType'],
        ));

        array_push($Page->ContentPathArr, array(
            'title' => $productInfo['title'],
            'link' => '',
        ));
    }
    else
    {
        pageNotFound();
    }

    $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.product.tpl";

?>