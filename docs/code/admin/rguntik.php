<?php
if($farr['type'] == 'files')
{
    require_once __CFG_PATH_LIBS.__CFG_PATH_CORE."file.inc";
    if($_FILES[$field]['name'])
    {
        $uploudArray = array(
            'ext' => $CONFIG['approvedExtension'],
            'maxSize' => $CONFIG['maxSizeUploadFile'],
            'inputName' => $field,
            'filenameLength' => $farr['StoreFilePath']['filenameLength'],
            'storePath' => $farr['storePath'],
            'filePathFolderSymbol' => $farr['StoreFilePath']['filePathFolderSymbol'],
            'filePathFolderCount' => $farr['StoreFilePath']['filePathFolderCount'],
            'count' => $farr['count'],
            'relationTable' =>$farr['relationTable'],
        );

        $farr['addVariable'] = uploadAdminFile($uploudArray, $farr['FTP']);
    }
}
?>