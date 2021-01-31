<?php

function smarty_function_explode($params, &$smarty)
{
    $array = explode($params['delim'], $params['str']);

    if(!isBlank($params['assign']))
    {
      $smarty->assign($params['assign'], $array);
    }
    else
    {
      return "";
    }
}


?>
