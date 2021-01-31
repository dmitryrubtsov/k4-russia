<?php

/*
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

    // Popular carousel block
    $productPopularArray = DFCms_Db_Select::factory()->from(array('pp' => $_SQL_TABLE['product_popular']))
        ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pp.product_id')
        ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pp.product_id')
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
        ->where('pp.active = 1')
        ->where('p.active = 1')
        ->order('pp.position ASC')
        ->group('pp.product_popular_id')
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
        $productPopularArray[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
        $productPopularArray[$n]['link'] = $BaseURL.'product'.$CONFIG['AdminLinkNameDelim'].$value['product_id'].$CONFIG['webPageFileType'];
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


if(!isBlank($pct->getParam('subtask')))
{
    pageNotFound();
}
else
{
    if(isBlank($pct->getParam('task')))
    {
        // categories block
        $categoriesArray = DFCms_Db_Select::factory()->from(array('pc' => $_SQL_TABLE['product_category']))
            ->join(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = pc.product_category_id')
            ->join(array('ps' => $_SQL_TABLE['product_section']), 'ps.product_section_id = pc.product_section_id')
            ->columns(
                array(
                    'categoryTitle' => 'pci.title'.__FLANG
                )
            )
            ->where('pc.active = 1')
            ->where('ps.active = 1')
            ->order('ps.position ASC')
            ->order('pc.position ASC')
            ->group('pc.product_category_id')
            ->fetchAll();

        $tpl->assign("categoriesArray", $categoriesArray);

        $categoryIds = array();
        $categoryIdSelect = array();
        foreach($categoriesArray as $n => $val)
        {
            $categoryIds[$val['product_category_id']] = $val['product_category_id'];
        }

        $categoryIdSearchPart = "";
        if(is_array($categoryIdSelect) && sizeof($categoryIdSelect))
        {
            $categoryIdSearchPart = " AND p.product_category_id IN (".join(',', $categoryIdSelect).")";
        }

        $Page->Title = $language['site']['catalog'];

        array_push($Page->ContentPathArr, array(
            'title' => $language['site']['catalog'],
            'link' => '',
        ));

    }
    else
    {
        $linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $pct->getParam('task'))));
        if(is_int($linkID))
        {
            $categoryIdSearchPart = "AND p.product_category_id = ".$linkID;
        }

        $productCategoryInfo = DFCms_Db_Select::factory()->from(array('pc' => $_SQL_TABLE['product_category']))
            ->join(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = pc.product_category_id',
                array(
                    'title' => 'title'.__FLANG
                )
            )
            ->join(array('pcm' => $_SQL_TABLE['product_category_meta']), 'pcm.product_category_id = pc.product_category_id',
                array(
                    'meta_title' => 'meta_title'.__FLANG,
                    'meta_keywords' => 'meta_keywords'.__FLANG,
                    'meta_description' => 'meta_description'.__FLANG
                )
            )
            ->where('pc.product_category_id = '.$linkID)
            ->fetchRow();


        if($productCategoryInfo && $productCategoryInfo['title'])
        {

            $Page->Title = $productCategoryInfo['title'];
            $Page->MetaKeywords = $productCategoryInfo['meta_keywords'];
            $Page->MetaDescription = $productCategoryInfo['meta_description'];
            $Page->MetaTitle = $productCategoryInfo['meta_title'];

            array_push($Page->ContentPathArr, array(
                'title' => $language['site']['catalog'],
                'link' => $BaseURL.'catalog'.$CONFIG['webPageFileType'],
            ));

            array_push($Page->ContentPathArr, array(
                'title' => $productCategoryInfo['title'],
                'link' => '',
            ));

            $Page->Title = $productCategoryInfo['title'];
        }
        else
        {
            pageNotFound();
        }
    }

    $maxParamsOfItems = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']), array('MAX(p.price) AS max_price'))
        ->join(array('ppv' => $_SQL_TABLE['product_param_value']), 'ppv.product_id = p.product_id',
            array(
                'max_width' => 'MAX(ppv.width)',
                'max_height' => 'MAX(ppv.height)'
            )
        )
        ->where('p.active = 1')
        ->fetchRow();
    $tpl->assign("maxPriceOfItems", $maxParamsOfItems['max_price']);
    $tpl->assign("maxWidthOfItems", $maxParamsOfItems['max_width']);
    $tpl->assign("maxHeightOfItems", $maxParamsOfItems['max_height']);


    // map type block
    $mapTypeArray = DFCms_Db_Select::factory()->from(array('pst' => $_SQL_TABLE['product_section_type']))
        ->join(array('psti' => $_SQL_TABLE['product_section_type_info']), 'psti.product_section_type_id = pst.product_section_type_id')
        ->columns(
            array(
                'sectionTypeTitle' => 'psti.title'.__FLANG
            )
        )
        ->where('pst.active = 1')
        ->where('pst.product_section_id = 1')
        ->order('pst.position ASC')
        ->group('pst.product_section_type_id')
        ->fetchAll();

    $tpl->assign("mapTypeArray", $mapTypeArray);

    $mapTypeIds = array();
    $mapTypeIdSelect = array();
    foreach($mapTypeArray as $n => $val)
    {
        $mapTypeIds[$val['product_section_type_id']] = $val['product_section_type_id'];
    }


    if($_GET)
    {
        foreach($_GET as $name => $value)
        {
            if(!isBlank($value))
            {
                if(preg_match('/^cat\-\d+$/s', $name))
                {
                    preg_match('/^cat\-(\d+)$/s', $name, $matches);
                    if(in_array($matches[1], $categoryIds))
                    {
                        $categoryIdSelect[$matches[1]] = $matches[1];
                    }
                }
                if(preg_match('/^type\-\d+$/s', $name))
                {
                    preg_match('/^type\-(\d+)$/s', $name, $matches);
                    if(in_array($matches[1], $mapTypeIds))
                    {
                        $mapTypeIdSelect[$matches[1]] = $matches[1];
                    }
                }
            }
        }
    }

    $mapTypeIdSearchPart = "";
    if(is_array($mapTypeIdSelect) && sizeof($mapTypeIdSelect))
    {
        $mapTypeIdSearchPart = " AND pstr.product_section_type_id IN (".join(',', $mapTypeIdSelect).")";
    }


    if($_GET['orderby'] == 'height')
    {
        $tabOrder = "ppv.";
        $orderBy = "height";
    }
    elseif($_GET['orderby'] == 'width')
    {
        $tabOrder = "ppv.";
        $orderBy = "width";
    }
    elseif($_GET['orderby'] == 'scale')
    {
        $tabOrder = "ppv.";
        $orderBy = "scale";
    }
    elseif($_GET['orderby'] == 'price')
    {
        $tabOrder = "p.";
        $orderBy = "price";
    }
    else
    {
        $tabOrder = "p.";
        $orderBy = "position";
    }

    if($_POST && $_POST['artvalue'])
    {
        $searchArt = true;
        $searchArtQuery = "AND pi.number LIKE '%".$_POST['artvalue']."%'";
    }
    else
    {
        $searchArtQuery = "";
    }


    $pricePart = '';
    if($_GET['min_price'] || $_GET['max_price'])
    {
        $pricePart = " AND p.price >= ".(int)$_GET['min_price']." AND p.price <= ".(int)$_GET['max_price'];
    }

    $widthPart = '';
    if($_GET['min_width'] || $_GET['max_width'])
    {
        $widthPart = " AND ppv.width >= ".(int)$_GET['min_width']." AND ppv.width <= ".(int)$_GET['max_width'];
    }

    $heightPart = '';
    if($_GET['min_height'] || $_GET['max_height'])
    {
        $heightPart = " AND ppv.height >= ".(int)$_GET['min_height']." AND ppv.height <= ".(int)$_GET['max_height'];
    }

    $Query['FromTables'] = 	$_SQL_TABLE['product']." p
							INNER JOIN ".$_SQL_TABLE['product_info']." pi ON pi.product_id = p.product_id
							INNER JOIN ".$_SQL_TABLE['product_category']." pc ON pc.product_category_id = p.product_category_id
							INNER JOIN ".$_SQL_TABLE['product_category_info']." pci ON pci.product_category_id = p.product_category_id
							INNER JOIN ".$_SQL_TABLE['product_param_value']." ppv ON ppv.product_id = p.product_id
							LEFT JOIN ".$_SQL_TABLE['product_label_info']." pli ON pli.product_label_id = p.product_label_id
							LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = p.image_item_id
							LEFT JOIN ".$_SQL_TABLE['image_info']." iih ON iih.image_id = p.image_item_hover_id
							LEFT JOIN ".$_SQL_TABLE['product_section_type_relation']." pstr ON pstr.product_id = p.product_id
							";
    $Query['Fields'] = 	   "p.product_id,
                            p.price,
                            p.product_category_id,
 							pi.title".__FLANG." AS productTitle,
 							pci.title".__FLANG." AS categoryTitle,
 							pci.linkname AS categoryLinkname,
 							pli.title".__FLANG." AS labelTitle,
 							pli.class AS labelClass,
 							ii.orig_path AS itemPath,
 							iih.orig_path AS itemPathHover,
 							ppv.width,
 							ppv.height
 							";
    //$Query['TabOrder'] = 	"p.";
    $Query['TabOrder'] = 	$tabOrder;
    $Query['Where'] =       "p.active = 1
   	                        AND pc.active = 1
   	                        ".$searchArtQuery."
   	                        ".$categoryIdSearchPart."
   	                        ".$mapTypeIdSearchPart."
   	                        ".$pricePart."
   	                        ".$widthPart."
   	                        ".$heightPart."
   							";
    $Query['GroupBy'] = "p.product_id";

    $listInfo = array();
    $listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
    $listInfo['onpage'] = (isBlank($CONFIG['countProductsOnPage']) ? '' : $CONFIG['countProductsOnPage']);
    //$listInfo['order'] 	= 'position';
    $listInfo['order'] 	= $orderBy;
    $listInfo['order_type']	= 'ASC';
    $listInfo['link'] = $BaseURL.'news'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

    $Items = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);

    $pricesArr = array();
    foreach($Items as $n => $value)
    {
        $pricesArr[] = $value['price'];
        $widthArr[] = $value['width'];
        $heightArr[] = $value['height'];

        if(is_file(__CFG_CORE_PATH.$value['itemPath']))
        {
            $Items[$n]['item_image'] = $HOST.$value['itemPath'];
        }
        else
        {
            $Items[$n]['item_image'] = $HOST.$CONFIG['MainImageFolder'].'items/item_bg.jpg';
        }

        if(is_file(__CFG_CORE_PATH.$value['itemPathHover']))
        {
            $Items[$n]['item_image_hover'] = $HOST.$value['itemPathHover'];
        }
        else
        {
            $Items[$n]['item_image_hover'] = $HOST.$CONFIG['MainImageFolder'].'items/item_bg.jpg';
        }
        $Items[$n]['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$value['categoryLinkname'].$CONFIG['AdminLinkNameDelim'].$value['product_category_id'].$CONFIG['webPageFileType'];
        $Items[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['product_id'].$CONFIG['webPageFileType'];
    }

    $minPrice = min($pricesArr);
    $maxPrice = max($pricesArr);
    $minWidth = min($widthArr);
    $maxWidth = max($widthArr);
    $minHeight = min($heightArr);
    $maxHeight = max($heightArr);

    $tpl->assign("Items", $Items);

    $CONFIG['minPrice'] = $minPrice;
    $CONFIG['maxPrice'] = $maxPrice;
    $CONFIG['minWidth'] = $minWidth;
    $CONFIG['maxWidth'] = $maxWidth;
    $CONFIG['minHeight'] = $minHeight;
    $CONFIG['maxHeight'] = $maxHeight;

    if($listInfo['prev'] || $listInfo['next'])
    {
        $tpl->assign("Paging", $listInfo);
        $isPaging = 'yes';
        $tpl->assign("isPaging", $isPaging);
    }
}


	$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.catalog.tpl";

?>