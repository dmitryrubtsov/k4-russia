<?php

function setKeywordsAndRubrics(&$News)
{  global $CONFIG, $_SQL_TABLE;

  $KeywordsIDs = array();
  $RubricsIDs = array();
  $SimpArtIDs = array();
  foreach($News as $n => $arr)
  {
  	$News[$n]['key_ids'] = (!isBlank($arr['keywords'])) ? explode($CONFIG['AdminListInRowDelim'], $arr['keywords']) : array();
  	$KeywordsIDs = array_merge($KeywordsIDs, $News[$n]['key_ids']);
  	$News[$n]['rubric_ids'] = (!isBlank($arr['rubric'])) ? explode($CONFIG['AdminListInRowDelim'], $arr['rubric']) : array();
  	$RubricsIDs = array_merge($RubricsIDs, $News[$n]['rubric_ids']);
  	$News[$n]['simple_article_ids'] = (!isBlank($arr['simple_article'])) ? explode($CONFIG['AdminListInRowDelim'], $arr['simple_article']) : array();
  	$SimpArtIDs = array_merge($SimpArtIDs, $News[$n]['simple_article_ids']);
  }
  $KeywordsIDs = array_unique($KeywordsIDs);
  $RubricsIDs = array_unique($RubricsIDs);
  $SimpArtIDs = array_unique($SimpArtIDs);
  /*
  $_key = array_search($CONFIG['SiteMainPageRubricID'], $RubricsIDs);
  if($_key)
  {  	unset($RubricsIDs[$_key]);
  } */

  $Keywords = getTableAsArrayByKeyField($_SQL_TABLE['keyword'], 'id', 'id', array("id IN ('".join("','", $KeywordsIDs)."')", "active = 'y'"), '', 'title'.__FLANG.' AS title, linkname, id');
  $Rubrics = getTableAsArrayByKeyField($_SQL_TABLE['rubric'], 'id', 'id', array("id IN ('".join("','", $RubricsIDs)."')", "active = 'y'"), '', 'title'.__FLANG.' AS title, linkname, id');
  $SimpleArt = getTableAsArrayByKeyField($_SQL_TABLE['news'], 'id', 'id', array("id IN ('".join("','", $SimpArtIDs)."')", "active = 'y'"), '', 'title'.__FLANG.' AS title, p_date, linkname, id');
  $NewsTypes = getTableAsArray($_SQL_TABLE['news_type'], 'id', array("active = 'y'"), '', 'title'.__FLANG.' AS title, params, code, id');
  $Params = array();
  foreach($NewsTypes as $n => $row)
  {  	$arr = explode(',', $row['params']);
  	foreach($arr as $key)
  	{  		$Params[$row['id']][$key] = True;
  	}
  	$Params[$row['id']]['code'] = $row['code'];
  }

  foreach($News as $n => $arr)
  {
  	$News[$n]['keywords_arr'] = array();
  	foreach($News[$n]['key_ids'] as $k => $id)
  	{
  	  $News[$n]['keywords_arr'][] = $Keywords[$id];
  	}
  	$News[$n]['rubrics_arr'] = array();
  	foreach($News[$n]['rubric_ids'] as $k => $id)
  	{
  	  if($id != $CONFIG['SiteMainPageRubricID'])
  	  {
  	    $News[$n]['rubrics_arr'][] = $Rubrics[$id];
  	  }
  	}
  	$News[$n]['simple_article_arr'] = array();
  	foreach($News[$n]['simple_article_ids'] as $k => $id)
  	{
  	  $News[$n]['simple_article_arr'][] = $SimpleArt[$id];
  	}
  	$News[$n]['params'] = $Params[$arr['news_type']];

  	$ImLinkPart = $CONFIG['MainImageFolder'].$CONFIG['NewsImageFolder'].strftime("%Y/%m/%d/",strtotime($arr['p_date']));
  	$ImLinkSmall = $ImLinkPart.$CONFIG['NewsSmallImagePrefix'].$arr['id'].$CONFIG['imFileType'];
  	$ImLink = $ImLinkPart.$CONFIG['NewsNormalImagePrefix'].$arr['id'].$CONFIG['imFileType'];
  	if(is_file(__CFG_CORE_PATH.$ImLink))
  	{  	  $News[$n]['imageSmall'] = $HOST.$ImLinkSmall;
  	  $News[$n]['image'] = $HOST.$ImLink;
  	}
  	/*else
  	{  	  $News[$n]['imageSmall'] = $HOST.$CONFIG['MainImageFolder'].'blank.gif';
  	}*/
  }

}

function getNewsPages(&$listInfo, $FullBodyFlag=__FALSE, $AllNewsFlag=__TRUE)
{  global $_SQL_TABLE, $CONFIG;


  $Query['FromTables'] = 	$_SQL_TABLE['news']." n
  							LEFT JOIN ".$_SQL_TABLE['author']." at ON at.id = n.author
  							LEFT JOIN ".$_SQL_TABLE['news_param']." np ON np.news_id = n.id
  							LEFT JOIN ".$_SQL_TABLE['comment']." c ON c.news_id = n.id AND c.active = 'y'
    ";
  $Query['Fields'] = "	n.id,
  						n.title".__FLANG." AS title,
  						".(($FullBodyFlag==__FALSE) ?
  						"n.description".__FLANG." AS body" :
  						"n.body".__FLANG." AS body, n.meta_title".__FLANG." AS meta_title, n.meta_description".__FLANG." AS meta_description, n.meta_keywords".__FLANG." AS meta_keywords").",
  						n.linkname,
  						n.p_date,
  						n.rubric,
  						n.news_type,
  						n.keywords,
  						n.simple_article,
  						n.file,
  						at.name".__FLANG." AS authorName,
  						at.linkname AS authorLinkname,
  						COUNT(c.id) AS comments,
  						IF(np.rating_count, CONCAT(ROUND(np.rating_sum/np.rating_count,1),' (',np.rating_count,')'), '0 (0)') AS rating";
  $Query['TabOrder'] = "n.";
  $Query['Where'] = "at.active = 'y' AND n.active = 'y' AND n.p_date <= NOW()
  					"/*.(($AllNewsFlag==__FALSE) ?
  						" AND n.a_date >= NOW()" :
  						"")*/." ";
  $Query['GroupBy'] = "n.id";

  $News = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
  return $News;
}

function newsPagesHandler($Where=array(), $GET=array(), $FullBodyFlag=__FALSE, $AllNewsFlag=__FALSE)
{  global $CONFIG, $BaseURL;

  $OnPage = explode(',',$CONFIG['NewsOnPage']);
  $listInfo = array();
  $listInfo['page'] = (!isBlank(intval($GET['p']))) ? intval($GET['p']) : 1;
  $listInfo['onpage'] = (!isBlank(intval($GET['op'])) && in_array(intval($GET['op']), $OnPage)) ? intval($GET['op']) : reset($OnPage);
  $listInfo['link'] = $BaseURL.substr(getConstUri(),1).'?p={$Page}';
  $listInfo['sort'] = ($GET['s'] == 'rating') ? 'rating' : 'date';
  $listInfo['order'] = ($GET['s'] == 'rating') ? 'rating_sum/np.rating_count' :( $GET['s'] == 'comments')  ? 'COUNT(c.id)' : 'p_date';
  $listInfo['order_type'] = 'DESC';
  $listInfo['tabord'] = ($GET['s'] == 'rating') ? 'np.' : ( $GET['s'] == 'comments')  ? '_' : '';
  if(!isBlank($GET['f']) && !isBlank($GET['t']))
  {
    if(preg_match("/^\d{2}\.\d{2}\.\d{4}$/", $GET['f']) && preg_match("/^\d{2}\.\d{2}\.\d{4}$/", $GET['t']))
    {
      $dateF = explode('.',$GET['f']);
      $dateT = explode('.',$GET['t']);
      $listInfo['dateFrom'] = $GET['f'];
      $listInfo['dateTill'] = $GET['t'];
      $Where[] = "n.p_date >= '".$dateF[2]."-".$dateF[1]."-".$dateF[0]."' AND n.p_date <= '".$dateT[2]."-".$dateT[1]."-".$dateT[0]." 23:59:59'";
    }
  }

  foreach($Where as $n => $value)
  {
    $listInfo['where'][]['forSQL'] = $value;
  }

  $News = getNewsPages($listInfo, $FullBodyFlag, $AllNewsFlag);
  setKeywordsAndRubrics($News);

  return array('Paging' => $listInfo, 'News' => $News);
}


?>