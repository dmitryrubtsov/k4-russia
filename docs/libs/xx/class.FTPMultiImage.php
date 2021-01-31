<?php

	require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPImage.php";

	class FTPMultiImage extends FTPImage
	{
		public function editItemFieldHandler($FieldName, $FieldArray, $FilesArr)
		{
			return $this->uploadImageHandler($FieldName, $FieldArray, $FilesArr);
		}

		public function addFieldHandler($FieldName, $FieldArray, $FilesArr)
		{
			return $this->uploadImageHandler($FieldName, $FieldArray, $FilesArr);
		}

		public function uploadImageHandler($FieldName, $FieldArray, $FilesArr)
		{
			global $CONFIG, $_SQL_TABLE;

			if(is_array($FieldArray['sizes']))
			{
				$imageArray = array();
				foreach($FieldArray['sizes'] as $sizetype => $sizeparams)
				{
					if(is_array($sizeparams))
					{
						$imageArray[$sizetype] = $this->uploadFileHandler($FieldName, $FieldArray, $FilesArr, $sizetype);
					}
				}
			}

			if(count($imageArray) && is_array($FieldArray['storeTable']) && isset($FieldArray['storeTable']['keyField']))
			{
				$listArray = array(
					$FieldArray['storeTable']['keyField'] => '',
					'position' => 1,
					'active' => 1,
					'date' => 'UNIX_TIMESTAMP()',
				);
				makeInsertList($strColumns, $strValues, $listArray, array('date'));
				insertItem($FieldArray['storeTable']['tableName'], $strColumns, $strValues);
                $imageId = mysql_insert_id();

                $listArrayInfo = array(
					$FieldArray['storeTable']['keyField'] => $imageId,
				);
				foreach($imageArray as $sizetype => $sizeparams)
				{
					foreach($sizeparams as $fieldName => $fieldValue)
					{
						$listArrayInfo[$fieldName] = isset($fieldValue) ? $fieldValue : '';
					}
				}

				makeInsertList($strColumns, $strValues, $listArrayInfo, array());
				insertItem($FieldArray['storeTable']['tableInfoName'], $strColumns, $strValues);
			}
		   return $imageId;
		}
	}


?>