<?php
/**
updates by MMX
#20-jan-2003

*/
/*
 * Smarty plugin
 * ------------------------------------------------------------
 * Type:     modifier
 * Name:     escape
 * Purpose:  Escape the string according to escapement type
 * ------------------------------------------------------------
 */
function smarty_modifier_escape($string, $esc_type = 'html', $esc_charset='UTF-8')
{
$pageTitle="JoMo PPC Search Engine- admin area";
	//if ($string!=$pageTitle)		dprint("start modifier");
	/*
	if ($esc_type=="nodefaults"){
		dprint("no def");
		return $string;
	}
	*/
	// { by MMX
	//print_r($string);
	/*
	if (is_array($string) || is_object($string)){
		return $string;
	}
	*/
	if (is_object($string)){
		return $string;
	}

	if (is_array($string)){
		//dprint("array");
		$a = array();
		foreach ($string as $key=>$s){
			$newS = smarty_modifier_escape($s, $esc_type);
			$a[$key]=$newS;
		}
		return $a;
		return $string;
	}


//    $string = stripslashes($string);
	// } by MMX

	//if ($string!=$pageTitle)		dprint("escape $string, type=$esc_type");

    switch ($esc_type) {
        case 'html':

            //$string=htmlspecialchars($string, ENT_QUOTES);
            $string=str_replace('&amp;', '&', htmlspecialchars($string, ENT_QUOTES, $esc_charset));
            //if ($string!=$pageTitle)		dprint("return =$string, type=$esc_type");
            return $string;

        case 'htmlchars':

            $string=htmlspecialchars($string, ENT_QUOTES);
            return $string;

        case 'htmlall':
            return htmlentities($string, ENT_QUOTES);

        case 'url':
            return urlencode($string);

        case 'quotes':
            // escape unescaped single quotes
            return preg_replace("%(?<!\\\\)'%", "\\'", $string);

		case 'hex':
			// escape every character into hex
			for ($x=0; $x < strlen($string); $x++) {
				$return .= '%' . bin2hex($string[$x]);
			}
			return $return;

		case 'hexentity':
			for ($x=0; $x < strlen($string); $x++) {
				$return .= '&#x' . bin2hex($string[$x]) . ';';
			}
			return $return;

        default:
            return $string;
    }
}

/* vim: set expandtab: */

?>
