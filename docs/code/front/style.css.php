<?php

  require_once __CFG_PATH_LIBS . __CFG_PATH_CORE . "file.inc";

  //$FileDir = __CFG_CORE_PATH.$FileDirURL = __CFG_PATH_CSS.$CONFIG['SiteTypeFolder'];
  //$FileName = 'style_'.$CLIENT['client_template'].'_'.$CLIENT['client_template_color'].'.css';
  $FileDir = __CFG_CORE_PATH.$FileDirURL = __CFG_PATH_CSS;
  $FileName = 'style_main.css';

  /*if(!filemtime($FileDir.$FileName) || (time() - filemtime($FileDir.$FileName)) > $CONFIG['StyleCSSLifeTime'])
  { */
    //$tpl->assign("BodyBGColor", "#0AB8F8");
    //$tpl->assign("BodyBGColor", "#202020");
    //$tpl->assign("BodyBGColor", "#17276C");
    $tpl->assign("BodyBGColor", "#FFFFFF");
    //$tpl->assign("BodyBGColor", "#103952");
    //$tpl->assign("BodyBGColor", "#062C66");
    $tpl->assign("MainBGColor", "#FFFFFF");
    $tpl->assign("BGColor", "#E9EBEC");
    //$tpl->assign("TextColor", "#2C2C2C");
    $tpl->assign("TextColor", "#464646");
    $tpl->assign("LinkColor", "#464646");
    $tpl->assign("LinkColorHover", "#15B0E6");
    //$tpl->assign("BorderColor1", "#8A8989");
    //$tpl->assign("BorderColor2", "#8A8989");
    $tpl->assign("PageTitleColor", "#464646");
    $tpl->assign("UsefulColor", "#DA2929");
    writeFile($tpl->fetch($CONFIG['CSSFolder'].'css.main.tpl'), $FileDir, $FileName);
  //}

  /*$xmlp->setFileURL($ServerBaseURL.$FileDirURL.$FileName);
  $xmlp->MakeCompleteXMLPage();
  $xmlp->display();*/
  readfile($FileDir.$FileName);
  exit;

?>