<?php

function convertFoldersToList($Folders, $KeyField='id', $ValueField='title', $CurrTab='', $Tab='&nbsp;-&nbsp;')
{

  foreach($Folders as $n => $folder)
  {
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
  {
    $FolderPath[] = $Folder;
  }

  if(isBlank($PathField))
  {
    return array_reverse($FolderPath);
  }
  else
  {
    foreach($FolderPath as $n => $arr)
    {
    }
    return array_reverse($Path);
  }
}

?>