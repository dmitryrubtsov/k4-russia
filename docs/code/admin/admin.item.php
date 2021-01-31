<?php

	if($_POST['act'] == 'edititem')
	{
		$ItemCurrent = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
		$MySQLFuncColumns = array();
		$BreakColumns = array();
		$subTableBreakColumns = array();
	  	$subTables = array();
	  	$result = array();

		foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr)
		{
			$farr['currentValue'] = $ItemCurrent[$field];

            include "rguntik.php";

            if($farr['type'] == 'download_files')
            {
                if($farr['useFTP'] == 'y')
                {
                    require_once __CFG_PATH_LIBS.__CFG_PATH_CORE."file.inc";
                    if($_FILES[$field]['name'])
                    {
                        $uploudArray = array(
                            'ext' => $CONFIG['approvedExtension'],
                            'maxSize' => $CONFIG['maxSizeUploadFile'],
                            'inputName' => $field,
                        );

                        //$farr['addVariable'] = uploadAdminFile($uploudArray);

                    }

                    if(!$farr['addVariable'])
                    {
                        $BreakColumns[] = $field;
                    }

                }
                $BreakColumns[] = $field;
            }
			if($farr['type'] == 'image')
			{
				if($farr['useFTP'] == 'y')
				{
					require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPMultiImage.php";
					$ftpmi = new FTPMultiImage($farr['FTP']['ftpServer'], $farr['FTP']['ftpUserName'], $farr['FTP']['ftpPassword'], $farr['FTP']['ftpRootPath']);

					if($_FILES[$field]['name'])
					{
						$farr['addVariable'] = $ftpmi->editItemFieldHandler($field, $farr, $_FILES);
					}

					if($ftpmi->hasErrors())
					{
						$ErrorFlag = __TRUE;
						$ErrorMessages = array_merge($ErrorMessages, $ftpmi->getErrorMessages());
					}
					if(!$farr['addVariable'])
					{
						$BreakColumns[] = $field;
					}
				}
			}
            if($farr['type'] == 'multi_image')
            {
                if($farr['count'] && (int)$farr['count'] < ((int)$count_images_db['count'] + (int)count($_FILES[$field]['name'])))
                {
                    $count_images_db = getSomeFieldsByField($farr['relationTable']['name'], $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName],"COUNT(".$WorkTableKeyFieldName.") as count");

                    $ErrorFlag = __TRUE;
                    $ErrorMessages[] = $language["errors"]["theMaximumCountOfPictures"]." ".$farr['count'];
                }
                else
                {
                    require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPMultiImage.php";
                    $ftpmi = new FTPMultiImage($farr['FTP']['ftpServer'], $farr['FTP']['ftpUserName'], $farr['FTP']['ftpPassword'], $farr['FTP']['ftpRootPath']);


                    if($_FILES[$field]['name'][0])
                    {
                        foreach ($_FILES[$field]['name'] as $key => $file) {
                            $OneFile = array( $field => array(
                                'name' => $_FILES[$field]['name'][$key],
                                'type' => $_FILES[$field]['type'][$key],
                                'tmp_name' => $_FILES[$field]['tmp_name'][$key],
                                'error' => $_FILES[$field]['error'][$key],
                                'size' => $_FILES[$field]['size'][$key],

                            ));
                            $IdsFiles .= $ftpmi->editItemFieldHandler($field, $farr, $OneFile).", ";
                        }
                        $farr['addVariable'] = substr($IdsFiles, 0, strlen($IdsFiles)-2);
                    }

                    if($ftpmi->hasErrors())
                    {
                        $ErrorFlag = __TRUE;
                        $ErrorMessages = array_merge($ErrorMessages, $ftpmi->getErrorMessages());
                    }
                    if(!$farr['addVariable'])
                    {
                        $BreakColumns[] = $field;
                    }
                }

            }
			if($farr['type'] == 'filenew')
			{
				if($farr['useFTP'] == 'y')
				{
					require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPImage.php";
					$ftpi = new FTPImage($farr['ftpServer'], $farr['ftpUserName'], $farr['ftpPassword'], $farr['ftpRootPath']);

					$farr['addVariable'] = $ftpi->editItemFieldHandler($field, $farr, $_FILES);
					if($ftpi->hasErrors())
					{
						$ErrorFlag = __TRUE;
						$ErrorMessages = array_merge($ErrorMessages, $ftpi->getErrorMessages());
					}
					if(!$farr['addVariable'])
					{
						$BreakColumns[] = $field;
					}
				}
			}

			if(!isBlank($farr['required']) && !preg_match("/^".$farr['required']."$/Uis", $farr['addVariable']) && !preg_match("/^".$farr['required']."$/Uis", $farr['editVariable']) && !strstr($farr['editFormOther'],'disabled'))
			{
				$ErrorFlag = __TRUE;
				$ErrorMessage = $language["errors"][__ERROR_INCORRECT_REQUIRED_FIELDS];
				$repl_arr = array('field' => $farr['title']);
				replaceVariables($repl_arr, $ErrorMessage);
				$ErrorMessages[] = $ErrorMessage;
			}
			elseif(!isBlank($farr['notEmptyRequired']) && !preg_match("/^".$farr['notEmptyRequired']."$/Uis", $farr['addVariable']) && !isBlank($farr['addVariable'])  || !preg_match("/^".$farr['notEmptyRequired']."$/Uis", $farr['editVariable']) && !strstr($farr['editFormOther'],'disabled') && !isBlank($farr['editVariable']))
			{
				$ErrorFlag = __TRUE;
				$ErrorMessage = $language["errors"][__ERROR_INCORRECT_REQUIRED_FIELDS];
				$repl_arr = array('field' => $farr['title']);
				replaceVariables($repl_arr, $ErrorMessage);
				$ErrorMessages[] = $ErrorMessage;
			}


			if(isBlank($farr['noUseInEdit']) && !isBlank($farr['editVariable']) && isBlank($farr['listOfRelations']) && isBlank($farr['isRelation']))
			{
				$result[$field] = $farr['editVariable'];
				if($farr['editVarType'] == $CONFIG['VarTypeSQLFunction'])
				{
					$MySQLFuncColumns[] = $field;
				}
			}
            elseif(isBlank($farr['noUseInEdit']) && !isset($farr['editVariable']) && !isBlank($farr['addVariable']) && isBlank($farr['listOfRelations']) && isBlank($farr['isRelation']))
			{
				$result[$field] = $farr['addVariable'];
				if($farr['addVarType'] == $CONFIG['VarTypeSQLFunction'])
				{
					$MySQLFuncColumns[] = $field;
				}
			}
			elseif(isBlank($farr['noUseInEdit']) && isBlank($farr['editVariable']) && isBlank($farr['addVariable']) /*&& $farr['allowEmpty'] == 'y'*/ && isBlank($farr['listOfRelations']) && isBlank($farr['isRelation']) && !strstr($farr['editFormOther'],'disabled'))
			{
				$result[$field] = $farr['addVariable'];
			}
			elseif($farr['listOfRelations'] == 'y' && isBlank($farr['noUseInEdit']) && isBlank($farr['isRelation']))
			{


                if($farr['type'] == 'relation_field' || $farr['type'] == 'download_files' || $farr['type'] == 'multi_image')
                {
                    if(!isBlank($farr['editVariable']))
                    {
                        $farr['editVariable'] = explode(',', $farr['editVariable']);
                    }
                    if(!isBlank($farr['addVariable']))
                    {
                        $farr['addVariable'] = explode(',', $farr['addVariable']);
                    }
                }

				$relationType = @$farr['relationType'];

				switch($relationType)
				{
					case 'idsOnly' : makeListOfRelationsIdsOnly($farr['relationTable'], ((!isBlank($farr['editVariable'])) ? $farr['editVariable'] : $farr['addVariable']));
							break;
					case 'idOne' : makeListOfRelationsIdOne($farr['relationTable'], ((!isBlank($farr['editVariable'])) ? $farr['editVariable'] : $farr['addVariable']));
							break;
                    case 'idsOnlyAdd' : makeListOfRelationsIdsOnlyAdd($farr['relationTable'], ((!isBlank($farr['editVariable'])) ? $farr['editVariable'] : $farr['addVariable']));
                        break;
					default : makeListOfRelations($farr['tableInfo'], ((!isBlank($farr['editVariable'])) ? $farr['editVariable'] : $farr['addVariable']));
				}


				$BreakColumns[] = $field;
			}
			elseif($farr['isRelation'] == 'y' && isBlank($farr['noUseInEdit']))
			{
				makeRelation($farr['tableInfo'], ((!isBlank($farr['editVariable'])) ? $farr['editVariable'] : $farr['addVariable']));
				$BreakColumns[] = $field;
			}

		    if($farr['notUsedInDB'] == 'y' || $farr['type'] == 'select_link')
		    {
				$BreakColumns[] = $field;
		    }
		    if($farr['md5'] == 'y' && strlen($result[$field]) != 32)
		    {
				$result[$field] = md5($result[$field]);
		    }


            if($farr['unique'] == 'y' && !strstr($farr['editFormOther'],'disabled'))
		    {
		    	if(is_array($farr['subTable']) && sizeof($farr['subTable']))
				{
					$SearchTable = $farr['subTable']['table'];
				}
				else
				{
					$SearchTable = $WorkTable;
				}
				if($result[$field])
				{
					$UniqueResult = getRowByField($SearchTable, $field, $result[$field]);
					if(stripslashes(trim($UniqueResult[$field])) == stripslashes(trim($result[$field])) && $UniqueResult[$WorkTableKeyFieldName] != $_REQUEST[$WorkTableKeyVarName])
					{
						$ErrorFlag = __TRUE;
						$repl_arr = array('field' => $farr['title']);
						$ErrorMessage = $language["errors"][__ERROR_DUPLICATED_FIELD_VALUE];
						replaceVariables($repl_arr, $ErrorMessage);
						$ErrorMessages[] = $ErrorMessage;
					}
				}
		    }

		    if(is_array($farr['subTable']) && sizeof($farr['subTable']))
			{
				$subTables[$field] = $farr;
				if(in_array($field, $BreakColumns))
				{
					$subTableBreakColumns[] = $field;
				}
				else
				{
					$BreakColumns[] = $field;
				}
			}

		}

		if($ErrorFlag != __TRUE)
		{

			if(is_callable($CONFIG['AdminAddFuncEditItem']))
			{
				$OldRow = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
			}

			makeUpdateList($strSet, $result, $MySQLFuncColumns, $BreakColumns);

			updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);

			$NewRow = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);

			if(is_callable($CONFIG['AdminAddFuncEditItem']))
			{
				call_user_func($CONFIG['AdminAddFuncEditItem']);
			}

			updateSubTables($subTables, $NewRow, $result);

			$linkPath = '?mode='.$listInfo['pmode'];
			foreach($listInfo['useInLink'] as $val)
			{
				if($val && $val != 'pmode' && $val != 'mode' && $listInfo[$val])
				{
					$linkPath .= '&'.$val.'='.$listInfo[$val];
				}
			}
			foreach($_GET as $k => $value)
			{
				if($listInfo['useInLink'][$k] != $k && $value && $k != $WorkTableKeyVarName && $k != 'pmode' && $k != 'mode')
				{
					$linkPath .= '&'.$k.'='.$value;
				}
			}

			if($_FLAGS['JVSCMessage'] == __TRUE)
			{
				go_toJVSC(getSameUri());
			}
			else
			{
				if($WorkTableKeyVarName == 'key_gallery_id' || $WorkTableKeyVarName == 'key_user_id')
				{
					go_to(getSameUri());
				}
				else
				{
					go_to($linkPath);
				}
			}
			exit();
		}

	  /*else
		{
	  		$tpl->assign('ErrorMessage', $ErrorMessage);
		}*/
	}
	elseif($_POST['act'] == 'status' || $_POST['act'] == 'editfield')
	{
		$varName = $_POST['varname'];
		$varValue = $_POST['varvalue'];

		$result = array(
  	       	$varName => ($varName == 'linkname') ? make_linkname($varValue) : $varValue,
  		);

		$farr = $_SQL_TABLE_FIELDS[$GlobPart][$varName];

		if(isset($farr['subTable']) && sizeof($farr['subTable']))
		{
			$subTables = array($varName => $farr);
			$Row = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
			updateSubTables($subTables, $Row, $result);
		}
		else
		{
			makeUpdateList($strSet, $result, array('date'));
  			updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $_POST[$WorkTableKeyVarName]);
		}

		go_to(getSameUri());
		exit();
	}
    elseif($_POST['act'] == 'deletefile')
    {
//        exit;
        $FieldArray = $_SQL_TABLE_FIELDS[$GlobPart][$_POST['fieldName']];

        if($FieldArray['useFTP'] == 'y')
        {
            require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPAgent.php";
            $ftp = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);
            $ftp->deleteFile($_POST['dirName']);
        }

        delRow($FieldArray['relationTable']['name'], $FieldArray['relationTable']['relatedField'], $_POST['imageId']);
        delRow($_SQL_TABLE['file'], 'file_id', $_POST['imageId']);

        go_to(getSameUri());
        exit();
    }
	elseif($_POST['act'] == 'deleteimage')
	{

		$ItemCurrent = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);

		$farr = $_SQL_TABLE_FIELDS[$GlobPart][$_POST['fieldName']];


		$imgInfoArray = getRowByField($_POST['tableInfoName'], $_POST['tableKeyField'], $_POST['imageId']);

		foreach($farr['sizesInfo'] as $type => $value)
		{
				require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPImage.php";
				$ftpi = new FTPImage($farr['FTP']['ftpServer'], $farr['FTP']['ftpUserName'], $farr['FTP']['ftpPassword'], $farr['FTP']['ftpRootPath']);
				$deleted = $ftpi->deleteFile($imgInfoArray[$value['tableFieldPath']]);
		}

		if(isset($farr['relationTable']) && sizeof($farr['relationTable']))
		{
			delRow($farr['relationTable']['name'], $farr['relationTable']['relatedField'], $_POST['imageId']);
		}
		else
		{
			$result = array(
				$_POST['fieldName'] => '',
			);
			makeUpdateList($strSet, $result, array('date'));
  			updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
		}

		delRow($farr['storeTable']['tableName'], $farr['storeTable']['keyField'], $_POST['imageId']);
		delRow($farr['storeTable']['tableInfoName'], $farr['storeTable']['keyField'], $_POST['imageId']);

		go_to(getSameUri());
		exit();
	}
	elseif(is_callable($CONFIG['ItemActionFuncPrefix'].$_POST['act']))
	{
		call_user_func($CONFIG['ItemActionFuncPrefix'].$_POST['act'], $_POST);
	}

	if(!isBlank($_GET[$CONFIG['AdminActionGetVar']]) && is_callable($CONFIG['ItemActionFuncPrefix'].$_GET[$CONFIG['AdminActionGetVar']]))
	{
		call_user_func($CONFIG['ItemActionFuncPrefix'].$_GET[$CONFIG['AdminActionGetVar']]);
	}

	if($_FLAGS['NoReadDB'] == __FALSE)
	{
		$Item = getRowByField($WorkTable, $WorkTableKeyFieldName, $_REQUEST[$WorkTableKeyVarName]);
    }

	if(is_callable($CONFIG['AdminAddFuncGetItem']))
	{
		call_user_func($CONFIG['AdminAddFuncGetItem']);
	}

	$subTables = getSubTablesFromTableFields($_SQL_TABLE_FIELDS[$GlobPart]);
	$imageArray = getImageFieldsFromTableFields($_SQL_TABLE_FIELDS[$GlobPart]);
    $fileArray = getFileFieldsFromTableFields($_SQL_TABLE_FIELDS[$GlobPart]);
	if(is_array($subTables) && sizeof($subTables))
	{
		$Item = addItemsFromSubTables($subTables, $Item);
	}

	if(is_array($imageArray) && sizeof($imageArray))
	{
		$Item = addItemImageArray($imageArray, $Item);
	}
//
    if(is_array($fileArray) && sizeof($fileArray))
    {
        $Item = addItemFileArray($fileArray, $Item);
    }

	if($ErrorFlag == __TRUE)
	{
		foreach($Item as $key => $val)
		{
			if(isset($_POST[$key]))
			{
				$Item[$key] = $_POST[$key];
			}
		}
	}

	$tpl->assign_by_ref("Item", $Item);

	eval('$PageTitle = '.$PageTitle);
	$tpl->assign("PageTitle", $PageTitle);

	$tpl->assign_by_ref("ConfFields", $_SQL_TABLE_FIELDS[$GlobPart]);

	$tpl->assign_by_ref("ConfEditForms", $_SQL_TABLE_EDIT_FORMS[$GlobPart]);
	$tpl->assign_by_ref("GlobPart", $GlobPart);

	if($_FLAGS['NotChangeItemTemplate'] != __TRUE)
	{
		$BodyTemplate = 'admin.body_item.tpl';
	}
	if(!isBlank($_GET['cntonly']))
	{
		$_FLAGS['ContentOnly'] = 'y';
		$PageTitle = '"";';
	}

	$tpl->assign("BodyTemplate", $BodyTemplate);

	//$Timer->stop($GlobPart);
	//$Timer->display();
	if($tpl->template_exists("admin.".$GlobPart.".tpl"))
	{
		//$_ADMIN_SMARTY_TEMPLATE = "admin.".$GlobPart.".tpl";
		$_BODY_SMARTY_TEMPLATE = "admin.".$GlobPart.".tpl";
	}
	else
	{
		//$_ADMIN_SMARTY_TEMPLATE = "admin.item.tpl";
		$_BODY_SMARTY_TEMPLATE = "admin.item.tpl";
	}

?>