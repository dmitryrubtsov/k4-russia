<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty doubleval modifier plugin
 *
 * Type:     modifier<br>
 * Name:     urlencode<br>
 * @author   Dmitriy Feschenko
 * @param string
 * @return string
 */
function smarty_modifier_urlencode($value)
{
   return urlencode($value);
}

/* vim: set expandtab: */

?>
