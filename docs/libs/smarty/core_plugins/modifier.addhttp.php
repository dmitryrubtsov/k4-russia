<?php
function smarty_modifier_addhttp($url) {	
	if (!preg_match("|^https?://|",$url))
		$url = "http://$url";
	return $url;
}

?>
