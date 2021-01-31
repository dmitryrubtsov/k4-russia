<?php
/*
 * Smarty plugin
 *
-------------------------------------------------------------
 * File:     modifier.get_value.php
 * Type:     modifier
 * Name:     get_value
 * Version:  1.0
 * Date:     04.03.2003
 * Purpose:  Get value from arraty
 * Install:  Drop into the plugin directory.
 * Author:   Alex Favorov <lofa@assa.vl.net.ua>
 *
-------------------------------------------------------------
 */
function smarty_modifier_get_value($key, $array_name)
{
	GLOBAL $$array_name;
	$array = $$array_name;
	$key += 0;
	if (isset($array) && isset($array[$key]) )
		return $array[$key];
	return $key;
}

/* vim: set expandtab: */

?>
