<?php


  if(isBlank($SearchQuery))
  {
    $SearchQuery = $_GET[$CONFIG['MainSearchVarName']];
  }

  preg_match_all('/[\w]+/is', $SearchQuery, $matches);
  preg_match_all('/\d+[\.\,]?\d*/is', $SearchQuery, $matches1);
  $queryWords = $matches[0] + $matches1[0];

  /*if(!isEmptyArr($queryWords))
  {
	foreach($queryWords as $n => $val)
	{
	}

	$stat->catchSearchQuery($SearchQuery);

	if(isEmptyArr($AdsTabNames))
	{
	  $AdsTabNames = getAdTabNames($ThemeTableParts);
	}

	$query = "
	           SELECT DISTINCT ad.id
	           FROM ".$CLIENT['config']['theme_table_full']." t
	           INNER JOIN ".$CLIENT['config']['subtheme_table_full']." st ON st.theme = t.id
	           INNER JOIN ".$AdsTabNames['AdsItemTabName']." ad ON ad.seo_subthemes REGEXP CONCAT('^',st.id,'".$CONFIG['AdminListInRowDelim']."|".$CONFIG['AdminListInRowDelim']."',st.id,'".$CONFIG['AdminListInRowDelim']."|".$CONFIG['AdminListInRowDelim']."',st.id,'$|^',st.id,'$')
	           WHERE (LCASE(t.title) REGEXP '".join('|', $queryWords)."'
	              OR LCASE(t.keywords) REGEXP '".join('|', $queryWords)."'
	              OR LCASE(st.title) REGEXP '".join('|', $queryWords)."'
	              OR LCASE(st.keywords) REGEXP '".join('|', $queryWords)."')
	              AND ad.active = 'y'
	";

	$dbSet->open($query);
	$result = $dbSet->fetchRowsAll();
	$Ids = array();
	foreach($result as $n => $val)
	{
	}

	if(!isEmptyArr($Ids))
	{
	}
	if(isEmptyArr($AdsItemIDs) || isEmptyArr($Ids))
	{
	  $xmlp->setRedirect($CONFIG['feedLink'].$SearchQuery);
	  $xmlp->display();
	  exit;
	}
	$SearchAdsItems = getAdsByIDs($AdsItemIDs, $ThemeTableParts);
  }
  else
  {
  } */


  //$tpl->assign_by_ref('SearchAdsItems', $SearchAdsItems);

	array_push($Page->ContentPathArr, array(
		'title' => $language['search']['siteSearch'],
		'link' => '',
	));

	$Page->Title = $language['search']['siteSearch'];

	$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.search.tpl";

?>