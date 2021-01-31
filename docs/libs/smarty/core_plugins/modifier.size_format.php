<?php
/*
 * Smarty plugin
 *
-------------------------------------------------------------
 * File:     modifier.size_format.php
 * Type:     modifier
 * Name:     size_format
 * Version:  1.0
 * Date:     Aug 18, 2002
 * Purpose:  Format size
 * Install:  Drop into the plugin directory.
 * Author:   Alex Favorov <lofa@assa.vl.net.ua>
 *
-------------------------------------------------------------
 */
function smarty_modifier_size_format($size, $desimals)
{
	if ($size < 1024) {
		return $size . "b";
	}
	if ($size < 1024*1024)  {
		return number_format($size/1024,$desimals) . "Kb";
	}
	if ($size < 1024*1024*1024) {
		return number_format($size/1024/1024,$desimals) . "Mb";
	}
	return number_format($size/1024/1024/1024,$desimals) . "Gb";
}

/* vim: set expandtab: */

?>
