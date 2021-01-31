<?php

  $filePath = __CFG_PATH_SITEMAPS.'sitemap.xml';
  if(!filemtime(__CFG_CORE_PATH.$filePath) || (time() - filemtime(__CFG_CORE_PATH.$filePath)) > $CONFIG['SitemapXMLLifeTime'])
  {
  	require_once __CFG_PATH_LIBS . __CFG_PATH_CORE."sitemap_builder.inc";
  	if(is_callable('makeSitemap'))
  	{
	  eval('makeSitemap();');
  	}
  }
  if(is_file(__CFG_CORE_PATH.$filePath))
  {
    /*$xmlp->setFileURL($ServerBaseURL.$filePath);
    $xmlp->MakeCompleteXMLPage();
    $xmlp->display();
    */
    header("Content-Type: text\xml; charset=UTF-8");
    readfile(__CFG_CORE_PATH.$filePath);
  }
  else
  {
    pageNotFound();
  }
  exit;

?>