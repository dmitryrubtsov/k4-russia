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
   	                        AND a.article_type_id = 5
   							";
   	$Query['GroupBy'] = "a.article_id";

   	$listInfo = array();
   	$listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
   	$listInfo['onpage'] = (isBlank($CONFIG['countServicesOnPage']) ? '' : $CONFIG['countServicesOnPage']);
    $listInfo['order'] 	= 'position';
   	$listInfo['order_type']	= 'ASC';
   	$listInfo['link'] = $BaseURL.'service'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

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
		$Items[$n]['link'] = $BaseURL.'service'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
	}

	$tpl->assign("Items", $Items);

    if($listInfo['prev'] || $listInfo['next'])
    {
        $tpl->assign("Paging", $listInfo);
        $isPaging = 'yes';
        $tpl->assign("isPaging", $isPaging);
    }

	$Page->Title = $language['front']['services'];

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['services'],
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
				AND a.article_type_id = 5
				AND ".$where."
			";
	$dbSet->open($query);
	$ServiceArticle = $dbSet->fetchArray();

	if($ServiceArticle && count($ServiceArticle))
	{
        $ServiceArticle['title'] = $ServiceArticle['title'.__FLANG];
        $ServiceArticle['text'] = $ServiceArticle['text'.__FLANG];
        $ServiceArticle['link'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

		$tpl->assign("ServiceArticle", $ServiceArticle);

		$Page->Title = $ServiceArticle['title'];
		$Page->MetaKeywords = $ServiceArticle['meta_keywords'.__FLANG];
		$Page->MetaDescription = $ServiceArticle['meta_description'.__FLANG];
		$Page->MetaTitle = $ServiceArticle['meta_title'.__FLANG];

        array_push($Page->ContentPathArr, array(
            'title' => $language['front']['services'],
            'link' => $BaseURL.'service'.$CONFIG['webPageFileType'],
        ));

        array_push($Page->ContentPathArr, array(
            'title' => $ServiceArticle['title'],
            'link' => '',
        ));
	}
	else
	{
		pageNotFound();
	}

	$blocktype = 'curr';
}


$tpl->assign("blocktype", $blocktype);

$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.service.tpl";

?>