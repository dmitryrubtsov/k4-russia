<?
/*
 * DF-FileManager
 * Version: 1.1 (8/02/2011)
 * Copyright (c) 2011 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

error_reporting(E_ERROR);
include_once "config.php";
include_once "core/class.MainFunc.php";
include_once "core/class.Session.php";
include_once "core/class.FileBrowser.php";

MF::setDelims();
$sID = new Session($Config->SessionName, $Config->SessionLifeTime, __NULL, (!MF::isBlank($_GET[__CFG_FLMGR_GET_SESSION_ID])) ? $_GET[__CFG_FLMGR_GET_SESSION_ID] : __NULL);

include_once "definer.inc";
if(!is_file("lang/".$Config->Language.".php"))
{	$Config->Language =  __CFG_FLMGR_DEFAULT_LANGUAGE;
}
include_once "lang/".$Config->Language.".php";

$sID->Language = $Config->Language;
header("Content-Type: text/html; charset=".__CFG_FLMGR_LANG_CHARSET);
$browser = new FileBrowser(__CFG_FLMGR_SERVER_PATH, $Config->Path, $Config->Extensions, $Config->Filters, $Config->Filter);

if(!$browser->isValidPath())
{
	$Config->ErrorMessage = $Lang->Error->IncorrectPath;
	$Config->ErrorMessageCode = __CFG_FLMGR_ERROR_GO_HOME;
}
elseif($Config->EnableFileManager == __FALSE)
{
	$Config->ErrorMessage = $Lang->Error->NoPermissionsToUse;
	$Config->ErrorMessageCode = __CFG_FLMGR_ERROR_CLOSE_WINDOW;
}
elseif($Config->CleanFlag == __TRUE)
{
	$Config->CleanUri = $Config->FileManagerCleanLink;
	header("Location: ".$Config->CleanUri);
	exit;
}
else
{
	$browser->handler();
}

include_once "template.php";


?>