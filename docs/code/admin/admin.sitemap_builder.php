<?php

//$Timer->start("messages");
  $SiteMap = array();

  $query = "	SELECT
  					m.outerlink,
  					a.linkname
  			 	FROM ".$_SQL_TABLE['menu']." m
  			 	LEFT JOIN ".$_SQL_TABLE['article']." a ON a.id = m.article AND a.active = 'y'
  			 	WHERE
  			 		m.active = 'y'
  			 	ORDER BY m.position";
  $dbSet->open($query);
  $Menu = $dbSet->fetchRowsAll();

  $Services= getTableAsArray($_SQL_TABLE['service'], array("active = 'y'"));

  foreach($SITE_LANGS as $LCode => $larr)
  {
    foreach($Menu as $n => $arr)
    {
  	  if($arr['outerlink'] != '')
  	  {
  	    if(!preg_match("/^\//is", $arr['outerlink']) && !preg_match("/^http[s]*/is", $arr['outerlink']))
  	    {
  	      $arr['outerlink'] = validateURL($HOST.getPath($LCode).$arr['outerlink']);
  	    }
  	    elseif($arr['outerlink'] == '/')
  	    {
  	      $arr['outerlink'] = validateURL($HOST.getPath($LCode));
  	    }
  	    $result[$n]['link'] = $arr['outerlink'];
  	  }
  	  else
  	  {
  	    $result[$n]['link'] = validateURL($HOST.getPath($LCode)."articles/".$arr['linkname'].$CONFIG['webPageFileType']);
  	  }
  	  $SiteMap[$result[$n]['link']] = $result[$n]['link'];
    }

    foreach($Services as $n => $arr)
    {      $link = validateURL($HOST.getPath($LCode)."services/".$arr['linkname'].$CONFIG['webPageFileType']);
      $SiteMap[$link] = $link;
    }
  }


  $tpl->assign("SiteMap", $SiteMap);

  $tpl->assign("PageTitle", $language['admin']['sitemapBuilder']);

  $_ADMIN_SMARTY_TEMPLATE = "admin.sitemap_builder.tpl";

?>