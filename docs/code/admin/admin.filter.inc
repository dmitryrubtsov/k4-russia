<?

foreach($listInfo['where'] as $key => $arr)
{
	if($_REQUEST[$key] != '' && $arr['simple'] == 'y')
	{
		if(__CFG_FLTR_ADDSLASHES == __TRUE)
		{
			$RValue = addslashes($_REQUEST[$key]);
		}
		else
		{			$RValue = $_REQUEST[$key];
		}
		$listInfo['where'][$key]['value'] = $_REQUEST[$key];
		$listInfo['where'][$key]['forSQL'] = str_replace($CONFIG['AdminFilterValuePat'], $RValue, $arr['SQLField']);
	}
	$listInfo['where'][$key]['name'] = $key;
	$listInfo['where'][$key]['id'] = 'filter_'.$key;
}


?>