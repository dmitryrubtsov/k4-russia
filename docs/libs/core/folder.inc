<?php

function convertFoldersToList($Folders, $KeyField='id', $ValueField='title', $CurrTab='', $Tab='&nbsp;-&nbsp;')
{  global $CONFIG;

  foreach($Folders as $n => $folder)
  {    $FolderList[$folder[$KeyField]] = $CurrTab.$folder[$ValueField];
    if(!isEmptyArr($folder['folders']))
    {
      $FolderList = $FolderList + convertFoldersToList($folder['folders'], $KeyField, $ValueField, $CurrTab.$Tab, $Tab);
    }
  }
  return $FolderList;
}

function makePathFromFolders($FolderTable, $KeyField='id', $RootField='root', $FolderKeyValue=0, $PathField='', $slashFlag='')
{
  global $CONFIG;

  $Folder = getRowByField($FolderTable, $KeyField, $FolderKeyValue);
  $FolderPath[] = $Folder;

  while($Folder[$RootField] != 0)
  {    $Folder = getRowByField($FolderTable, $KeyField, $Folder[$RootField]);
    $FolderPath[] = $Folder;
  }

  if(isBlank($PathField))
  {
    return array_reverse($FolderPath);
  }
  else
  {    $Path = array();
    foreach($FolderPath as $n => $arr)
    {      $Path[] = $arr[$PathField].((!isBlank($slashFlag)) ? '/' : '');
    }
    return array_reverse($Path);
  }
}

?>