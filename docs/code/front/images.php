<?php

  require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "file.inc";

  $FilePath = str_replace($CONFIG['AdminLinkNameDelim'], '/', $_GET['path']);

  if(strstr($FilePath, $CONFIG['TemplateImagePathUrl']))
  {
  	$FPath = $CONFIG['SiteTypeFolder'].$CLIENT['template']['foldername'].$CLIENT['config']['category_code']."/".$CLIENT['config']['subcategory_code']."/".basename($FilePath);
  	if(is_file(__CFG_PATH_IMAGES.$FPath))
  	{
  	  $xmlp->setFileURL($ServerBaseURL.__CFG_PATH_IMAGES_URL.$FPath);
  	  //$xmlp->setHeader('Content-Type: '.mime_content_type(__CFG_PATH_IMAGES.$CONFIG['SiteTypeFolder'].$CLIENT['template']['foldername'].basename($FilePath)));
  	  //$xmlp->setFileMemoryFlag(2);
    }
    elseif(is_dir(__CFG_PATH_IMAGES.$FPath))
  	{
  	  $RandCode = $CLIENT['code'] + crc32(basename($FilePath));
  	  $Files = getListOfFiles(__CFG_PATH_IMAGES.$FPath);
  	  $path_parts = pathinfo(basename($FilePath));
  	  foreach($Files as $n => $filename)
  	  {  	    if(preg_match("/.".$path_parts["extension"]."$/", $filename))
  	    {  	      $ImFiles[] = $filename;
  	    }
  	  }
  	  unset($Files);
  	  $index = make_rand_sin(0, (count($ImFiles)-1), $RandCode);
  	  $xmlp->setFileURL($ServerBaseURL.__CFG_PATH_IMAGES_URL.$FPath."/".$ImFiles[$index]);
  	  //$xmlp->setHeader('Content-Type: '.mime_content_type(__CFG_PATH_IMAGES.$CONFIG['SiteTypeFolder'].$CLIENT['template']['foldername'].basename($FilePath)));
  	  //$xmlp->setFileMemoryFlag(2);
    }
    else
    {      pageNotFound();
    }
  }
  elseif(strstr($FilePath, $CONFIG['FeedLogoImageFolder'].'logo.png'))
  {  	$FPath = $CONFIG['FeedLogoImageFolder'].$CONFIG['SiteDomain'].$CONFIG['pngImFileType'];
  	if(is_file(__CFG_PATH_IMAGES.$FPath))
  	{
  	  $xmlp->setFileURL($ServerBaseURL.__CFG_PATH_IMAGES_URL.$FPath);
    }
    else
    {      pageNotFound();
    }
  }
  else
  {  	if(is_file(__CFG_PATH_IMAGES.$FilePath))
  	{
  	  $xmlp->setFileURL($ServerBaseURL.__CFG_PATH_IMAGES_URL.$FilePath);
  	  //$xmlp->setFileMemoryFlag(__TRUE);
    }
    else
    {      pageNotFound();
    }
  }


  $xmlp->MakeCompleteXMLPage();
  $xmlp->display();
  exit;

?>