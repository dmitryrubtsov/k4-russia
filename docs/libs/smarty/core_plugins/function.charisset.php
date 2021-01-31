<?php

function smarty_function_charisset($params, &$smarty)
{
    if(strstr($params['string'], $params['char']))
    {
      $smarty->assign('charisset', $params[char]);
    }
    else
    {
      $smarty->assign('charisset', '');
    }
}


?>
