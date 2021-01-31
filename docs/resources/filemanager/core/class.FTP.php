<?php

/*
 * DF-FileManager
 * Version: 1.0 (3/06/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

	define("__ERROR_FTP_CANNOT_CONNECT_TO_SERVER", "Couldn't connect to server");
	define("__ERROR_FTP_CANNOT_CONNECT_AS_USER", "Couldn't connect as user");
	define("__ERROR_FTP_CANNOT_CREATE_DIR", "Couldn't create a directory");
	define("__ERROR_FTP_CANNOT_CHANGE_MODE", "Couldn't change mode of file");
	define("__ERROR_FTP_CANNOT_UPLOAD_FILE", "There was a problem while uploading file");
	define("__ERROR_FTP_CANNOT_RENAME_FILE", "There was a problem while renaming file");
	define("__ERROR_FTP_CANNOT_DELETE_FILE", "Couldn't delete file");
	define("__ERROR_FTP_CANNOT_DELETE_DIR", "Couldn't delete directory");
	define("__ERROR_FTP_CANNOT_CHANGE_DIR", "Couldn't change directory");

	define("__TRUE", TRUE);
	define("__FALSE", FALSE);
	define('__CFG_PTF_USE_SSL', __FALSE);


class FTPAgent
{
	private $FTPServer;
	private $FTPUserName;
	private $FTPPassword;
	private $FTPPort = "";
	private $FTPTimeout = "";
	private $FTPRootPath = "";
	private $FTPConnID;
	private $FTPUseSSL = __CFG_PTF_USE_SSL;

	public $FTPErrorFlag = __FALSE;
	public $FTPErrorMessage = "";
	public $FTPPassiveMode = __TRUE;


  public function __construct($Server, $UserName, $Password, $RootPath, $PassiveMode=__TRUE, $Port="", $Timeout="")
  {
    $this->FTPServer = $Server;
    $this->FTPUserName = $UserName;
    $this->FTPPassword = $Password;
    $this->FTPRootPath = $RootPath;
    $this->FTPPort = $Port;
    $this->FTPTimeout = $Timeout;
    $this->FTPPassiveMode = $PassiveMode;

    $this->connect();
    $this->setPassiveMode();
  }

  public function __destruct()
  {
    $this->close();
  }

  public function __set($name, $value)
  {
    $this->$name = $value;
  }

  public function __get($name)
  {
    return $this->$name;
  }

	private function connect()
	{
		if($this->FTPUseSSL)
		{
			$this->FTPConnID = ftp_ssl_connect($this->FTPServer) or die("SSL Connection Failed!!!");
		}
		else
		{
			$this->FTPConnID = ftp_connect($this->FTPServer) or die("Connection Failed!!!");
		}

		return $this->login();
	}

	public function close()
	{
		ftp_close($this->FTPConnID);
	}

  private function login()
  {
    if(!@ftp_login($this->FTPConnID, $this->FTPUserName, $this->FTPPassword))
    {
      $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_CONNECT_AS_USER;
      return __FALSE;
    }
    return __TRUE;
  }

  private function setPassiveMode()
  {
	ftp_pasv($this->FTPConnID, $this->FTPPassiveMode);
  }

  public function makeDir($Path, $Mode="")
  {
    if(substr($Path,0,1) == "/")
    {
      $Path = substr($Path,1);
    }
    $dirs = explode('/', $Path);
	foreach($dirs as $n => $curr_dir)
	{
	  $path = "";
	  foreach($dirs as $m => $cdir)
	  {
	    if($m == $n)
	    {
	      break;
	    }
	    $path .= $cdir."/";
	  }
	  if(!$this->isFilePresent($path, $curr_dir))
	  {
	    $path .= $curr_dir;
	    if(!ftp_mkdir($this->FTPConnID, $this->checkRootPath($path)))
	    {
	  	  $this->FTPErrorFlag = __TRUE;
      	  $this->FTPErrorMessage = __ERROR_FTP_CANNOT_CREATE_DIR;
      	  return __FALSE;
	    }
	  }
    }
    if($Mode != "")
    {
      $this->chDirMode($path, $Mode);
    }
    return __TRUE;
  }

  public function chDirMode($Path, $Mode='0777')
  {
    $Path = $this->checkRootPath($Path);

    $chmod_cmd = "CHMOD ".$Mode." ".$Path;
	if(!ftp_site($this->FTPConnID, $chmod_cmd))
	{
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_CHANGE_MODE;
      return __FALSE;
	}
	return __TRUE;
  }

  public function getDirContents($Path)
  {
  	$Path = $this->checkRootPath($Path);
  	return ftp_nlist($this->FTPConnID, $Path);
  }

  public function isFilePresent($Path, $FileName)
  {
  	$Path = $this->checkRootPath($Path);
  	$contents = $this->getDirContents($Path);
  	foreach($contents as $n => $fname)
  	{
      if(str_replace($Path, "", $fname) == $FileName)
      {
        return __TRUE;
      }
  	}
  	return __FALSE;
  }

  public function checkRootPath($Path="")
  {
  	if($this->FTPRootPath != '/')
  	{
  	  $Path = str_replace($this->FTPRootPath, "", $Path);
  	}
  	$path = $this->FTPRootPath.$Path;
  	$path = preg_replace("/\/{2,}/", "/", $path);
  	return $path;
  }

  public function uploadFile($RemoteFile, $LocalFile)
  {
  	$this->makeDir(dirname($RemoteFile));
  	$RemoteFile = $this->checkRootPath($RemoteFile);
  	if(!ftp_put($this->FTPConnID, $RemoteFile, $LocalFile, FTP_BINARY))
  	{
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_UPLOAD_FILE;
      return __FALSE;
	}
	return __TRUE;
  }

  public function uploadOpenedFile($RemoteFile, $FP)
  {
  	$this->makeDir(dirname($RemoteFile));
  	$RemoteFile = $this->checkRootPath($RemoteFile);
  	if(rewind($FP))
  	{
  	  if(!ftp_fput($this->FTPConnID, $RemoteFile, $FP, FTP_BINARY))
  	  {
	    $this->FTPErrorFlag = __TRUE;
        $this->FTPErrorMessage = __ERROR_FTP_CANNOT_UPLOAD_FILE;
        return __FALSE;
	  }
	  return __TRUE;
	}
  }

  public function renameFile($OldFile, $NewFile)
  {
  	$this->makeDir(dirname($NewFile));
  	$OldFile = $this->checkRootPath($OldFile);
  	$NewFile = $this->checkRootPath($NewFile);
  	if(!ftp_rename($this->FTPConnID, $OldFile, $NewFile))
  	{
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_RENAME_FILE;
      return __FALSE;
	}
	return __TRUE;
  }

  public function deleteFile($Path)
  {
    $Path = $this->checkRootPath($Path);
    if(!ftp_delete($this->FTPConnID, $Path))
    {
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_DELETE_FILE;
      return __FALSE;
	}
	return __TRUE;
  }

  public function deleteDir($Path)
  {
    $Path = $this->checkRootPath($Path);
    if(!ftp_rmdir($this->FTPConnID, $Path))
    {
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_DELETE_DIR;
      return __FALSE;
	}
	return __TRUE;
  }

  public function deleteDirWithContents($Path)
  {
    $Path = $this->checkRootPath($Path);
    $currPath = $this->getCurrDir();
    $contents = $this->getDirContents($Path);
    foreach($contents as $n => $filename)
    {
      $fname = str_replace("//", "/", str_replace($Path, "/", $filename));
      if($fname != '/.' && $fname != '/..')
      {
        if(!$this->deleteFile($filename))
        {
          $this->deleteDirWithContents($filename);
        }
      }
    }
    return $this->deleteDir($Path);
  }

  public function deleteDirContents($Path)
  {
    $Path = $this->checkRootPath($Path);
    $contents = $this->getDirContents($Path);
    foreach($contents as $n => $filename)
    {
      $fname = str_replace("//", "/", str_replace($Path, "/", $filename));
      if($fname != '/.' && $fname != '/..')
      {
        if(!$this->deleteFile($filename))
        {
          $this->deleteDirWithContents($filename);
        }
      }
    }
  }

  public function getCurrDir()
  {
    return ftp_pwd($this->FTPConnID);
  }

  public function changeCurrDir($Path)
  {
    $Path = $this->checkRootPath($Path);
    if(ftp_chdir($this->FTPConnID, $Path))
    {
	  $this->FTPErrorFlag = __TRUE;
      $this->FTPErrorMessage = __ERROR_FTP_CANNOT_CHANGE_DIR;
      return __FALSE;
	}
	return __TRUE;
  }
}

?>