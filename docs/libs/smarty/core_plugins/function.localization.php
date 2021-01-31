<?php

function smarty_function_localization($params, &$smarty)
{
   $str = $params['str'];
   unset($params['str']);
   if($params['assign'])
   {
   	 $flag=1;
   	 $paramName = $params['assign'];
   }
   unset($params['assign']);
   foreach($params as $name => $val)
   {
   	 if(is_array($val))
   	 {
   	 	foreach($val as $NAME => $VAL)
   	 	{
   	 	  $str = str_replace($smarty->left_delimiter.'$'.$name.'.'.$NAME.$smarty->right_delimiter, $VAL, $str);
   	 	}
   	 }
   	 else
   	 {
   	 	$str = str_replace($smarty->left_delimiter.'$'.$name.$smarty->right_delimiter, $val, $str);
   	 }
   }

   if($flag==1)
   {
   	 $smarty->assign($paramName, $str);
   }
   else
   {
     return $str;
   }
}

/* vim: set expandtab: */

?>
