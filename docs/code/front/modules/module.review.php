<?php

if(!isBlank($pct->getParam('task')))
{	pageNotFound();}
else
{	if(!isBlank($_GET['branch']) && $_GET['branch'] != 'all')
    {
    	$whereGET = "AND r.branch_id = '".$_GET['branch']."'";
    	$linkGET = 'branch='.$_GET['branch'].'&';
    }
    else
    {
    	$whereGET = "";
    }

	$Query['FromTables'] = 	$_SQL_TABLE['review']." r
							INNER JOIN ".$_SQL_TABLE['review_info']." ri ON ri.review_id = r.review_id
							LEFT JOIN ".$_SQL_TABLE['branch']." b ON b.branch_id = r.branch_id";
   	$Query['Fields'] = 	   "r.review_id,
 							ri.name".__FLANG." AS name,
 							ri.text".__FLANG." AS text,
 							ri.email";
   	$Query['TabOrder'] = 	"r.";
   	$Query['Where'] =       "r.status = 2
   							".$whereGET;
   	$Query['GroupBy'] = "";

   	$listInfo = array();
   	$listInfo['page'] = (isBlank($_GET['page']) ? '1' : $_GET['page']);
   	$listInfo['onpage'] = (isBlank($CONFIG['countReviewsOnPage']) ? '' : $CONFIG['countReviewsOnPage']);
    $listInfo['order'] 	= 'position';
   	$listInfo['order_type']	= 'ASC';
   	$listInfo['link'] = $BaseURL.'review'.$CONFIG['webPageFileType'].'?'.$linkGET.'page=';

   	$Items = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
	$tpl->assign("Items", $Items);

    // Branches list in filter select
	$query = "	SELECT b.branch_id, bi.title".__FLANG." AS title
				FROM ".$_SQL_TABLE['branch']." b
				INNER JOIN ".$_SQL_TABLE['branch_info']." bi ON bi.branch_id = b.branch_id
				INNER JOIN ".$_SQL_TABLE['review']." r ON r.branch_id = b.branch_id
				WHERE b.active = 1
				AND r.status = 2
				GROUP BY b.branch_id
				ORDER BY b.position
			";
	$dbSet->open($query);
	$BranchesArray = $dbSet->fetchRowsAll();
	$tpl->assign("BranchesArray", $BranchesArray);

   	$Paging = $listInfo;
 	$tpl->assign("Paging", $listInfo);

 	// Branches list in form select
 	$query = "	SELECT b.branch_id, bi.title".__FLANG." AS title
				FROM ".$_SQL_TABLE['branch']." b
				INNER JOIN ".$_SQL_TABLE['branch_info']." bi ON bi.branch_id = b.branch_id
				WHERE b.active = 1
				ORDER BY b.position
			";
	$dbSet->open($query);
	$BranchList = $dbSet->fetchRowsAll();

	$tpl->assign("BranchList", $BranchList);

	$Page->Title = $language['front']['reviews'];}


$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.review.tpl";


?>