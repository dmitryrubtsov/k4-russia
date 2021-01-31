<?php

function uploadFormFile($configArray, &$errorsArray)
{
    global $_SQL_TABLE, $CONFIG, $language;
    require_once __CFG_PATH_LIBS . "xx/class.FTPAgent.php";
    $FTPAgent = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);

    $inputName = $configArray['inputName'];

    preg_match('/\.[\w\d]{2,4}$/s', $_FILES[$inputName]['name'], $matches);

    $expansion = $matches[0];
    $expansions = explode(',', $configArray['ext']);
    if(!in_array(substr($expansion, 1), $expansions))
    {
        $errorsArray[$inputName] = $language['site']['unauthorizedFileExtension'];
        return false;
    }

    if($configArray['maxSize'] <= $_FILES[$inputName]['size'])
    {
        $errorsArray[$inputName] = $language['site']['exceededTheAllowedFileSize'];
        return false;
    }

    $fileName = strtolower(generate_password(12));
    $folders_neme = 'upl/file';

    $n =0;
    for($i = 0; $i < 4; $i++)
    {
        $folders_neme .= "/".substr($fileName, $n, 2);
        $n += 2;
    }
    $FTPAgent->makeDir($folders_neme);
    $FTPAgent->uploadFile($folders_neme.'/'.$fileName.$expansion, $_FILES[$inputName]['tmp_name']);

    $query_array = array(
        'path' => $folders_neme.'/'.$fileName.$expansion,
        'file_name' => $_FILES[$inputName]['name'],
        'size' => $_FILES[$inputName]['size'],

    );
    makeInsertList($strColumns, $strValues, $query_array, array());
    $file_id = insertItem($_SQL_TABLE['file'], $strColumns, $strValues);

    return array('id' => $file_id, 'name' => $_FILES[$inputName]['name'], 'path' => $folders_neme.'/'.$fileName.$expansion);
}
function uploadAdminFile($configArray, $ftpParam)
{
    global $_SQL_TABLE, $CONFIG, $language, $ErrorMessages, $ErrorFlag ;
    require_once __CFG_PATH_LIBS . "xx/class.FTPAgent.php";
    $FTPAgent = new FTPAgent($ftpParam['ftpServer'], $ftpParam['ftpUserName'], $ftpParam['ftpPassword'], $ftpParam['ftpRootPath']);

    $inputName = $configArray['inputName'];
    $file_ids = array();

    $countUploadFiles = count($_FILES[$inputName]['name']);
    $where = array($configArray['relationTable']['keyField'].' = "'.$configArray['relationTable']['keyFieldValue'].'"');
    $countFiles = count(getTableAsArray($configArray['relationTable']['name'], $order='', $where));
    $countForUpload = $configArray['count'] - $countFiles;
    $upladimg = 0;
    foreach($_FILES[$inputName]['name'] AS $filesArrayKey => $filesArrayVal)
    {
        if($upladimg < $countForUpload)
        {
            preg_match('/\.[\w\d]{2,4}$/s', $_FILES[$inputName]['name'][$filesArrayKey], $matches);
            $expansion = $matches[0];
            $expansions = explode(',', $configArray['ext']);
            if(!in_array(substr($expansion, 1), $expansions))
            {
                $ErrorFlag = __TRUE;
                $ErrorMessages[] = $language['errors']['unauthorizedFileExtension'];
                return false;
            }
            if($configArray['maxSize'] <= $_FILES[$inputName]['size'][$filesArrayKey])
            {
                $ErrorFlag = __TRUE;
                $ErrorMessages[] = $language['errors']['fileExceedsTheAllowedSize'];
                return false;
            }


            $fileName = strtolower(generate_password($configArray['filenameLength']));

            $folders_neme = $configArray['storePath'];

            $n =0;
            for($i = 0; $i < $configArray['filePathFolderCount']; $i++)
            {
                $folders_neme .= "/".substr($fileName, $n, $configArray['filePathFolderSymbol']);
                $n += $configArray['filePathFolderSymbol'];
            }

            $FTPAgent->makeDir($folders_neme);
            $FTPAgent->uploadFile($folders_neme.'/'.$fileName.$expansion, $_FILES[$inputName]['tmp_name'][$filesArrayKey]);

            $query_array = array(
                'path' => $folders_neme.'/'.$fileName.$expansion,
                'file_name' => $_FILES[$inputName]['name'][$filesArrayKey],
                'size' => $_FILES[$inputName]['size'][$filesArrayKey],

            );
            makeInsertList($strColumns, $strValues, $query_array, array());
            $file_ids[] = insertItem($_SQL_TABLE['file'], $strColumns, $strValues);
        }
        else
        {
            if(!$ErrorFlag == __TRUE)
            {
                $ErrorFlag = __TRUE;
                $ErrorMessages[] = $language['errors']['uploadFilesLimit'];
            }
        }
        $upladimg++;
    }
    return $file_ids;
}


function uploadFile($filevarname, &$destination, &$filename, $FTPFlag=__FALSE)
{
    global $CONFIG, $ERRORS;
    if(trim($_FILES[$filevarname]['tmp_name']) != '')
    {
        makeDir($destination, $FTPFlag);
        if(isBlank($filename))
        {
            $filename = $_FILES[$filevarname]['name'];
        }
        if($_FILES[$filevarname]['error'] == 0)
        {
            if($_FILES[$filevarname]['size'] <= $CONFIG['FileMaxSize'])
            {
                copy($_FILES[$filevarname]['tmp_name'], $destination.$filename);
                if(!copy($_FILES[$filevarname]['tmp_name'], $destination.$filename))
                {
                    chmod($destination.$filename, 0777);
                    $msg = "<script language='javascript'>alert('".$ERRORS['admin'][__ERROR_WRONG_UPLOAD_FILE]." ".$destination."');</script>";
                    echo $msg;
                }
            }
            else
            {
                $msg = "<script language='javascript'>alert('".$ERRORS['admin'][__ERROR_WRONG_FILE_SIZE]."');</script>";
                echo $msg;
            }
        }
        else
        {
            $msg = "<script language='javascript'>alert('".$ERRORS['admin'][__ERROR_SOME_ERRORS_WITH_FILE]."');</script>";
            echo $msg;
        }
    }
}

function getFileMode($path)
{
    $Mode = decoct(fileperms($path));
    $Mode = substr($Mode, (strlen($Mode)-4), strlen($Mode));
    return $Mode;
}

function makeDir($dir, $FTPFlag=__FALSE)
{
    $GlobPath = '';
    if($FTPFlag == __TRUE)
    {
        $conn_id = ftp_connect(__CFG_PTF_HOSTNAME);
        $login_result = ftp_login($conn_id, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD);

        $fulldir = $dir;
        $dir = strstr($dir, __CFG_PTF_CORE_PATH);
        $GlobPath = str_replace($dir, '', $fulldir);
    }
    $dirs = explode('/', $dir);
    foreach($dirs as $n => $curr_dir)
    {
        $path = $GlobPath;
        foreach($dirs as $m => $cdir)
        {
            if($m == $n)
            {
                break;
            }
            $path.= $cdir."/";
        }
        $path.= $curr_dir;
        if(!isBlank($path) && !is_dir($path))
        {
            if($FTPFlag == __TRUE)
            {
                $ftppath = str_replace($GlobPath, '', $path);
                ftp_mkdir($conn_id, $ftppath);
                $chmod_cmd="CHMOD 0777 ".$ftppath;
                ftp_site($conn_id, $chmod_cmd);
            }
            else
            {
                mkdir($path, 0777);
                chmod($path, 0777);
            }
        }
    }
    if($FTPFlag == __TRUE)
    {
        ftp_close($conn_id);
    }
}

/*
function makeDir($dir)
{
  $dirs = explode('/', $dir);
  foreach($dirs as $n => $curr_dir)
  {
    $prevPath = $path;
    $prevMode = $Mode;
    $path = "";
    foreach($dirs as $m => $cdir)
    {
      if($m == $n)
      {
        break;
      }
      $path.= $cdir."/";
    }
    $path.= $curr_dir;
    if(!isBlank($path))
    {
      if(!is_dir($path))
      {
        mkdir($path);
      }
      $Mode = getFileMode($path);
      chmod($path, 0775);
    }
    if(!isBlank($prevPath))
    {
      chmod($prevPath, $prevMode);
    }
  }
  if(!isBlank($path))
  {
    chmod($path, $Mode);
  }
}
*/

function isFilePresent($dir, $filename, $filetype='')
{
    global $CONFIG;
    if($filetype == 'dir')
    {
        return is_dir($dir.$filename);
    }
    else
    {
        return is_file($dir.$filename.($filetype!=""?$filetype:$CONFIG['imFileType']));
    }
}

function renameFile($dir, $oldfilename, $newfilename, $filetype='')
{
    global $CONFIG;
    if(isFilePresent($dir, $oldfilename, $filetype))
    {
        if($filetype == "")
        {
            $filetype = $CONFIG['imFileType'];
        }
        elseif($filetype == 'dir')
        {
            $filetype = "";
            $oldfilename = str_replace('/','',$oldfilename);
            $newfilename = str_replace('/','',$newfilename);
        }
        return rename($dir.$oldfilename.$filetype, $dir.$newfilename.$filetype);
    }
    else return false;
}

function deleteFile($dir, $filename, $filetype='')
{
    global $CONFIG;
    if(isFilePresent($dir, $filename, $filetype))
    {
        if($filetype == "")
        {
            $filetype = $CONFIG['imFileType'];
        }
        elseif($filetype == 'dir')
        {
            $filetype = "";
        }
        return unlink($dir.$filename.$filetype);
    }
}

function getListOfFiles($dir)
{
    $dp = opendir($dir);
    $oldDir = getcwd();
    chdir($dir);
    while($currentFile !== false)
    {
        $currentFile = readDir($dp);
        $theFiles[] = $currentFile;
    }
    chdir($oldDir);
    return $theFiles;
}

function writeFile($content, $dir, $filename, $mode='1')
{
    if(!$handle = fopen($dir.$filename, 'w+'))
    {
        if($mode == 1)
        {
            echo "Cannot open file ($filename)";
            exit;
        }
        else
        {
            return false;
        }
    }

    if(fwrite($handle, $content) === FALSE)
    {
        if($mode == 1)
        {
            echo "Cannot write to file ($filename)";
            exit;
        }
        else
        {
            return false;
        }
    }

    fclose($handle);
    if($mode == 2)
    {
        return true;
    }
}

?>