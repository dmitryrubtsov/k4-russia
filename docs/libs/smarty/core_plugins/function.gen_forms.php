<?php

function smarty_function_gen_forms($params, &$smarty)
{
    $ConfEditForms = &$params['ConfEditForms'];
    foreach($ConfEditForms as $n => $name)
    {
      $str .= '{include file="admin.form_'.$name.'.tpl"}';
    }
    if($params['assign'] != '')
    {
      $smarty->assign_by_ref($params['assign'], $str);
    }
    else
    {
      echo $str;
    }
}


?>
