<?php

function smarty_function_page_title($params, &$smarty)
{
  $words = explode(' ', $params[pageTitle]);
  foreach($words as $n => $val)
  {
  	if(trim($val) != '')
  	{
  	  $words[$n] = (($n >= floor(count($words)/2) && $n != 0) ? $params[ldelim1] : $params[ldelim2]).$val.$params[rdelim];
  	}
  }

  return join(' ', $words);
}

?>
