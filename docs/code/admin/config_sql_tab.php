<?php

$GlobPart = str_replace($CONFIG['adminListPart'], '', $_REQUEST['mode']);
$WorkTableKeyFieldName = $CONFIG['sortByDefault'];
$tpl->assign_by_ref("WorkTableKeyFieldName", $WorkTableKeyFieldName);

if(is_file(__CFG_PATH_CODE ."configtab/config.sql.".$GlobPart.".php"))
{
	include_once __CFG_PATH_CODE ."configtab/config.sql.".$GlobPart.".php";
}

$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
$tpl->assign("WorkTableKeyVarName", $WorkTableKeyVarName);

$WorkTableContentLinkPattern = '/';
$tpl->assign_by_ref("WorkTableContentLinkPattern", $WorkTableContentLinkPattern);

?>