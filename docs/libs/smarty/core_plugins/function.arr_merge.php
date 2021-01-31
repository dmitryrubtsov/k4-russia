<?php

function smarty_function_arr_merge($params, &$smarty)
{
    foreach($params as $key => $arr)
    {
      if($key != 'type' && $key != 'assign')
      {
      	print_r($params[$key]);
      }
    }

    if(!isBlank($params[assign]))
    {
      $smarty->assign($params[assign], $Count);
    }
    else
    {
      return $Count;
    }
}


?>
