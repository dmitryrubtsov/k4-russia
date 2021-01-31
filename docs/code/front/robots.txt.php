<?php
  $filePath = "robots.txt";
  if(is_file(__CFG_CORE_PATH.$filePath))
  {
    $xmlp->setFileURL($ServerBaseURL.$filePath);
	$xmlp->MakeCompleteXMLPage();
	$xmlp->display();
	exit;

  }
  else
  {
    pageNotFound();
  }
  exit;

?>