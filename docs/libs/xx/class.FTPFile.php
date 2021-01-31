<?php

	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPAgent.php";
	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.MainFunc.php";
	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.ImageScaler.php";

	MainFunc::setParams();

	class FTPFile extends FTPAgent
	{
		public function uploadFile($tmpFileArr, $Destination)
		{
			$args = func_get_args();

			$maxFileSize = intval($args[2]);
			if(!MainFunc::isBlank($tmpFileArr['tmp_name']))
			{
				$LocalFile = $tmpFileArr['tmp_name'];
				$this->makeDir(dirname($Destination));
				if($tmpFileArr['error'] == 0)
				{
					if(!$maxFileSize)
					{
						$maxFileSize = MainFunc::$Config['imFileMaxSize'];
					}
					if($tmpFileArr['size'] <= $maxFileSize)
					{
						$result = parent::uploadFile($Destination, $LocalFile);
						if(!$result)
						{
							$this->addErrorMessage(MainFunc::$ERRORS['admin'][__ERROR_WRONG_UPLOAD_FILE]." ".$Destination);
							return false;
						}
					}
					else
					{
						$this->addErrorMessage(MainFunc::$ERRORS['admin'][__ERROR_WRONG_FILE_SIZE]);
						return false;
					}
				}
				else
				{
					$this->addErrorMessage(MainFunc::$ERRORS['admin'][__ERROR_SOME_ERRORS_WITH_FILE]);
					return false;
				}
			}
			return $Destination;
		}

		public function uploadFileHandler($FieldName, $FieldArray, $FilesArr, $sizetype)  //todo
		{
			if(isset($FilesArr[$FieldName]) && is_array($FilesArr[$FieldName]) && $FilesArr[$FieldName]['size'] > 0)
			{
				$fileType = strtolower($this->getFileType($FilesArr[$FieldName]['name']));
				if(!is_array($FieldArray['filetype']))
				{
					$fileTypes = explode(',', $FieldArray['filetype']);
				}
				else
				{
					$fileTypes = $FieldArray['filetype'];
				}

				if(!in_array($fileType, $fileTypes))
				{
					$this->addErrorMessage(MainFunc::$ERRORS['admin'][__ERROR_SOME_ERRORS_WITH_FILE]);
					return false;
				}

				if($FieldArray['currentValue'])
				{
					if(is_numeric($FieldArray['currentValue']))
					{
						$this->deleteRowAndFileById($FieldName, $FieldArray);
					}
					else
					{
						$this->deleteFile($FieldArray['currentValue']);
					}
				}

				if(isset($FieldArray['sizes'][$sizetype]['folderName']))
				{
					$Folder = $FieldArray['sizes'][$sizetype]['folderName'];
					$filePath = $this->makeFilePath($FieldArray, $Folder);
				}

				$maxFileSize = (isset($FieldArray['fileSize'])) ? intval($FieldArray['fileSize']) : null;

				$imageParams = array();
				if(isset($FieldArray['sizes'][$sizetype]['handler']))
				{
					$realPath = realpath(dirname(__FILE__));
					$smallImage = new ImageScaler($FilesArr[$FieldName]['tmp_name']);
					$smallImage->resize($FieldArray['sizes'][$sizetype]['width'], $FieldArray['sizesInfo'][$sizetype]['height'], $FieldArray['sizes'][$sizetype]['handler']);
					$smallImage->save(dirname($FilesArr[$FieldName]['tmp_name']).'/test'.$fileType);
					$result = parent::uploadFile($filePath.$fileType, dirname($FilesArr[$FieldName]['tmp_name']).'/test'.$fileType);
					unlink(dirname($FilesArr[$FieldName]['tmp_name']).'/test'.$fileType);

					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldWidth']] = $smallImage->smallWidth;
					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldHeight']] = $smallImage->smallHeight;
					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldPath']] = $filePath.$fileType;
				}
				else
				{
					$imageInfo = getimagesize($FilesArr[$FieldName]['tmp_name']);
					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldWidth']] = $imageInfo[0];
					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldHeight']] = $imageInfo[1];
					$imageParams[$FieldArray['sizes'][$sizetype]['tableFieldPath']] = $this->uploadFile($FilesArr[$FieldName], $filePath.$fileType, $maxFileSize);
				}
				return $imageParams;
			}
		}

		public function editItemFieldHandler($FieldName, $FieldArray, $FilesArr)
		{
			return $this->uploadFileHandler($FieldName, $FieldArray, $FilesArr);
		}

		public function addFieldHandler($FieldName, $FieldArray, $FilesArr)
		{
			return $this->uploadFileHandler($FieldName, $FieldArray, $FilesArr);
		}

		public function makeFilePath($FieldArray, $sizefolder)
		{
			global $CONFIG;

			$folderCount = (isset($FieldArray['StoreFilePath']['filePathFolderCount'])) ? intval($FieldArray['StoreFilePath']['filePathFolderCount']) : $CONFIG['filePathFolderCount'];
			$folderSymbol = (isset($FieldArray['StoreFilePath']['filePathFolderSymbol'])) ? intval($FieldArray['StoreFilePath']['filePathFolderSymbol']) : $CONFIG['filePathFolderSymbol'];

			$storeFolder = (isset($FieldArray['storeFolder'])) ? $FieldArray['storeFolder'] : $FieldArray['type'];

			$filePath = $CONFIG['uploadFolder'].$storeFolder.'/'.$sizefolder;
            //$filePath = $FieldArray['storePath'].$sizefolder;
			$fileName = MainFunc::generate_password($FieldArray['filenameLength'], $FieldArray['filenameSymbols']);

			$n =0;
			for($i = 0; $i < $folderCount; $i++)
			{
				$filePath .= "/".substr($fileName, $n, $folderSymbol);
				$n = $n + 2;
			}
			$filePath .= '/'.$fileName;

			return $filePath;
		}

		public function deleteRowAndFileById($FieldName, $FieldArray)
		{
			global $CONFIG, $_SQL_TABLE, $WorkTable, $WorkTableKeyFieldName;

			if(is_array($FieldArray['sizesInfo']))
			{
				//$delFieldsArray = array();
				foreach($FieldArray['sizesInfo'] as $sizetype => $sizeparams)
				{
					//print_r($sizeparams['tableFieldPath']." ".$WorkTable." ".$WorkTableKeyFieldName." ".$FieldArray['currentValue']);
					$delField = getFieldByEnother($sizeparams['tableFieldPath'], $FieldArray['storeTable']['tableInfoName'], $FieldArray['storeTable']['keyField'], $FieldArray['currentValue']);
                    $this->deleteFile($delField);
				}
			}

			delRow($FieldArray['storeTable']['tableName'], $FieldArray['storeTable']['keyField'], $FieldArray['currentValue']);
			delRow($FieldArray['storeTable']['tableInfoName'], $FieldArray['storeTable']['keyField'], $FieldArray['currentValue']);

			$updateWorkTable = array(
				$FieldName => 0,
			);
			makeUpdateList($strSet, $updateWorkTable, array(), array());
			updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
		}

	}


?>