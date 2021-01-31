<?php

function smarty_function_validate_url($params, &$smarty)
{
    foreach($params as $name => $val)
    {
      if($name != 'assign')
      {
        $URL .= $val;
      }
    }
    validateURL($URL);

    if($params['assign'])
    {
      $smarty->assign($params['assign'], $URL);
    }
    else
    {
      return $URL;
    }
}


?>
