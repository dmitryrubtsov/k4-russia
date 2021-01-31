<?php

//$Timer->start($_REQUEST[mode]);


if($_POST['act'] == 'addnew')
{
	$MySQLFuncColumns = array();
	$BreakColumns = array();
	$ImgFunc = array();
	$subTables = array();
	$valuesArr = array();
	foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr)
	{

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
                );

                $farr['addVariable'] = uploadAdminFile($uploudArray, $farr['FTP']);
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
		if($farr['type'] == 'image')
		{
			if($farr['useFTP'] == 'y')
			{
				require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPMultiImage.php";
				$ftpmi = new FTPMultiImage($farr['FTP']['ftpServer'], $farr['FTP']['ftpUserName'], $farr['FTP']['ftpPassword'], $farr['FTP']['ftpRootPath']);
				$farr['addVariable'] = $ftpmi->addFieldHandler($field, $farr, $_FILES);
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

				$farr['addVariable'] = $ftpi->addFieldHandler($field, $farr, $_FILES);
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

		if(!isBlank($farr['required']) && !preg_match("/^".$farr['required']."$/Uis", $farr['addVariable']))
		{
			$ErrorFlag = __TRUE;
			$ErrorMessage = $language["errors"][__ERROR_INCORRECT_REQUIRED_FIELDS];
			$repl_arr = array('field' => $farr['title']);
			replaceVariables($repl_arr, $ErrorMessage);
			$ErrorMessages[] = $ErrorMessage;
		}
		elseif(!isBlank($farr['notEmptyRequired']) && !preg_match("/^".$farr['notEmptyRequired']."$/Uis", $farr['addVariable']) && !isBlank($farr['addVariable']))
		{
			$ErrorFlag = __TRUE;
			$ErrorMessage = $language["errors"][__ERROR_INCORRECT_REQUIRED_FIELDS];
			$repl_arr = array('field' => $farr['title']);
			replaceVariables($repl_arr, $ErrorMessage);
			$ErrorMessages[] = $ErrorMessage;
		}
		if($farr['listOfRelations'] == 'y')
		{
			$_SQL_TABLE_FIELDS[$GlobPart][$field]['addVariable'] = $farr['addVariable'];
			$ListOfRelations[] = &$_SQL_TABLE_FIELDS[$GlobPart][$field];
			$BreakColumns[] = $field;
		}
		elseif($farr['isRelation'] == 'y')
		{
			$Relations[] = &$_SQL_TABLE_FIELDS[$GlobPart][$field];
			$BreakColumns[] = $field;
		}
		elseif(!isBlank($farr['addVariable']) && isBlank($farr['listOfRelations']))
		{
			$result[$field] = $farr['addVariable'];
			if($farr['addVarType'] == $CONFIG['VarTypeSQLFunction'])
			{
				$MySQLFuncColumns[] = $field;
			}
		}
		else
		{
			$BreakColumns[] = $field;
		}

		if($farr['notUsedInDB'] == 'y')
		{
			$BreakColumns[] = $field;
		}
		if($farr['md5'] == 'y' && strlen($result[$field]) != 32)
		{
			$result[$field] = md5($result[$field]);
		}
		if($farr['unique'] == 'y')
		{
			if(is_array($farr['subTable']) && sizeof($farr['subTable']))
			{
				$SearchTable = $farr['subTable']['table'];
			}
			else
			{
				$SearchTable = $WorkTable;
			}
			$UniqueResult = getFieldByEnother($field, $SearchTable, $field, $result[$field]);
			if(stripslashes(trim($UniqueResult)) == stripslashes(trim($result[$field])))
			{
				$ErrorFlag = __TRUE;
				$repl_arr = array('field' => $farr['title']);
				$ErrorMessage = $language["errors"][__ERROR_DUPLICATED_FIELD_VALUE];
				replaceVariables($repl_arr, $ErrorMessage);
				$ErrorMessages[] = $ErrorMessage;
			}
		}
		if(is_array($farr['subTable']) && sizeof($farr['subTable']))
		{
			$subTables[$field] = $farr;
			$BreakColumns[] = $field;
			$valuesArr[$field] = $result[$field];
			unset($result[$field]);
		}

		if(is_callable($CONFIG['AdminFuncNameValidateField'].str_replace("_", "", strCapitalizeAll($field))))
		{
			call_user_func($CONFIG['AdminFuncNameValidateField'].str_replace("_", "", strCapitalizeAll($field)), $_POST);
		}
	}

	if($ErrorFlag != __TRUE)
	{
		makeInsertList($strColumns, $strValues, $result, $MySQLFuncColumns, $BreakColumns);
		$InsID = insertItem($WorkTable, $strColumns, $strValues);
		if($_FLAGS['useImage'] == __TRUE)
		{
			if(!isEmptyArr($ImgFunc))
			{
				foreach($ImgFunc as $n => $func)
				{
					eval($func);
				}
			}
		}

		if($WorkTableKeyFieldName != 'id')
		{
			makeSearchList($strSet, $result, $MySQLFuncColumns, $BreakColumns);
			$newRow = getRowByStrSet($WorkTable, $strSet);
			$InsID = $newRow[$WorkTableKeyFieldName];
		}

		$NewRow = getRowByField($WorkTable, $WorkTableKeyFieldName, $InsID);

		if(is_callable($CONFIG['AdminAddFuncAddItem']))
		{
			call_user_func($CONFIG['AdminAddFuncAddItem']);
		}

		if($subTables)
        {
            insertSubTables($subTables, $NewRow, $valuesArr);
        }

		foreach($ListOfRelations as $n => $arr)
		{
			if($arr['type'] == 'relation_field' || $arr['type'] == 'multi_image')
			{
				$arr['addVariable'] = explode(',', $arr['addVariable']);
			}
			if(isBlank($arr['tableInfo']['keyFieldValue']))
			{
				$arr['tableInfo']['keyFieldValue'] = $InsID;
			}
			else
			{
				$arr['tableInfo']['keyFieldValue'] = getFieldByEnother($arr['tableInfo']['keyFieldCol'], $WorkTable, $WorkTableKeyFieldName, $InsID);
			}
			$relationType = @$arr['relationType'];
            $arr['relationTable']['keyFieldValue'] = $InsID;

			switch($relationType)
			{
                case 'idsOnlyAdd' : makeListOfRelationsIdsOnlyAdd($arr['relationTable'], $arr['addVariable']);
                    break;
				case 'idsOnly' : makeListOfRelationsIdsOnly($arr['relationTable'], $arr['addVariable']);
      						break;
      			case 'idOne' : makeListOfRelationsIdOne($arr['relationTable'], $arr['addVariable']);
							break;
				default : makeListOfRelations($arr['tableInfo'], $arr['addVariable']);
			}
		}
		foreach($Relations as $n => $arr)
		{
			if(isBlank($arr['tableInfo']['keyFieldCol']))
			{
				$arr['tableInfo']['keyFieldValue'] = $InsID;
			}
			else
			{
				$arr['tableInfo']['keyFieldValue'] = getFieldByEnother($arr['tableInfo']['keyFieldCol'], $WorkTable, $WorkTableKeyFieldName, $InsID);
			}
			makeRelation($arr['tableInfo'], $arr['addVariable']);
		}

		if($_FLAGS['useImage'] == __TRUE || $_FLAGS['JVSCMessage'] == __TRUE)
		{
			go_toJVSC(getSameUri());
		}
		elseif($_FLAGS['useRedirectLink'])
		{
			showMessageAlertJVSC($alertMessage);
			go_toJVSC($redirectLink);
		}
		else
		{
			go_to(getSameUri());
		}
		exit();
	}
	else
	{
		$tpl->assign('showAddNewForm', __TRUE);
		//$tpl->assign('ErrorMessage', $ErrorMessage);

 		$tpl->assign('Item', $_POST);
 	}
}
if($_POST['act'] == 'edit')
{
	foreach($_POST['item'] as $id => $val)
	{
		$MySQLFuncColumns = array();
		$BreakColumns = array();
		$result = array();
		foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr)
		{
			if(!isBlank($farr['editVariable']) && $farr['useInListEdit'] == 'y')
			{
				$result[$field] = (is_array($farr['editVariable'])) ? $farr['editVariable'][$id] : $farr['editVariable'];
				if($farr['addVarType'] == $CONFIG['VarTypeSQLFunction'])
				{
					$MySQLFuncColumns[] = $field;
				}
			}
			elseif($farr['addVariable'] && !$farr['editVariable'] && $farr['useInListEdit'] == 'y')
			{
				$result[$field] = (is_array($farr['addVariable'])) ? $farr['addVariable'][$id] : $farr['addVariable'];
				if($farr['addVarType'] == $CONFIG['VarTypeSQLFunction'])
				{
					$MySQLFuncColumns[] = $field;
				}
			}
			elseif($farr['useInListEdit'] == 'y' && isBlank($farr['editVariable']) && isBlank($farr['addVariable']) && $farr['allowEmpty'] == 'y')
			{
				$result[$field] = $farr['addVariable'];
			}
			else
			{
				$BreakColumns[] = $field;
			}
		}
		if(is_callable($CONFIG['AdminAddFuncEditList']))
		{
			$OldRow = getRowByField($WorkTable, $WorkTableKeyFieldName, $id);
		}
		makeUpdateList($strSet, $result, $MySQLFuncColumns, $BreakColumns);
		updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $id);
		if(is_callable($CONFIG['AdminAddFuncEditList']))
		{
			$NewRow = getRowByField($WorkTable, $WorkTableKeyFieldName, $id);
			eval($CONFIG['AdminAddFuncEditList'].'();');
		}
	}
	if($imFlag)
	{
		go_toJVSC(getSameUri());
	}
	else
	{
		go_to(getSameUri());
	}
	exit();
}
elseif($_POST['act'] == 'status')
{
	$varName = $_POST['varname'];
	$varValue = $_POST['varvalue'];

	$result = array(
		$varName => $varValue,
	);

	if(!isEmptyArr($_SQL_TABLE_FIELDS[$GlobPart]['date']))
	{
		$result['date'] = 'NOW()';
	}

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
/*elseif($_POST['act'] == 'activate')    // use update strSet 'active' = 'y'
{
	$varTask = $_POST['task'];
	$varSubtask = $_POST['subtask'];

	$result = array(
		$varTask => $varSubtask,
	);

	if(!isEmptyArr($_SQL_TABLE_FIELDS[$GlobPart]['date']))
	{
		$result['date'] = 'NOW()';
	}

	makeUpdateList($strSet, $result, array('date'));

	foreach($_POST['item'] as $id => $val)
	{

		updateItem($WorkTable, $strSet, $WorkTableKeyFieldName, $id);
	}

	go_to(getSameUri());
	exit();
}  */
elseif($_POST['act'] == 'copy')
{

	if(!count($_POST['item']))
	{
		go_to(getSameUri());
		exit();
	}

	$MySQLFuncColumns = array();
	$BreakColumns = array();

	foreach($_POST['item'] as $n => $val)
	{
		$CopyItemID = $val;
		break;
	}

    $itemSubTable = array($WorkTable =>
                    array(
                        'table' => $WorkTable,
                        'primaryKey' => $WorkTableKeyFieldName)
    );
    foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr){
        if($farr['subTable']['table'])
        {
            $itemSubTable[$farr['subTable']['table']] = array(
                                    'table' => $farr['subTable']['table'],
                                    'primaryKey' => $farr['subTable']['primaryKey']
            );
        }
    }
    $currKeyItem = '';
    foreach($itemSubTable as $field_main => $farr_main)
    {


        $ItemFromDB = getRowByField($farr_main['table'], $farr_main['primaryKey'], $CopyItemID);

        foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr)
        {
            if(isBlank($farr['noUseInCopy']))
            {
                if(!isBlank($farr['inCopyValue']))
                {
                    $CopyItem[$field] = $farr['inCopyValue'];
                }
                elseif(isBlank($farr['inCopyValue']) && !isBlank($ItemFromDB[$field]))
                {
                    $CopyItem[$field] = $ItemFromDB[$field];
                }
                if($farr['addVarType'] == $CONFIG['VarTypeSQLFunction'] && !isBlank($farr['addVariable']))
                {
                    $MySQLFuncColumns[] = $field;
                    $CopyItem[$field] = $farr['addVariable'];
                }
            }
        }

        makeInsertList($strColumns, $strValues, $CopyItem, $MySQLFuncColumns, $BreakColumns);

        if($WorkTable == $farr_main['table'])
        {
            for($i=1; $i<=$_POST['subtask']; $i++)
            {
                $currKeyItem = insertItem($farr_main['table'], $strColumns, $strValues);
            }
        }
        else
        {
            $strColumns .= ",`".$WorkTableKeyFieldName."`";
            $strValues .= ",'".$currKeyItem."'";

            for($i=1; $i<=$_POST['subtask']; $i++)
            {
                insertItem($farr['table'], $strColumns, $strValues);
            }
        }


    }
	go_to(getSameUri());
	exit();
}
elseif($_POST['act'] == 'delete')
{
    foreach($_SQL_TABLE_FIELDS[$GlobPart] as $field => $farr)
	{
		if($farr['type'] == 'image')
	  	{
	  		if($farr['useFTP'] == 'y')
	  		{
                require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPImage.php";
	  			$ftpi = new FTPImage($farr['FTP']['ftpServer'], $farr['FTP']['ftpUserName'], $farr['FTP']['ftpPassword'], $farr['FTP']['ftpRootPath']);

	  			$itemsToDelete = getRowsByFieldArrayValue($WorkTable, $WorkTableKeyFieldName, $_POST['item']);
	  			foreach($itemsToDelete as $arr)
	  			{
                    if(is_numeric($arr[$field]))
                    {
                        if(!$farr['relationTable'])
                        {
                            if($farr['storeTable'] && is_array($farr['storeTable']))
                            {
                                foreach($farr['sizes'] as $size => $sizeInfo)
                                {
                                    $imagePath = getFieldByEnother($sizeInfo['tableFieldPath'], $farr['storeTable']['tableInfoName'], $farr['storeTable']['keyField'], $arr[$field]);
                                    $ftpi->deleteFile($imagePath);
                                }
                            }
                        }
                    }
                    else
                    {
                        $ftpi->deleteFile($arr[$field]);
                    }
	  			}
	  		}
	  	}
        if($farr['type'] == 'files')
        {
            if($farr['useFTP'] == 'y')
            {
//                require_once __CFG_PATH_LIBS.__CFG_PATH_CORE_CLASSES."class.FTPAgent.php";
//                $ftp = new FTPAgent(__CFG_PTF_HOSTNAME, __CFG_PTF_USERNAME, __CFG_PTF_PASSWORD, __CFG_PTF_CORE_PATH);
//                $ftp->deleteFile($_POST['dirName']);
            }
//            delRow($FieldArray['relationTable']['name'], $FieldArray['relationTable']['relatedField'], $_POST['imageId']);
//            delRow($_SQL_TABLE['file'], 'file_id', $_POST['imageId']);
        }
	  	if($farr['listOfRelations'] == 'y' && $farr['relationType'] == 'idsOnly')
	  	{
	  		deleteListOfRelationsIdsOnly($farr['relationTable'], $_POST['item']);
	  	}
	  	if(is_array($farr['subTable']) && sizeof($farr['subTable']))
	  	{
	  		deleteItemsFromSubTables($farr['subTable'], $_POST['item']);
	  	}
	}
	if(is_callable($CONFIG['AdminAddFuncDeleteItem']))
    {
	  	foreach($_POST['item'] as $id => $val)
	    {
            eval($CONFIG['AdminAddFuncDeleteItem'].'($id);');
	    }
	}

	delRows($WorkTable, $WorkTableKeyFieldName, $_POST['item']);

	go_to(getSameUri());
	exit();
}
elseif(is_callable($CONFIG['ListItemsActionFuncPrefix'].$_POST['act']))
{
	call_user_func($CONFIG['ListItemsActionFuncPrefix'].$_POST['act'], $_POST);
}

if(!isBlank($_GET[$CONFIG['AdminActionGetVar']]) && is_callable($CONFIG['ListItemsActionFuncPrefix'].$_GET[$CONFIG['AdminActionGetVar']]))
{
	call_user_func($CONFIG['ListItemsActionFuncPrefix'].$_GET[$CONFIG['AdminActionGetVar']]);
}

$subTables = getSubTablesFromTableFields($_SQL_TABLE_FIELDS[$GlobPart]);
if(isBlank($Query['FromTables']) && is_array($subTables) && sizeof($subTables))
{
	$queryArr = makeQueryArrFromSubTables($subTables, array());

	$queryPart = $WorkTable." t0";
	$i = 0;
	foreach($queryArr as $tabName => $params)
	{
		$i++;
		$queryPart .= " INNER JOIN ".$tabName." t".$i." USING(".$params['primaryKey'].")";
	}

	$Query['FromTables'] = $queryPart;
}

if($_FLAGS['NoReadDB'] == __FALSE)
{
	$Items = getListFull($Query['FromTables'], $listInfo, $Query['Fields'], $Query['TabOrder'], $Query['Where'], $Query['GroupBy']);
	$_FLAGS['ListingTab'] = __TRUE;
}

if(is_callable($CONFIG['AdminAddFuncListItems']))
{
	call_user_func($CONFIG['AdminAddFuncListItems']);
}

	$tpl->assign("Items", $Items);
	eval('$PageTitle = '.$PageTitle);
	$tpl->assign("PageTitle", $PageTitle);
	$tpl->assign("emptyPageTooltip", $emptyPageTooltip);
	$tpl->assign_by_ref("ConfFields", $_SQL_TABLE_FIELDS[$GlobPart]);
	$tpl->assign_by_ref("ConfEditForms", $_SQL_TABLE_EDIT_FORMS[$GlobPart]);
	$tpl->assign_by_ref("GlobPart", $GlobPart);
	$tpl->assign("BodyTemplate", $BodyTemplate);

	//$Timer->stop($_REQUEST[mode]);
	//$Timer->display();
	if($tpl->template_exists("admin.".$_REQUEST['mode'].".tpl"))
	{
		//$_ADMIN_SMARTY_TEMPLATE = "admin.".$_REQUEST['mode'].".tpl";
		$_BODY_SMARTY_TEMPLATE = "admin.".$_REQUEST['mode'].".tpl";
	}
	else
	{
		//$_ADMIN_SMARTY_TEMPLATE = "admin.items.tpl";
		$_BODY_SMARTY_TEMPLATE = "admin.items.tpl";
	}

?>