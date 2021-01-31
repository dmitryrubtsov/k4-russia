<?php
/*
 * Smarty plugin
 * -------------------------------------------------------------
 * Type:     function
 * Name:     session_id
 * Purpose:  print out a session id
 * Example: (for sid = session_name())
 *
 *   <a href="file.php?sid={insert name=sid}">link</a>
 *
 * You can also use: 
 *
 *   <a href="file.php?sid={$smarty.request.sid}">link</a>
 *
 * but in this case value of sid will be cached.
 *
 * Author:   Jaroslaw Zabiello <webmaster@watchtower.org.pl>
 * -------------------------------------------------------------
 */
function smarty_insert_sid()
{
	global $HTTP_COOKIE_VARS;
	if (!isset($HTTP_COOKIE_VARS[session_name()]))
    	echo  "&" . SID . "&";
}
/* vim: set expandtab: */
?>