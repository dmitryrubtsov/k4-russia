<?php

function uploadImage($imvarname, $destination, $imname, $xsize, $ysize, $noResize='', $FTPFlag=__FALSE)
{
  global $CONFIG, $ERRORS;
  if(trim($_FILES[$imvarname]['tmp_name']) != '')
  {
  	require_once __CFG_PATH_LIBS_ADMIN.__CFG_PATH_CORE."file.inc";
  	makeDir($destination, $FTPFlag);
  	if($_FILES[$imvarname]['error'] == 0)
  	{
  	  if($_FILES[$imvarname]['size'] <= $CONFIG['imFileMaxSize'])
  	  {
  	    if(isBlank($xsize) || isBlank($ysize) || $noResize == 'y')
  	    {
  	      $result = copy($_FILES[$imvarname]['tmp_name'], $destination.$imname);
  	      if(!$result)
  	      {
  	        $msg = "<script language='javascript'>alert('".$ERRORS[__ERROR_WRONG_UPLOAD_IMAGE]." ".$destination."');</script>";
  	        echo $msg;
  	      }
  	    }
  	    else
  	    {  	       $dest = resizeImage($_FILES[$imvarname]['tmp_name'], $xsize, $ysize, $destination.$imname);
  	       if(!is_file($dest))
  	       {  	       	 $msg = "<script language='javascript'>alert('".$ERRORS[__ERROR_WRONG_UPLOAD_IMAGE]." ".$destination."');</script>";
  	         echo $msg;
  	       }
  	    }
  	  }
  	  else
  	  {  	  	$msg = "<script language='javascript'>alert('".$ERRORS[__ERROR_WRONG_IMAGE_SIZE]."');</script>";
  	    echo $msg;
  	  }
  	}
  	else
  	{  	  $msg = "<script language='javascript'>alert('".$ERRORS[__ERROR_SOME_ERRORS_WITH_IMAGE]."');</script>";
  	  echo $msg;
  	}
  }
}

function resizeImage($source, $xsize, $ysize, $destination)
{
  global $CONFIG;

  $imInfo = getimagesize($source);
  $ImType = str_replace('image/', '', $imInfo['mime']);
  eval('$im = imagecreatefrom'.$ImType.'($source);');
  /*$imm = imagecreatetruecolor($xsize, $ysize);
  $transCol = imagecolorallocate($imm, 0, 0, 0);
  imagecolortransparent($imm, $transCol);
  imagecolordeallocate ( $imm, $transCol );*/

  $imm = imagecreate($xsize, $ysize);
  imagecopyresampled($imm, $im, 0, 0, 0, 0, $xsize, $ysize, $imInfo[0], $imInfo[1]);
  eval('image'.$ImType.'($imm, $destination);');
  ImageDestroy($im);
  ImageDestroy($imm);
  return $destination;
}

function getNextImageIndex($filename, $dirName, $fileType)
{  global $CONFIG;

  if(isBlank($fileType))
  {    $fileType = $CONFIG['imFileType'];
  }
  require_once __CFG_PATH_LIBS_ADMIN.__CFG_PATH_CORE."file.inc";
  $theFiles = getListOfFiles($dirName);
  $imageFiles = preg_grep("/^".$filename."_[\d]+".$fileType."$/", $theFiles);
  $max = 0;
  foreach($imageFiles as $n => $val)
  {    preg_match("/^".$filename."_([\d]+)".$fileType."$/s", $val, $matches);
    $max = max($max, intval($matches[1]));
  }
  $max++;
  return $max;
}

function renameImage($dir_new, $oldfilename, $newfilename, $filetype='', $dir_old='', $FTPFlag=__FALSE)
{
  global $CONFIG;
  require_once __CFG_PATH_LIBS_ADMIN.__CFG_PATH_CORE."file.inc";
  if(isBlank($dir_old))
  {    $dir_old = $dir_new;
  }
  makeDir($dir_new, $FTPFlag);
  if($dir_new != $dir_old || $oldfilename != $newfilename)
  {
    if(isFilePresent($dir_old, $oldfilename, $filetype))
    {
      return rename($dir_old.$oldfilename.($filetype!=""?$filetype:$CONFIG[imFileType]), $dir_new.$newfilename.($filetype != "" ? $filetype : $CONFIG[imFileType]));
    }
    else
    {
      $theFiles = getListOfFiles($dir_old);
      $imageFiles = preg_grep("/^".$oldfilename."_[\d]+".($filetype!=""?$filetype:$CONFIG[imFileType])."$/", $theFiles);
      foreach($imageFiles as $n => $val)
      {        rename($dir_old.$val, $dir_new.str_replace($oldfilename,$newfilename,$val));
      }
    }
  }
}

?>