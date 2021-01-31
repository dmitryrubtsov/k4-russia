<?php

function smarty_function_template_exists($params, &$smarty)
{
    if($smarty->template_exists($params[file]))
    {
      $filename = $params[file];
    }
    else
    {
      $filename = $params[alternative];
    }

    if($params[assign] != '')
    {
      $smarty->assign_by_ref($params[assign], $filename);
    }
    else
    {
     echo $filename;
    }

}


?>
