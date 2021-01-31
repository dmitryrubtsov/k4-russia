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
 * Name:     unescape<br>
 * @author   Dmitriy Feschenko
 * @param string
 * @return string
 */
function smarty_modifier_doubleval($value)
{
   return doubleval($value);
}

/* vim: set expandtab: */

?>
