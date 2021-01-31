<?php

function smarty_function_pill_price($params, &$smarty)
{
  return ($params[quantity] > 0) ? sprintf("%.2f", (ceil(($params[price]/$params[quantity]*100))/100)) : $params[price];
}

/* vim: set expandtab: */

?>
