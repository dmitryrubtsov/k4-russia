<?php
/*
 * DF-FileManager
 * Version: 1.0 (3/06/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

define("__ERROR_BROWSER_NO_FREE_SPACE", "NoFreeSpace");
define("__ERROR_BROWSER_FORBIDDEN_FILE_FORMAT", "ForbiddenFileFormat");
define("__ERROR_BROWSER_INCORRECT_FILTER_FILE_FORMAT", "IncorrectFilterFileFormat");

class FileBrowser
{
  private $Root;
  private $RootPath;
  private $Path;
  private $Param;
  private $SpaceUsed = 0;
  private $SpaceFree = 0;
  private $SpaceLimit = 0;
  private $Extensions;
  private $Filter;
  private $Filters;

  public $PathMap = array();
  public $PrevPath = array();
  public $Folders = array();
  public $Files = array();
  public $ErrorFlag = __FALSE;
  public $ErrorMessage = "";

  public function __construct($Root, $Path, $Extensions, $Filters, $Filter)
  {
    $this->Root = $Root;
    if(!is_dir($this->Root))
    {      include_once "core/class.FTP.php";
	  $ftps = new FTPAgent(__CFG_FLMGR_FTP_HOST, __CFG_FLMGR_FTP_USER, __CFG_FLMGR_FTP_PASS, __CFG_FLMGR_FTP_ROOT_PATH);
	  $ftps->makeDir(__CFG_FLMGR_SITE_ROOT_PATH);
	  $ftps->close();
    }
    $this->Extensions = clone $Extensions;
    $this->Filters = $Filters;
    $this->Param = new StdClass;
    $this->Path = (!MF::isBlank($Path) ? preg_replace("/\/{2,}/", "/", $Path) : '/');
    $this->Filter = (!MF::isBlank($Filter) ? MF::strToLowerCase($Filter) : '');
    if(!in_array($this->Filter, $this->Filters))
    {      $this->Filter = '';
    }

	$length = strlen($this->Path);
	if(substr($this->Path, ($length-1), 1) != '/')
	{
	  $this->Path .= '/';
	}
	if(substr($this->Path, 0, 1) != '/')
	{
	  $this->Path = "/".$this->Path;
	}
	$this->RootPath = $this->checkRootPath($this->Path);
	$this->SpaceLimit = __CFG_FLMGR_DISK_SPACE_LIMIT;
	$this->SpaceUsed = ($this->dirSize($this->Root)/__CFG_FLMGR_FILE_SIZE_BYTE_EQ);
	$this->SpaceFree = $this->SpaceLimit - $this->SpaceUsed;
  }

  public function setError($Error)
  {  	$this->ErrorFlag = __TRUE;
  	$this->ErrorMessage = $Error;
  }

  public function getDirContents($Path="")
  {
  	$dir = $this->checkRootPath($Path);
  	$dp = opendir($dir);
  	while($currentFile !== false)
    {
      $currentFile = readdir($dp);
      if($currentFile != "." && $currentFile != ".." && $currentFile !== false)
      {
        $theFiles[] = $currentFile;
      }
    }
    return $theFiles;
  }

  public function __get($Name)
  {    switch($Name)
    {      case 'SpaceUsed': return $this->SpaceUsed;
      case 'SpaceLimit': return $this->SpaceLimit;
      case 'SpaceFree': return $this->SpaceFree;
      case 'Filter': return $this->Filter;
      default: return __FALSE;
    }
  }

  public function isFilePresent($Path, $FileName='')
  {
  	return file_exists($this->checkRootPath($Path.$FileName));
  }

  public function checkRootPath($Path="")
  {
  	if($this->Root != '/')
  	{  	  $Path = str_replace($this->Root, "", $Path);
  	}
  	$path = $this->Root.$Path;
  	$path = preg_replace("/\/{2,}/", "/", $path);

  	return $path;
  }

  public function getCurrDir()
  {
    return getcwd();
  }

  public function changeCurrDir($Path)
  {
    $Path = $this->checkRootPath($Path);
    if(!chdir($Path))
    {
	  $this->ErrorFlag = __TRUE;
      $this->ErrorMessage = __ERROR_CANNOT_CHANGE_DIR;
      return __FALSE;
	}
	return __TRUE;
  }

  public function dirSize($Path)
  {
    $Path = $this->checkRootPath($Path."/");

    $TotalSize = 0;

    $dp = opendir($Path);
    while($currentFile !== false)
    {
      $currentFile = readdir($dp);
      if($currentFile != "." && $currentFile != ".." && $currentFile !== false)
      {
        $TotalSize += filesize($Path.$currentFile);
        if(is_dir($Path.$currentFile))
        {          $TotalSize += $this->dirSize($Path.$currentFile);
        }
      }
    }
    closedir($dp);
    return $TotalSize;
  }

  public function setFolderMap()
  {    $result = $this->getDirContents($this->Path);
	if(!MF::isEmptyArr($result))
	{
		foreach($result as $n => $value)
		{
		  $path = $this->checkRootPath($this->Path.$value);
		  if(is_dir($path))
		  {
		    $folder = array(
		    				'title' => $value,
		    				'path' => $this->Path.$value,
		    				'size' => ($this->dirSize($path)/__CFG_FLMGR_FILE_SIZE_BYTE_EQ),
		    				'date' => filemtime($path),
		    				'noDelete' => ((!MF::isBlank($this->Filter)) ? __TRUE : __FALSE),
		    );
		    $this->Folders[] = $folder;
		  }
		  elseif(is_file($path))
		  {
		    $extension = substr($value,(strrpos($value,".")+1));
		    if(MF::isBlank($this->Filter) || !MF::isBlank($this->Filter) && in_array($extension, $this->Extensions->Allowed[$this->Filter]))
		    {
		      if(!is_file(__CFG_FLMGR_ICON_IMAGE_FOLDER.$extension.__CFG_FLMGR_ICON_EXTENSION))
		      {		        $extension = 'default';
		      }
		      $file = array(
		    				'title' => $value,
		    				'path' => $this->Path.$value,
		    				'size' => (filesize($path)/__CFG_FLMGR_FILE_SIZE_BYTE_EQ),
		    				'date' => filemtime($path),
		    				'info' => getimagesize($path),
		    				'ext' => $extension,
		      );
		      $this->Files[] = $file;
			}
		  }
		}
		$folderSort = array();
		foreach($this->Folders as $i => $folder)
		{
			$folderSort[strtoupper($folder['title'])] = $i;
		}
		ksort($folderSort);
		$Folders = array();
		foreach($folderSort as $i)
		{
			array_push($Folders, $this->Folders[$i]);
		}
		$this->Folders = $Folders;

		$fileSort = array();
		foreach($this->Files as $i => $file)
		{			$fileSort[strtoupper($file['title'])] = $i;		}
		ksort($fileSort);
		$Files = array();
		foreach($fileSort as $i)
		{			array_push($Files, $this->Files[$i]);		}
		$this->Files = $Files;
	}
  }

  public function setPathMap()
  {    $pathArr = explode('/', $this->Path);
	$currPath = '/';
	foreach($pathArr as $n => $val)
	{
	  if(!MF::isBlank($val))
	  {
	    $folder = array(
	  					'title' => $val,
	  					'path' => $currPath.$val,
	  	);
	    $this->PathMap[] = $folder;
	    if($n > 0)
	    {
	      $this->PrevPath = array(
	      					'title' => '..',
	      					'path' => $currPath,
	      );
	    }
	    $currPath .= $val.'/';
	  }
	}
  }

  public function isValidPath()
  {    return $this->isFilePresent($this->Path);
  }

  private function uploadFile($ftp)
  {    $extension = MF::StrToLowerCase(substr($_FILES[__CFG_FLMGR_POST_FILE]['name'],(strrpos($_FILES[__CFG_FLMGR_POST_FILE]['name'],".")+1)));
    if(array_key_exists($extension, $this->Extensions->Incorrect))
    {
      $new_extension = $this->Extensions->Incorrect[$extension];
      $_FILES[__CFG_FLMGR_POST_FILE]['name'] = preg_replace("/.".$extension."$/is", ".".$new_extension, $_FILES[__CFG_FLMGR_POST_FILE]['name']);
      $extension = $new_extension;
    }
    if(in_array($extension, $this->Extensions->Denied))
    {
      $this->setError(__ERROR_BROWSER_FORBIDDEN_FILE_FORMAT);
      return __FALSE;
    }
    if(!MF::isBlank($this->Filter) && !in_array($extension, $this->Extensions->Allowed[$this->Filter]))
    {
      $this->setError(__ERROR_BROWSER_INCORRECT_FILTER_FILE_FORMAT);
      return __FALSE;
    }
    if(($this->SpaceFree * __CFG_FLMGR_FILE_SIZE_BYTE_EQ) < $_FILES[__CFG_FLMGR_POST_FILE]['size'])
    {
	  $this->setError(__ERROR_BROWSER_NO_FREE_SPACE);
	  return __FALSE;
	}

	$ftp->uploadFile($this->Path.MF::makeLinkname($_FILES[__CFG_FLMGR_POST_FILE]['name'],"."), $_FILES[__CFG_FLMGR_POST_FILE]['tmp_name']);
  }

  public function handler()
  {
	if(!MF::isEmptyArr($_POST))
	{
	  include_once "core/class.FTP.php";
	  $ftp = new FTPAgent(__CFG_FLMGR_FTP_HOST, __CFG_FLMGR_FTP_USER, __CFG_FLMGR_FTP_PASS, __CFG_FLMGR_FTP_PATH);

	  if(!MF::isBlank($_POST[__CFG_FLMGR_POST_FOLDER]) && $_POST[__CFG_FLMGR_POST_ACTION] == __CFG_FLMGR_ACT_ADD)
	  {
	    if(($this->SpaceFree * __CFG_FLMGR_FILE_SIZE_BYTE_EQ) < 4096)
	    {	      $this->setError(__ERROR_BROWSER_NO_FREE_SPACE);
	    }
	    else
	    {
	      $ftp->makeDir($this->Path.MF::makeLinkname($_POST[__CFG_FLMGR_POST_FOLDER]));
	      MF::processed();
	    }
	  }
	  elseif(!MF::isEmptyArr($_FILES[__CFG_FLMGR_POST_FILE]) && $_POST[__CFG_FLMGR_POST_ACTION] == __CFG_FLMGR_ACT_ADD)
	  {
	    $this->uploadFile($ftp);
	    if($this->ErrorFlag == __FALSE)
	    {
	      MF::processed();
	    }
	  }
	  elseif(!MF::isBlank($_POST[__CFG_FLMGR_POST_FOLDER]) && $_POST[__CFG_FLMGR_POST_ACTION] == __CFG_FLMGR_ACT_DEL_FILE)
	  {
	    $ftp->deleteFile($_POST[__CFG_FLMGR_POST_FOLDER]);
	    MF::processed();
	  }
	  elseif(!MF::isBlank($_POST[__CFG_FLMGR_POST_FOLDER]) && $_POST[__CFG_FLMGR_POST_ACTION] == __CFG_FLMGR_ACT_DEL_FOLDER)
	  {
	    $ftp->deleteDirWithContents($_POST[__CFG_FLMGR_POST_FOLDER]);
	    MF::processed();
	  }
	}

	$this->setPathMap();
	$this->setFolderMap();
  }
}

?>