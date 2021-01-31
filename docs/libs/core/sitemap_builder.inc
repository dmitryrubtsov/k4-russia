<?php

function makeSitemap()
{  global $_SQL_TABLE, $CONFIG, $tpl, $dbSet, $HOST, $SITE_LANGS;

  require_once __CFG_PATH_LIBS.__CFG_PATH_CORE."menu.inc";

  $FrontMenu = FrontMenu::getInstance();

  $SiteMapList = array();

  	$query = "	SELECT
	  					m.id,
	  					m.title".__FLANG." AS title,
	  					m.outerlink,
	  					m.params
	  			 	FROM ".$_SQL_TABLE['menu']." m
	  			 	WHERE m.active = 'y'
	  			 	AND FIND_IN_SET(m.menu_block, '2,4') > 0
	  			 	ORDER BY m.position";
  	$dbSet->open($query);
  	$Menu = $dbSet->fetchRowsAll();


  	$News = getTableAsArray($_SQL_TABLE['news'], 'p_date DESC', array("active = 'y'"));

  	$Tags = getTableAsArray($_SQL_TABLE['keyword'], 'date', array("active = 'y'"));

  	foreach($Menu as $n => $arr)
    {
  	  	if($arr['outerlink'] != '')
	  	{
	  	    if(!preg_match("/^\//is", $arr['outerlink']) && !preg_match("/^http[s]*/is", $arr['outerlink']))
	  	    {
	  	      $arr['outerlink'] = $HOST.getPath().$arr['outerlink'];
	  	    }
	  	    elseif($arr['outerlink'] == '/')
	  	    {
	  	      $arr['outerlink'] = $HOST.getPath();
	  	    }
	  	    $Menu[$n]['link'] = $arr['outerlink'];
	  	}
	  	else
	  	{
	  	    $Menu[$n]['link'] = $FrontMenu->makeMenuLink($arr['params']);
	  	}

  	  validateURL($Menu[$n]['link']);
  	  $SiteMapList[$Menu[$n]['link']] = array('link' => $Menu[$n]['link'], 'code' => $arr['id']);
    }

    foreach($News as $n => $arr)
    {
      //$pdate = $arr['p_date'];
      $link = $HOST.getPath()."news/".substr($arr['p_date'], 0, 4).'/'.substr($arr['p_date'], 5, 2).'/'.substr($arr['p_date'], 8, 2).'/'.$arr['linkname'].$CONFIG['webPageFileType'];
      validateURL($link);
      $SiteMapList[$link] = array('link' => $link, 'code' => $arr['id']);
    }

    foreach($Tags as $n => $arr)
    {
      $link = $HOST.getPath($LCode)."tags/".$arr['linkname'].$CONFIG['webPageFileType'];
      validateURL($link);
      $SiteMapList[$link] = array('link' => $link, 'code' => $arr['id']);
    }

  $tpl->assign("SiteMapList", $SiteMapList);
  $template_dir = $tpl->template_dir;
  $tpl->template_dir = __CFG_PATH_TEMPLATE_ADMIN;
  $SiteMap = $tpl->fetch("admin.sitemap.tpl");
  $tpl->template_dir = $template_dir;
  require_once __CFG_PATH_LIBS_ADMIN . __CFG_PATH_CORE."file.inc";
  writeFile($SiteMap, __CFG_PATH_SITEMAPS_ADMIN, "sitemap.xml");
  $tpl->assign_by_ref('SiteMap', $SiteMap);
}
?>