<?php

if(isBlank($pct->getParam('task')))
{
  $query = "
  			SELECT
  					b.id,
  					b.title".__FLANG." AS title,
  					b.title_all".__FLANG." AS title_all,
  					b.linkname,
  					COUNT(n.id) AS count
  			FROM ".$_SQL_TABLE['block']." b
  			LEFT JOIN ".$_SQL_TABLE['news']." n ON FIND_IN_SET(b.id, n.block) > 0 AND n.active = 'y' AND n.p_date <= NOW() AND n.a_date >= NOW()
  			WHERE
  				 b.active = 'y'
  			GROUP BY b.id
  			ORDER BY b.title".__FLANG."
  ";
  $dbSet->open($query);
  $Blocks = $dbSet->fetchRowsAll();

  $tpl->assign("Blocks", $Blocks);

  $tpl->assign("MetaKeywords", '');
  $tpl->assign("MetaDescription", '');
  $tpl->assign("MetaTitle", '');
  $tpl->assign("PageFlag", '1');

  $tpl->assign("PageTitle", $language['front']['blocks']);
}
else
{  $Block = getRowByFields($_SQL_TABLE['block'], array("active = 'y'", "linkname = ".$dbSet->quoteValue($pct->getParam('task'))));
  if(isBlank($Block['title'.__FLANG]))
  {
    pageNotFound();
  }

  $listInfo = array();
  $listInfo['page'] = 1;
  $listInfo['onpage'] = 1;
  $listInfo['sort'] = 'date';
  $listInfo['order'] = 'p_date';
  $listInfo['order_type'] = 'DESC';
  $listInfo['where'][]['forSQL'] = "FIND_IN_SET('".$Block['id']."', n.important_block) > 0";

  $FullBodyFlag = ($Block['news_type'] == 4) ? __TRUE : __FALSE; // if videonews -> True
  $MainNews = getNewsPages($listInfo, $FullBodyFlag);
  setKeywordsAndRubrics($MainNews);
  $MainNews = reset($MainNews);

  if($Block['code'] == 'MostPopular')
  {  	$_GET['s'] = 'rating';
  	$NewsList = newsPagesHandler(array(), $_GET, $FullBodyFlag);
  }
  elseif($Block['code'] == 'MostCommented')
  {
  	$_GET['s'] = 'comments';
  	$NewsList = newsPagesHandler(array(), $_GET, $FullBodyFlag);
  }
  else
  {
    $NewsList = newsPagesHandler(array("FIND_IN_SET('".$Block['id']."', n.block)", "n.id != '".$MainNews['id']."'"), $_GET, $FullBodyFlag);
  }

  $tpl->assign("News", $NewsList['News']);
  $tpl->assign("Paging", $NewsList['Paging']);
  $tpl->assign("Block", $Block);
  $tpl->assign("MainNews", $MainNews);
  $tpl->assign("PageTitle", $Block['title'.__FLANG]);
  $tpl->assign("PageFlag", '2');
}
  $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.blocks.tpl";

?>