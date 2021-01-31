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
function smarty_modifier_unescape($string, $unesc_type = 'stripslashes')
{
   $search = array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;', '&laquo;', '&raquo;', '&amp', '&quot', '&#039', '&lt', '&gt', '&laquo', '&raquo');
   $replace = array('&', '"', "'", '<', '>', '«', '»', '&', '"', "'", '<', '>', '«', '»');

   if($unesc_type == 'stripslashes')
   {
     $string = stripslashes($string);
   }

   $string = str_replace($search, $replace, $string);
   if($unesc_type == 'addslashes')
   {
     $string = addslashes($string);
   }
    elseif($unesc_type == 'ENT_COMPAT')
    {
        $string = htmlspecialchars($string, ENT_COMPAT);
    }

   return $string;
}

/* vim: set expandtab: */

?>
