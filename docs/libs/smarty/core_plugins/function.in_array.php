<?php

function smarty_function_in_array($params, &$smarty)
{
  $result = in_array($params['value'], $params['array']);

  if(!isBlank($params['assign']))
  {
    $smarty->assign($params['assign'], $result);
  }
  else
  {
    return $result;
  }
}

/* vim: set expandtab: */

?>
