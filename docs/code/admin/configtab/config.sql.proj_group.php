
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
   	                        AND a.article_type_id = 9
   							";
    $Query['GroupBy'] = "a.article_id";

    $listInfo = array();
    $listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
    //$listInfo['onpage'] = (isBlank($CONFIG['countNewsOnPage']) ? '' : $CONFIG['countNewsOnPage']);
    $listInfo['onpage'] = 2;
    $listInfo['order'] 	= 'publication_date';
    $listInfo['order_type']	= 'DESC';
    $listInfo['link'] = $BaseURL.'projects'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

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
        $Items[$n]['link'] = $BaseURL.'projects'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];



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
        $listItemsInfo = array();
        //$listItemsInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
        $listItemsInfo['onpage'] = 2;
        $listItemsInfo['order'] 	= 'article_id';
        $listItemsInfo['order_type']	= 'DESC';
        $listItemsInfo['link'] = $BaseURL.'archive'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

        $ListItems = getListFull($Query['FromTables'], $listItemsInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
        foreach($ListItems as $k => $itemValue)
        {
            $ListItems[$k]['link'] = $BaseURL.'archive'.$CONFIG['linkPartSeparator'].$itemValue['linkname'].$CONFIG['AdminLinkNameDelim'].$itemValue['article_id'].$CONFIG['webPageFileType'];
        }
        $Items[$n]['ListItems'] = $ListItems;
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
 							a.publication_date,
 							ii.orig_path";
    $Query['TabOrder'] = 	"a.";
    $Query['Where'] =       "a.active = 1
   	                        AND a.article_type_id = 8
   	                        AND a.parent_id =".$projGroup['article_id']."
   							";
    $listInfo = array();
    $listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
    $listInfo['onpage'] = 20;
    $listInfo['order'] 	= 'article_id';
    $listInfo['order_type']	= 'DESC';
    $listInfo['link'] = $BaseURL.'projects'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

    $ListItems = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
    //$projGroup['ListItem'] = $ListItems;


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