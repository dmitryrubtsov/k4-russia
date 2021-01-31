<?php

function smarty_function_apply_smarty_mods($params, &$smarty)
{
    $mods = "";
    if(!isEmptyArr($params['mod_arr']))
    {
      $mods = '|'.join('|', $params['mod_arr']);
    }
    $result = '{$'.$params['varname'].$mods.'}';

    if($params['assign'])
    {
      $smarty->assign($params['assign'], $result);
    }
    else
    {
      return $result;
    }
}


?>
