<?php
/*
if(!isBlank($pct->getParam('subtask')))
{
	pageNotFound();
}

if(isBlank($pct->getParam('task')))
{
   	$Query['FromTables'] = 	$_SQL_TABLE['article']." a
							INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
							LEFT JOIN ".$_SQL_TABLE['image']." i ON i.image_id = a.image_id
							LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = a.image_id";
   	$Query['Fields'] = 	   "a.article_id,
   							ai.linkname,
 							ai.title".__FLANG." AS title,
 							ai.description".__FLANG." AS description,
 							a.publication_date,
 							ii.orig_path";
   	$Query['TabOrder'] = 	"a.";
   	$Query['Where'] =       "a.active = 1
   	                        AND a.article_type_id = 2
   							";
   	$Query['GroupBy'] = "a.article_id";

   	$listInfo = array();
   	$listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
   	$listInfo['onpage'] = (isBlank($CONFIG['countNewsOnPage']) ? '' : $CONFIG['countNewsOnPage']);
    $listInfo['order'] 	= 'publication_date';
   	$listInfo['order_type']	= 'DESC';
   	$listInfo['link'] = $BaseURL.'news'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

   	$Items = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);

    foreach($Items as $n => $value)
	{
		if(is_file(__CFG_CORE_PATH.$value['orig_path']))
		{
			$Items[$n]['logo'] = $HOST.$value['orig_path'];
		}
		else
		{
			$Items[$n]['logo'] = $HOST.$CONFIG['MainImageFolder'].$CONFIG['templateImageFolder'].'item_bg.jpg';
		}
		$Items[$n]['link'] = $BaseURL.'news'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
	}

	$tpl->assign("Items", $Items);

    if($listInfo['prev'] || $listInfo['next'])
    {
        $tpl->assign("Paging", $listInfo);
        $isPaging = 'yes';
        $tpl->assign("isPaging", $isPaging);
    }

	$Page->Title = $language['front']['news'];

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['news'],
        'link' => '',
    ));

	$blocktype = 'list';

}
else
{
	$linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $pct->getParam('task'))));
	if(is_int($linkID))
	{
		$where = "a.article_id = ".$linkID;
	}
	else
	{
		$where = "ai.linkname = '".$pct->getParam('task');
	}

	$query = "	SELECT a.*, ai.*, am.*
				FROM ".$_SQL_TABLE['article']." a
				INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
				INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.article_id = a.article_id
				WHERE a.active = 1
				AND a.article_type_id = 2
				AND ".$where."
			";
	$dbSet->open($query);
	$NewsArticle = $dbSet->fetchArray();

	if($NewsArticle && count($NewsArticle))
	{
		$NewsArticle['title'] = $NewsArticle['title'.__FLANG];
		$NewsArticle['text'] = $NewsArticle['text'.__FLANG];
		$NewsArticle['link'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$tpl->assign("NewsArticle", $NewsArticle);

		$Page->Title = $NewsArticle['title'];
		$Page->MetaKeywords = $NewsArticle['meta_keywords'.__FLANG];
		$Page->MetaDescription = $NewsArticle['meta_description'.__FLANG];
		$Page->MetaTitle = $NewsArticle['meta_title'.__FLANG];

        array_push($Page->ContentPathArr, array(
            'title' => $language['front']['news'],
            'link' => $BaseURL.'news'.$CONFIG['webPageFileType'],
        ));

        array_push($Page->ContentPathArr, array(
            'title' => $NewsArticle['title'],
            'link' => '',
        ));

        $Page->Title = $NewsArticle['title'];
	}
	else
	{
		pageNotFound();
	}

	$blocktype = 'curr';
}


$tpl->assign("blocktype", $blocktype);

$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.news.tpl";

*/

if($_POST && $_POST['act'] == 'itemtocart')
{
    //$showMore = TRUE;
    //$tpl->assign("showMore", $showMore);

    $Item = $_POST;
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
        ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_logo_id',
            array(
                'item_image' => 'orig_path'
            )
        )
        ->where('p.active = 1')
        ->where('p.product_id = '.$Item['id'])
        ->fetchRow();
    $productInfo['pricetype'] = 'price';
    $productInfo['price'] = $productInfo['price'];
    $productInfo['quantity'] = 1;
    $productInfo['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$productInfo['category_linkname'].$CONFIG['AdminLinkNameDelim'].$productInfo['product_category_id'].$CONFIG['webPageFileType'];
    $productInfo['product_link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$productInfo['product_id'].$CONFIG['webPageFileType'];

    if(is_file(__CFG_CORE_PATH.$productInfo['item_image']))
    {
        $productInfo['logo'] = $HOST.$productInfo['item_image'];
    }
    else
    {
        $productInfo['logo'] = $HOST.$CONFIG['MainImageFolder'].'items/item_logo.jpg';
    }

    $CartClass->addItemToCart($CART, $productInfo, $Item['time']);

    $sID->assign("cart", $CART);
    $tpl->assign('Cart', $CART);

    $output = $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder']."block.shopping_cart_block.tpl");
    echo $output;
    exit;
}
if($_POST && $_POST['act'] == 'itemfromcart')
{

    $Item = $_POST;
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
        ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_logo_id',
            array(
                'item_image' => 'orig_path'
            )
        )
        ->where('p.active = 1')
        ->where('p.product_id = '.$Item['id'])
        ->fetchRow();
    $productInfo['pricetype'] = 'pricetype';
    $productInfo['price'] = $productInfo['price'];
    $productInfo['quantity'] = 1;
    $productInfo['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$productInfo['category_linkname'].$CONFIG['AdminLinkNameDelim'].$productInfo['product_category_id'].$CONFIG['webPageFileType'];
    $productInfo['product_link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$productInfo['product_id'].$CONFIG['webPageFileType'];

    if(is_file(__CFG_CORE_PATH.$productInfo['item_image']))
    {
        $productInfo['logo'] = $HOST.$productInfo['item_image'];
    }
    else
    {
        $productInfo['logo'] = $HOST.$CONFIG['MainImageFolder'].'items/item_logo.jpg';
    }

    $CartClass->removeItemFromCart($CART, "price-".$Item['id']);

    $sID->assign("cart", $CART);
    $tpl->assign('Cart', $CART);

    $output = $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder']."block.shopping_cart_block.tpl");
    echo $output;
    exit;
}
else
{
    pageNotFound();
}

?>