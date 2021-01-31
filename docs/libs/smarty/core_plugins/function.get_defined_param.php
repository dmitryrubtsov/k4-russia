<?php

function smarty_function_get_defined_param($params, &$smarty)
{
    eval('$Value = '.$params['val'].';');

    if($params['assign'])
    {
      $smarty->assign('charisset', $value);
    }
    else
    {
      return $Value;
    }
}


?>
