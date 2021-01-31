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
function smarty_modifier_slashes($string, $unesc_type = 'strip')
{
   if($unesc_type == 'strip')
   {
     $string = stripslashes($string);
   }
   elseif($unesc_type == 'add')
   {
     $string = addslashes($string);
   }

   return $string;
}

/* vim: set expandtab: */

?>
