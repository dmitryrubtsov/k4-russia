<?php

function smarty_function_rand($params, &$smarty)
{
  if($params['type'] == 'cos')
  {
    $result = make_rand_cos($params['min'], $params['max'], $params['int'], $params['prec'], $params['gain']);
  }
  else
  {
  	$result = make_rand_sin($params['min'], $params['max'], $params['int'], $params['prec'], $params['gain']);
  }

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
