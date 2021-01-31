<?php
/**
 * Smarty round modifier plugin
 *
 * Type:     modifier<br>
 * Name:     round<br>
 * @author   Dmitriy Feschenko
 * @param double
 * @return double
 */
function smarty_modifier_round($value, $type = "round", $precision = 0)
{
   switch($type)
   {
   	 case "round": return round(doubleval($value),$precision);
   	 case "ceil": return ceil(doubleval($value));
   	 case "floor": return floor(doubleval($value));
   }

}

/* vim: set expandtab: */

?>
