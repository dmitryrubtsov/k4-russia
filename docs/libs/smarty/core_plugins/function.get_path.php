<?php

function smarty_function_get_path($params, &$smarty)
{
    $path = getPath();

    if($params['assign'])
    {
      $smarty->assign($params['assign'], $path);
    }
    else
    {
      return $path;
    }
}


?>
