<?
/*
 * DF-FileManager
 * Version: 1.1 (8/02/2011)
 * Copyright (c) 2011 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

if(!MF::isBlank($_GET[__CFG_FLMGR_GET_PATH]))
{
  $Config->Path = $_GET[__CFG_FLMGR_GET_PATH];
  $sID->Path = $Config->Path;
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->Path))
{
  $Config->Path = $sID->Path;
}
else
{
  $Config->Path = "/";
  $sID->Path = $Config->Path;
  $Config->CleanFlag = __TRUE;
}

if(!MF::isBlank($_GET[__CFG_FLMGR_GET_RETURN_CALLBACK_FUNCTION_NAME]))
{
  $Config->ReturnCallbackFunctionName = $_GET[__CFG_FLMGR_GET_RETURN_CALLBACK_FUNCTION_NAME];
  $sID->ReturnCallbackFunctionName = $Config->ReturnCallbackFunctionName;
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->ReturnCallbackFunctionName))
{
  $Config->ReturnCallbackFunctionName = $sID->ReturnCallbackFunctionName;
}

if(!MF::isBlank($_GET[__CFG_FLMGR_GET_EDITOR]))
{
  $Config->Editor = $_GET[__CFG_FLMGR_GET_EDITOR];
  $sID->Editor = $Config->Editor;
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->EditorFunc))
{
  $Config->Editor = $sID->Editor;
}
if(!MF::isBlank($_GET[__CFG_FLMGR_GET_EDITOR_FUNC]))
{
  $Config->EditorFunc = $_GET[__CFG_FLMGR_GET_EDITOR_FUNC];
  $sID->EditorFunc = $Config->EditorFunc;
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->EditorFunc))
{
  $Config->EditorFunc = $sID->EditorFunc;
}

if(!MF::isBlank($_GET[__CFG_FLMGR_GET_EDITOR_LANG]))
{
  $Config->Language = $_GET[__CFG_FLMGR_GET_EDITOR_LANG];
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($_GET[__CFG_FLMGR_GET_LANGUAGE]))
{
  $Config->Language = $_GET[__CFG_FLMGR_GET_LANGUAGE];
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->Language))
{
  $Config->Language = $sID->Language;
}
if(!MF::isBlank($_GET[__CFG_FLMGR_GET_CHANGE_FILTER]))
{
  $Config->Filter = $_GET[__CFG_FLMGR_GET_FILTER];
  $sID->Filter = $Config->Filter;
  $Config->CleanFlag = __TRUE;
}
elseif(!MF::isBlank($sID->Filter))
{
  $Config->Filter = $sID->Filter;
}

  if(!MF::isBlank($_GET[__CFG_FLMGR_GET_SESSION_HANDLE]))
  {    $sID->Handle = $_GET[__CFG_FLMGR_GET_SESSION_HANDLE];
  }

  if($_SESSION[$sID->Handle]['Editor']['EnableFileManager'] == __TRUE)
  {    $Config->EnableFileManager = __TRUE;
  }
  else
  {  	$Config->EnableFileManager = __FALSE;
  }



  define('__CFG_FLMGR_SITE_ROOT_PATH',$Config->UploadedFilePath);
  define('__CFG_FLMGR_FTP_PATH',__CFG_FLMGR_FTP_ROOT_PATH.__CFG_FLMGR_SITE_ROOT_PATH);
  define('__CFG_FLMGR_SERVER_PATH',__CFG_FLMGR_ABSOLUTE_ROOT_PATH.__CFG_FLMGR_SITE_ROOT_PATH);
  define('__CFG_FLMGR_WWW_PATH',"/".__CFG_FLMGR_SITE_ROOT_PATH);


  define('__CFG_FLMGR_FILE_SIZE_PARAM',$Config->FileSizeParam);
  define('__CFG_FLMGR_FILE_SIZE_BYTE_EQ',$Config->FileSizeByteEq);
  define('__CFG_FLMGR_DISK_SPACE_LIMIT',$Config->DiskSpaceLimit);
  define('__CFG_FLMGR_IMAGE_FOLDER',$Config->ImageFolder);
  define('__CFG_FLMGR_ICON_IMAGE_FOLDER',$Config->IconImageFolder);
  define('__CFG_FLMGR_ICON_EXTENSION',$Config->IconExtension);
?>