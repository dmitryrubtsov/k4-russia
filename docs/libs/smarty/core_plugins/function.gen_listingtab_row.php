<?php

function smarty_function_gen_listingtab_row($params, &$smarty)
{
    $ConfFields = &$params['ConfFields'];
    $CONFIG = &$params['Config'];
    $Item = &$params['Item'];
    $CellCount = 0;
    $TitleFlag = __FALSE;
    //print_r($ConfFields);
	foreach($ConfFields as $name => $field)
	{
		$Title = '<b>'.$field['title'].':</b>';
		$String = (($TitleFlag == __TRUE) ? $Title : '').'{include file="admin.field_'.((!isBlank($field['inListEdit'])) ? $field['inListEdit'] : 'value').'.tpl" Field=`$ConfFields.'.$name.'` Item=$curr}';
		if(!isBlank($field['useInList']) && $field['inListNewRow'] != 'y')
		{
			if($Item['colorcode'] && $field['colorfield'] == 'y')
			{
				$str .= '<td><span style="color:'.$Item['colorcode'].'; font-weight: bold;">'.$String.'</span></td>';
			}
			else
			{
				$str .= '<td>'.$String.'</td>';
			}
			$ConfFields[$name]['name'] = $name;
			if(!isBlank($ConfFields[$name]['defaultValue']) && isBlank($Item[$name]))
			{
				$ConfFields[$name]['value'] = $ConfFields[$name]['defaultValue'];
			}
			else
			{
				$ConfFields[$name]['value'] = $Item[$name];
			}
			$CellCount++;
		}
		elseif(!isBlank($field['useInList']) && $field['inListNewRow'] = 'y')
		{
			$ConfFields[$name]['name'] = $name;
			if(!isBlank($ConfFields[$name]['defaultValue']) && isBlank($Item[$name]))
			{
				$ConfFields[$name]['value'] = $ConfFields[$name]['defaultValue'];
			}
			else
			{
				$ConfFields[$name]['value'] = $Item[$name];
			}
			if(!isBlank($ConfFields[$name]['value']))
			{
				$str .= '</tr><tr class="{$trClass}"><td colspan="3">&nbsp;</td><td colspan="'.$CellCount.'">'.(($TitleFlag != __TRUE) ? $Title : '').$String.'</td>';
			}
			$TitleFlag = __TRUE;
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