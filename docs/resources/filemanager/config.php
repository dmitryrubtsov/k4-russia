<?
/*
 * DF-FileManager
 * Version: 1.1 (8/02/2011)
 * Copyright (c) 2011 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

  define("__TRUE", TRUE);
  define("__FALSE", FALSE);
  define("__NULL", NULL);

  include_once "../../config.php";

  define('__CFG_FLMGR_ABSOLUTE_ROOT_PATH', __CFG_CORE_PATH);

  $Config = new StdClass;
  $Config->EnableFileManager = __FALSE;
  $Config->AllowBrowser = __TRUE;
  $Config->AllowUploader = __TRUE;

  $Config->FileManagerCleanLink = dirname($_SERVER['SCRIPT_NAME'])."/";

  $Config->Language = 'en';
  $Config->Languages = array(
  								'en' => 'English',
  								'ru' => 'Русский',
  								'ua' => 'Українська',
  );
  $Config->UploadedFilePath = __CFG_FILE_MANAGER_FOLDER;
  $Config->FileSizeParam = 'kb';
  $Config->FileSizeByteEq = '1024';
  $Config->DiskSpaceLimit = '2500000'; // in kb  1 mb = 1024 kb

  $Config->SessionName = 'DFFLMNGR';
  $Config->SessionLifeTime = 1800;

  $Config->ImageFolder = "images/";
  $Config->IconImageFolder = "images/icons/";
  $Config->IconExtension = ".gif";

  $Config->Filters = array('','image','flash','media');
  $Config->Filter = '';

  $Config->ErrorMessage = '';
  $Config->ErrorMessageCode = '';

  $Config->Extensions = new StdClass;
  $Config->Extensions->Incorrect = array(
  											'jpeg' => 'jpg',
  											'jpe' => 'jpg'
  );

  $Config->Extensions->Denied = array('php','php2','php3','php4','php5','phtml','pwml','inc','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','com','dll','vbs','js','reg','cgi') ;
  $Config->Extensions->Allowed['image'] = array('jpg','gif','png');
  $Config->Extensions->Allowed['flash']	= array('swf','fla');
  $Config->Extensions->Allowed['media']	= array('swf','fla','jpg','gif','png','avi','mpg','mpeg') ;

  define("__CFG_FLMGR_LANG_CHARSET", "utf-8");

  define("__CFG_FLMGR_VERSION", '1.0');
  define("__CFG_FLMGR_DEFAULT_LANGUAGE", 'en');

  define("__CFG_FLMGR_GET_EDITOR", 'CKEditor');
  define("__CFG_FLMGR_GET_EDITOR_FUNC", 'CKEditorFuncNum');
  define("__CFG_FLMGR_GET_EDITOR_LANG", 'langCode');

  define("__CFG_FLMGR_GET_PATH", '__rBd_');
  define("__CFG_FLMGR_GET_FILTER", '_r8b_');
  define("__CFG_FLMGR_GET_SESSION_ID", '_r8d_');
  define("__CFG_FLMGR_GET_SESSION_HANDLE", '_rBd_');
  define("__CFG_FLMGR_GET_LANGUAGE", '__r8b_');
  define("__CFG_FLMGR_GET_CHANGE_FILTER", '_r8b__');
  define("__CFG_FLMGR_GET_RETURN_CALLBACK_FUNCTION_NAME", '_rBb__');
  define("__CFG_FLMGR_POST_ACTION", '__025');
  define("__CFG_FLMGR_POST_FOLDER", '_53453');
  define("__CFG_FLMGR_POST_FILE", '_47_17');

  define("__CFG_FLMGR_ACT_ADD", '_2_d5');
  define("__CFG_FLMGR_ACT_DEL_FILE", '_071');
  define("__CFG_FLMGR_ACT_DEL_FOLDER", '__67q2');

	/* -- FTP params -- */
	define('__CFG_FLMGR_FTP_HOST',__CFG_PTF_HOSTNAME);
	define('__CFG_FLMGR_FTP_USER',__CFG_PTF_USERNAME);
	define('__CFG_FLMGR_FTP_PASS',__CFG_PTF_PASSWORD);
	define('__CFG_FLMGR_FTP_ROOT_PATH',__CFG_PTF_CORE_PATH);



	define('__CFG_FLMGR_ERROR_GO_HOME','101');
	define('__CFG_FLMGR_ERROR_CLOSE_WINDOW','102');

	/*
	$host = __CFG_FLMGR_FTP_HOST;
	$connect = ftp_connect($host);
	if(!$connect)
	{
		echo("ERROR");
		exit;
	}
	else
	{
		$user = __CFG_FLMGR_FTP_USER;
		$password = __CFG_FLMGR_FTP_PASS;
		$result = ftp_login($connect, $user, $password);
		if(!$result)
		{
			echo("ERROR");
			exit;
		}
		else
		{			echo("Connect GOOD");
			exit;		}
	}
	*/


?>