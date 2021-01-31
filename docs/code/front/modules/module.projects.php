
<?php
if(!isBlank($pct->getParam('subtask')))
{
    pageNotFound();
}

if(isBlank($pct->getParam('task')))
{
    $query = "	SELECT a.*, ai.*, am.*
			FROM ".$_SQL_TABLE['article']." a
			INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
			INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.article_id = a.article_id
			WHERE a.active = 1
			AND a.article_id = 33
		";
    $dbSet->open($query);
    $ContactArticle = $dbSet->fetchArray();

    if($ContactArticle && count($ContactArticle))
    {
        $ContactArticle['title'] = $ContactArticle['title'.__FLANG];
        $ContactArticle['text'] = $ContactArticle['text'.__FLANG];

        $tpl->assign("ContactArticle", $ContactArticle);

        $Page->Title = $ContactArticle['title'];
        $Page->MetaKeywords = $ContactArticle['meta_keywords'.__FLANG];
        $Page->MetaDescription = $ContactArticle['meta_description'.__FLANG];
        $Page->MetaTitle = $ContactArticle['meta_title'.__FLANG];

        array_push($Page->ContentPathArr, array(
            'title' => $ContactArticle['title'],
            'link' => '',
        ));
    }




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
   	                        AND a.article_type_id = 9
   							";
    $Query['GroupBy'] = "a.article_id";

    $listInfo = array();
    $listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
    //$listInfo['onpage'] = (isBlank($CONFIG['countNewsOnPage']) ? '' : $CONFIG['countNewsOnPage']);
    $listInfo['onpage'] = $CONFIG['GroupsOnPage'];
    $listInfo['order'] 	= 'position';
    $listInfo['order_type']	= 'DESC';
    $listInfo['link'] = $BaseURL.'projects'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

    $Items = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
    foreach($Items as $n => $value)
    {


        $Query['FromTables'] = 	$_SQL_TABLE['article']." a
							INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
							LEFT JOIN ".$_SQL_TABLE['image']." i ON i.image_id = a.image_id
							LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = a.image_id";
        $Query['Fields'] = 	   "a.article_id,
   							ai.linkname,
 							ai.title".__FLANG." AS title,
 							ai.description".__FLANG." AS description,
 							ai.sub_description".__FLANG." AS sub_description,
 							a.publication_date,
 							ii.orig_path";
        $Query['TabOrder'] = 	"a.";
        $Query['Where'] =       "a.active = 1
   	                        AND a.article_type_id = 8
   	                        AND a.parent_id =".$Items[$n]['article_id']."
   							";
        if($CONFIG['projectsWithGroups'] > 0){
            $listItemsInfo = array();
            //$listItemsInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
            $listItemsInfo['onpage'] = $CONFIG['projectsWithGroups'];
            $listItemsInfo['order'] 	= 'position';
            $listItemsInfo['order_type']	= 'ASC';
            $listItemsInfo['link'] = $BaseURL.'archive'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

            $ListItems = getListFull($Query['FromTables'], $listItemsInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
            foreach($ListItems as $k => $itemValue)
            {
                $ListItems[$k]['link'] = $BaseURL.'archive'.$CONFIG['linkPartSeparator'].$itemValue['linkname'].$CONFIG['AdminLinkNameDelim'].$itemValue['article_id'].$CONFIG['webPageFileType'];
            }

        }



        if(is_file(__CFG_CORE_PATH.$value['orig_path']))
        {
            $Items[$n]['logo'] = $HOST.$value['orig_path'];
        }
        else
        {
            $Items[$n]['logo'] = $HOST.$CONFIG['MainImageFolder'].$CONFIG['templateImageFolder'].'item_bg.jpg';
        }
        $Items[$n]['link'] = $BaseURL.'projects'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];

        if($CONFIG['projectsWithGroups'] > 0){
            $Items[$n]['ListItems'] = $ListItems;
        }

    }

    $tpl->assign("Items", $Items);
    if($listInfo['prev'] || $listInfo['next'])
    {
        $tpl->assign("Paging", $listInfo);
        $isPaging = 'yes';
        $tpl->assign("isPaging", $isPaging);
    }

    $Page->Title = $language['front']['projects'];

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['projects'],
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

    $query = "	SELECT a.*, ai.*, i.orig_path,  am.*
				FROM ".$_SQL_TABLE['article']." a
				INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
				LEFT JOIN ".$_SQL_TABLE['image_info']." i ON i.image_id = a.image_id
				LEFT JOIN ".$_SQL_TABLE['article_meta']." am ON am.article_id = a.article_id
				WHERE a.active = 1
				AND a.article_type_id = 9
				AND ".$where."
			";

    $dbSet->open($query);
    $projGroup = $dbSet->fetchArray();


    $Query['FromTables'] = 	$_SQL_TABLE['article']." a
							INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
							LEFT JOIN ".$_SQL_TABLE['image']." i ON i.image_id = a.image_id
							LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = a.image_id";
    $Query['Fields'] = 	   "a.article_id,
   							ai.linkname,
 							ai.title".__FLANG." AS title,
 							ai.description".__FLANG." AS description,
 							ai.sub_description".__FLANG." AS sub_description,
 							a.publication_date,
 							ii.orig_path";
    $Query['TabOrder'] = 	"a.";
    $Query['Where'] =       "a.active = 1
   	                        AND a.article_type_id = 8
   	                        AND a.parent_id =".$projGroup['article_id']."
   							";
    $listInfo = array();
    $listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
    $listInfo['onpage'] = 50;
    $listInfo['order'] 	= 'position';
    $listInfo['order_type']	= 'ASC';
    $listInfo['link'] = $BaseURL.'projects'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

    $ListItems = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
    //$projGroup['ListItem'] = $ListItems;
    foreach($ListItems as $k => $itemValue)
    {
        $ListItems[$k]['link'] = $BaseURL.'archive'.$CONFIG['linkPartSeparator'].$itemValue['linkname'].$CONFIG['AdminLinkNameDelim'].$itemValue['article_id'].$CONFIG['webPageFileType'];
    }

    if($projGroup && count($projGroup))
    {
        $projGroup['title'] = $projGroup['title'.__FLANG];
        $projGroup['text'] = $projGroup['text'.__FLANG];
        $projGroup['link'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

        $tpl->assign("ProjGroup", $projGroup);
        $tpl->assign("ListItems", $ListItems);

        $Page->Title = $projGroup['title'];
        $Page->MetaKeywords = $projGroup['meta_keywords'.__FLANG];
        $Page->MetaDescription = $projGroup['meta_description'.__FLANG];
        $Page->MetaTitle = $projGroup['meta_title'.__FLANG];

        array_push($Page->ContentPathArr, array(
            'title' => $language['front']['projects'],
            'link' => $BaseURL.'projects'.$CONFIG['webPageFileType'],
        ));

        array_push($Page->ContentPathArr, array(
            'title' => $projGroup['title'],
            'link' => '',
        ));

        $Page->Title = $projGroup['title'];
    }
    else
    {
        pageNotFound();
    }

    $blocktype = 'curr';
}


$tpl->assign("blocktype", $blocktype);

$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.projects.tpl";

?>