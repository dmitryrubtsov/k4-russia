<?php

function smarty_function_is_file($params, &$smarty)
{
  if($params['basedir'] == '')
  {
  	$basedir = __CFG_CORE_PATH;
  }
  else
  {
    $basedir = $params['basedir'];
  }
  $_image_path = $basedir . $params['file'];
  $result = (is_file($_image_path)) ? $params['file'] : '';
  $smarty->assign($params['assign'], $result);
}

/* vim: set expandtab: */

?>
