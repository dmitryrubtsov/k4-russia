<?php

function smarty_function_gen_listingtab_head($params, &$smarty)
{
    $ConfFields = &$params['ConfFields'];
    $CONFIG = &$params['Config'];
    foreach($ConfFields as $name => $field)
    {
      if($field['useInList'] == $CONFIG['useInListSort'] && $field['inListNewRow'] != 'y')
      {
        $str .= '<td>{include file="admin.orderbyitem.tpl" title="'.$field['title'].'" orderby="'.(($field['orderby'] != '') ? $field['orderby'] : $name).'"'.(($field['tabord'] != '') ? ' taborder="'.$field['tabord'].'"' : '').'}</td>';
      }
      if($field['useInList'] == $CONFIG['useInListShow'] && $field['inListNewRow'] != 'y')
      {
        $str .= '<td>'.$field['title'].'</td>';
      }
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