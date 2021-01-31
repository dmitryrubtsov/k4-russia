<?php

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
   	                        AND a.article_type_id = 1
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

?>