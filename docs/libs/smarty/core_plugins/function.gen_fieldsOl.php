<?php

function smarty_function_gen_fields($params, &$smarty)
{
    $ConfFields = &$params['ConfFields'];
    if(is_array($params['Item']))
    {
      $flag = __TRUE;
    }
    foreach($ConfFields as $name => $field)
    {
      if(($flag == __TRUE && isBlank($smarty->get_template_vars('showAddNewForm'))) || $field['useInAddForm'] == 'y')
      {
        $str .= '
        <tr>
          <td '.(($field['position'] == 'vertical') ? 'class="doubletitle" colspan="2"' : 'class="title"').'>'.$field['title'].((!isBlank($field['required'])) ? '&nbsp;<span class="required">{$Config.AdminReqFieldSymbol}</span>' : '').'</td>'.(($field['position'] == 'vertical') ? '</tr><tr>' : '').'
          <td '.(($field['position'] == 'vertical') ? 'class="doublefield" colspan="2"' : 'class="field"').'>{include file="admin.field_'.$field['type'].'.tpl" Field=`$ConfFields.'.$name.'`}'.((!isBlank($field['editable']) && $name == 'linkname') ? '&nbsp;&nbsp;<a href="#" onclick="showMessage(\''.$name.'\');return false;">{$lang.admin.edit}</a>' : '').'</td>
        </tr>';
        if($field['editFormOther'] != '' && $flag == __TRUE && isBlank($smarty->get_template_vars('showAddNewForm')))
        {
          $ConfFields[$name]['other'] .= ((!isBlank($ConfFields[$name]['other'])) ? ' ' : '').$field['editFormOther'];
        }
        $ConfFields[$name]['name'] = $name;
        if(isBlank($ConfFields[$name]['id']))
        {
          $ConfFields[$name]['id'] = $name;
        }
        if(!isBlank($ConfFields[$name]['defaultValue']) && isBlank($params['Item'][$name]))
        {
          $ConfFields[$name]['value'] = $ConfFields[$name]['defaultValue'];
        }
        else
        {
          $ConfFields[$name]['value'] = $params['Item'][$name];
        }

        /*
        if($name == 'linkname' && $field['useInAddForm'] != 'y')
        {
          $str .= '{include file="admin.field_hidden.tpl" Field=`$ConfFields.'.$name.'`}';
          if(!isblank($field['editable']))
          {
            $str .= '<div class="hid" id="buttons'.$name.'"><input type="button" value="{$lang.admin.editButton}" onclick="document.forms[\'{$Config.activeFormName}\'].act.value=\'editfield\';document.forms[\'{$Config.activeFormName}\'].{$WorkTableKeyVarName}.value=\'{$Item.$WorkTableKeyFieldName}\';document.forms[\'{$Config.activeFormName}\'].varname.value=\''.$name.'\';document.forms[\'{$Config.activeFormName}\'].varvalue.value=document.getElementById(\'edf'.$name.'\').value;document.forms[\'{$Config.activeFormName}\'].submit();hideMessage();" />&nbsp;&nbsp;&nbsp;<input type="button" value="{$lang.admin.cancelButton}" onclick="hideMessage();" /></div>
  				    <div class="hid" id="message'.$name.'">{$lang.admin.enterNewValue}:<br /><input type="text" id="edf'.$name.'" name="fld" value="{$ConfFields.'.$name.'.value}" /></div>';
          }

          $ConfFields[$name]['name'] = 'old_'.$name;
        }   */
      }
    }
    $smarty->assign_by_ref("ConfFields", $ConfFields);
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