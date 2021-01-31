<?php

  $xmlp->setFileURL($ServerBaseURL.$_GET['path']);
  $xmlp->setFileMemoryFlag(2);
  $xmlp->MakeCompleteXMLPage();
  $xmlp->display();
  exit;

?>