<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty escape modifier plugin
 *
 * Type:     modifier<br>
 * Name:     unescape<br>
 * @author   Dmitriy Feschenko
 * @param string
 * @return string
 */
function smarty_modifier_fckeditor_mod($string)
{
   $search = array('&amp;', '&quot;',  '&lt;', '&gt;', '&amp', '&quot', '&lt', '&gt', "\r\n");
   $replace = array('&', '"', '<', '>', '&', '"', '<', '>', '');
   return str_replace($search, $replace, $string);
}

/* vim: set expandtab: */

?>
