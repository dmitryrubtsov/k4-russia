<?php

function smarty_modifier_xml_friendly($string)
{
   $search = array('&nbsp;', '&nbsp', '&');
   $replace = array(' ', ' ', "and");
   $string = stripslashes($string);
   return str_replace($search, $replace, $string);
}

/* vim: set expandtab: */

?>
