<?php

function makeSearchArrayFromString($SearchQuery)
{
  preg_match_all('/\d+[\.\,]?\d*/is', $SearchQuery, $matches1);
  $queryWords = $matches[0] + $matches1[0];
  $QueryWords = array();
  foreach($queryWords as $n => $value)
  {
    $QueryWords[$val] = $val;
  }
  return $QueryWords;
}

function getSearchResultsAsArrayInArticles($SearchArr, $request)
{

  foreach($SearchArr as $n => $val)
  {
  	if(strlen($val) > 3)
  	{
  	  $SArr[] = $val;
  	}
  }

  $SearchResults = array();
  if(count($SArr) > 0)
  {
    $query = "
  		SELECT DISTINCT *
  		FROM ".$_SQL_TABLE['article']."
  		WHERE active = 'y'
  		  AND (
  		       MATCH(title, body) AGAINST ('".$request."')
  		    OR title REGEXP '".join('|', $SArr)."'
  		      )
  		ORDER BY MATCH(title, body) AGAINST ('".$request."') DESC
  		";
    $dbSet->open($query);
    $result = $dbSet->fetchRowsAll();

    $i=0;
    foreach($result as $n => $arr)
    {
  	  {
  	    $SearchResults[$i]['link'] = $CONFIG['SiteProtocol'].'://'.$CONFIG['SiteDomain'].'/'.$arr['linkname'].$CONFIG['webPageFileType'];
  	    $SearchResults[$i]['linktitle'] = $CONFIG['SiteProtocol'].'://'.$CONFIG['SiteDomain'].'/'.makeHighlightsInSearchResults($SearchArr, $arr['linkname'], $SearchResults[$i]).$CONFIG['webPageFileType'];
  	    $SearchResults[$i]['title'] = makeHighlightsInSearchResults($SearchArr, $arr['title'], $SearchResults[$i]);
  	    $i++;
  	  }
    }
  }
}

function makeHighlightsInSearchResults($SearchArr, $str, &$link)
{
  {
  	if(count($matches) > 0)
  	{
  	  foreach($matches as $i => $value)
  	  {
  	  }
  	  $m++;
  	}
  }
  if($m > $link[count])
  {
    $link[count] = $m;
  }
  return $str;
}



?>