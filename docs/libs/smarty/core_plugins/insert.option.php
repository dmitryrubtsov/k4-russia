<?php
/*
 * Smarty plugin
 */
function smarty_insert_sid($params)
{
	if (isset($params["oName"])
		return getOption($params["oName"]);
	else
		return null;
}
/* vim: set expandtab: */
?>