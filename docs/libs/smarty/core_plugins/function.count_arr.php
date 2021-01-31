<?php

function smarty_function_count_arr($params, &$smarty)
{
    $Count = count($params[arr]);

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
