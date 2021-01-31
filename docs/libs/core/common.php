<?php

	function delRow($table, $IDName, $ID)
	{
		global $dbSet ;
		$dbSet->execute("DELETE FROM ".$table." WHERE ".$IDName."='".$ID."'");
	}

	function delRows($table, $columnID, $ids)
	{
		global $dbSet ;

		if (empty($ids)) return 0;
		$inIDs = implode("','",$ids);

		$dbSet->execute("DELETE FROM ".$table." WHERE $columnID IN ('".$inIDs."')");
		return 1;
	}

	function delRowsWhere($table, $where = array())
	{
		global $dbSet ;
		$dbSet->execute("DELETE FROM ".$table." WHERE ".join(' AND ', $where));
	}

	function makeInsertList(&$strColumns,&$strValues, $result, $MySQLFuncColumns=array(),$breakColumns=array())
	{

        $strColumns=""; $strValues="";
		foreach($result as $key => $val)
		{
			if (in_array($key,$breakColumns)) continue;
			$v = mysql_escape_string(trim($val));
			if (in_array($key,$MySQLFuncColumns))
			{
				$strValues .=  " $v ,";
			}
			else
			{
				$strValues .=  " '$v' ,";
			}
			$strColumns .= " `$key` ,";
		}
		$strValues = substr($strValues,0,strlen($strValues)-1);
		$strColumns = substr($strColumns,0,strlen($strColumns)-1);
	}

	function makeUpdateList(&$strSet, $result, $MySQLFuncColumns=array(), $breakColumns=array())
	{
        $strSet="";
		foreach($result as $key => $val)
		{
			if (in_array($key,$breakColumns)) continue;
			$v = mysql_escape_string(trim($val));
			if (in_array($key,$MySQLFuncColumns))
			{
				$strSet .= " `$key` = $v ,";
			}
			else
			{
				$strSet .= " `$key` = '$v' ,";
			}
		}
		$strSet = substr($strSet,0,strlen($strSet)-1);
	}

	function makeSearchList(&$strSet, $result, $MySQLFuncColumns=array(), $breakColumns=array())
	{
		$strSet="";
		foreach($result as $key => $val)
		{
			if($flag == 1)
			{
				$strSet .= "AND";
			}
			if(in_array($key,$breakColumns)) continue;
			$v = mysql_escape_string($val);
			if (in_array($key,$MySQLFuncColumns))
			{
				$strSet .= " `$key` = $v ";
			}
			else
			{
				$strSet .= " `$key` = '$v' ";
			}
			$flag = 1;
		}
	}

	function getListFull($from, &$pageArr, $fields='', $taborder='', $where1='', $groupby='')
	{
		global $dbSet, $CONFIG, $WorkTable, $WorkTableKeyFieldName;

		if(isBlank($fields))
		{
			$fields ='*';
		}
		if(isBlank($from))
		{
			$from = $WorkTable;
		}
		if(!isBlank($where1))
		{
			$Where = " WHERE ".$where1;
		}
		if(!isBlank($groupby))
		{
			$groupby = " GROUP BY ".$groupby;
		}
		foreach($pageArr as $name => $value)
		{
			$$name = $value;
		}
		if(!isEmptyArr($where))
		{
			$whereArr = array();
			foreach($where as $name => $arr)
			{
				if(isset($arr['forSQL']) && $arr['forSQL'])
				{
					array_push($whereArr, $arr['forSQL']);
				}
			}
			$Where = (($Where) ? $Where : '').(sizeof($whereArr) ? (($Where) ? ' AND ' : ' WHERE ').join(" AND ", $whereArr) : '');
		}
		if(!isBlank($tabord))
		{
			if($tabord == '_')
			{
				$tabord = "";
			}
			$taborder = $tabord;
		}
		if(isBlank($order_type))
		{
			$order_type = "ASC";
		}
		$order_type = " ".strToUpperCase($order_type);
		if(isBlank($order))
		{
			$order_for_page = $order = ((isBlank($WorkTableKeyFieldName)) ? $CONFIG['sortByDefault'] : $WorkTableKeyFieldName);
			$order_parts = explode(',', $order);
			foreach($order_parts as $n => $str)
			{
				if(!preg_match("/\sasc\s*$|\sdesc\s*$/is", trim($str)))
				{
					$order_parts[$n] .= $order_type;
				}
			}
			$order = join(',', $order_parts);
		}
		else
		{
			$order = str_replace($CONFIG['AdminLinkNameDelim'], ' ', $order);
			$order_for_page = $order;
			$order_parts = explode(',', $order);
			foreach($order_parts as $n => $str)
			{
				if(!preg_match("/\sasc\s*$|\sdesc\s*$/is", trim($str)))
				{
					$order_parts[$n] .= $order_type;
				}
			}
			$order = join(',', $order_parts);
		}
		if(isBlank($onpage))
		{
			$onpage = $CONFIG['onPage'];
		}
		if(intval($page) < 1) $page = 1;

		$Query = "SELECT ".$fields." FROM ".$from.$Where." ".$groupby." ORDER BY ".$taborder.$order." LIMIT ".($onpage*($page - 1)).", ".$onpage;
		$query = str_replace("SELECT", "SELECT SQL_CALC_FOUND_ROWS", $Query);
		$dbSet->execute($query);
		$query = "SELECT FOUND_ROWS()";
		$dbSet->open($query);
		$count = $dbSet->loadResult();

		$totalPages = ceil($count / $onpage);
		if ($page > $totalPages && $page > 1) $page = $totalPages;

		$pages=array();
		$page1 = $page - $CONFIG['pageRange'];

		if($page > ($totalPages - $CONFIG['pageRange']))
		{
			$page1 = $totalPages - $CONFIG['pageRange']*2 + 1;
		}
		$prev = ($page > 1 && $page <= $totalPages) ? ($page - 1) : 0;
		if($page1 < 1) $page1 = 1;
		for($i = $page1; $i < ($page1 + $CONFIG['pageRange'] * 2) && $i <= $totalPages; $i++)
		{
			$pages[]=$i;
		}
		$next = (($page + 1)<= $totalPages && $page > 0) ? ($page + 1) : 0;
		$counterStart = ($page - 1) * $onpage;

		$pageArr['order'] = $order_for_page;
		$pageArr['page'] = $page;
		$pageArr['onpage'] = $onpage;
		$pageArr['pages'] = $pages;
		$pageArr['prev'] = $prev;
		$pageArr['next'] = $next;
		$pageArr['lastpage'] = $totalPages;
		$pageArr['firstpage'] = 1;
		$pageArr['count'] = $count;
		$pageArr['countSt'] = $counterStart;

		$dbSet->open($Query);
		return ($count > 0) ? $dbSet->fetchRowsAll() : array();
	}

	function getRowByField($table, $fieldname, $fieldvalue)
	{
		global $dbSet;
		$dbSet->open("SELECT * FROM ".$table." WHERE ".$fieldname." = '".$fieldvalue."'");
		return $dbSet->fetchArray();
	}

	function getSomeFieldsByField($table, $fieldname, $fieldvalue, $fields='*')
	{
		global $dbSet;
		$dbSet->open("SELECT ".$fields." FROM ".$table." WHERE ".$fieldname." = '".$fieldvalue."'");
		return $dbSet->fetchArray();
	}

	function getRowByStrSet($table, $strSet)
	{
		global $dbSet;
		$dbSet->open("SELECT * FROM ".$table." WHERE ".$strSet);
		return $dbSet->fetchArray();
	}

	function getRowByFields($table, $fields = array(), $orderby='')
	{
		global $dbSet;
		$dbSet->open("SELECT * FROM ".$table." WHERE ".join(" AND ", $fields)." ".$orderby);
		return $dbSet->fetchArray();
	}

	function getRowsByField($table, $fieldname, $fieldvalue, $orderby='')
	{
		global $dbSet;
		$dbSet->open("SELECT * FROM ".$table." WHERE ".$fieldname." = '".$fieldvalue."' ".$orderby);
		return $dbSet->fetchRowsAll();
	}

	function getRowsByFieldArrayValue($table, $fieldname, array $fieldvalue, $orderby='')
	{
		global $dbSet;
		$dbSet->open("SELECT * FROM ".$table." WHERE ".$fieldname." IN ('".join("','", $fieldvalue)."') ".$orderby);
		return $dbSet->fetchRowsAll();
	}

	function getFieldByEnother($fieldname1, $table, $fieldname, $fieldvalue)
	{
		$arr = getRowByField($table, $fieldname, $fieldvalue);
		return $arr[$fieldname1];
	}

	function getTableAsFolders($FolderTbl, $FolderTblKeyFld='id', $FolderTblRootFld='root', $FolderTblOrder='', $FolderTblParams=array(), $FolderTblRoot=0, $FileFlag=__FALSE, $FileTbl='', $FileTblRootFld='folder')
	{
		global $CONFIG, $ERRORS;

		$Where = array_merge($FolderTblParams, array($FolderTblRootFld." = '".$FolderTblRoot."'"));
		$Folders = getTableAsArray($FolderTbl, $FolderTblOrder, $Where);
		foreach($Folders as $n => $Folder)
		{
			$Folders[$n]['folders'] = getTableAsFolders($FolderTbl, $FolderTblKeyFld, $FolderTblRootFld, $FolderTblOrder, $FolderTblParams, $Folder[$FolderTblKeyFld], $FileFlag, $FileTbl);
			if($FileFlag == __TRUE)
			{
				$Folders[$n]['rows'] = getRowsByField($FileTbl, $FileTblRootFld, $Folder[$FolderTblKeyFld]);
			}
		}
		return $Folders;
	}

	function getTableAsArray($table, $order='', $where = array(), $limit='', $fields='*', $distinct='', $group='')
	{
		global $dbSet;
		if(!isBlank($order))
		{
			$query_order = " ORDER BY ".$order;
		}
		if(!isBlank($group))
		{
			$query_group = " ".$group;
		}
		if(!isBlank($limit))
		{
			$query_limit = " ".$limit;
		}
		if(!isBlank($distinct))
		{
			$distinct = "DISTINCT ";
		}
		if(!isEmptyArr($where))
		{
			$query_where = " WHERE ".join(' AND ', $where);
		}
		$dbSet->open("SELECT ".$distinct.$fields." FROM ".$table.$query_where.$query_group.$query_order.$query_limit);
		return $dbSet->fetchRowsAll();
	}

	function getTableAsArrayByKeyField($table, $keyfield, $order='', $where = array(), $limit='', $fields='*', $distinct='', $group='')
	{
		$result = getTableAsArray($table, $order, $where, $limit, $fields, $distinct, $group);
		foreach($result as $n => $arr)
		{
			$Items[$arr[$keyfield]] = $arr;
		}
		return $Items;
	}

	function updateItem($table, &$strSet, $fieldname, $fieldvalue)
	{
		global $dbSet;
		$dbSet->execute("UPDATE ".$table." SET ".$strSet." WHERE ".$fieldname."='".$fieldvalue."'");
	}

	function updateItemByFields($table, &$strSet, $where=array())
	{
		global $dbSet;
		$dbSet->execute("UPDATE ".$table." SET ".$strSet." WHERE ".join(' AND ', $where));
	}

	function insertItem($table, &$strColumns,&$strValues)
	{
		global $dbSet;
		return $dbSet->execute("INSERT INTO ".$table." (".$strColumns.") VALUES (".$strValues.")");
	}

  function makeListOfRelations($tableInfo=array(), $resultValues=array())
  {
    /* Example of $tableInfo */
    /*
      $tableInfo = array(
  						'name' => $_SQL_TABLE['subdomain_brand'],
  						'keyField' => 'subdomain',
  						'keyFieldCol' => 'code',
  						'relatedField' => 'brand',
  						'keyFieldValue' => $_REQUEST[id],
  						'dateField' => 'y/n', // is date field is presented
  					);
  	  $resultValues = array(1,2,3,45);
    */

    global $dbSet, $CONFIG;
    $dbSet->open("SELECT ".$tableInfo['relatedField'].", active FROM ".$tableInfo['name']." WHERE ".$tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'");
    $result = $dbSet->fetchRowsAll();
    $existVals = array();
    $existValsStatus = array();
    foreach($result as $n => $arr)
    {
      $existVals[] = $arr[$tableInfo['relatedField']];
      $existValsStatus[$arr[$tableInfo['relatedField']]] = $arr['active'];
    }
    $newVals = array_diff($resultValues, $existVals);
    foreach($newVals as $n => $val)
    {
      if(!array_key_exists($val, $existValsStatus))
      {
        $vals = array(
      					$tableInfo['relatedField'] => $val,
      					$tableInfo['keyField'] => $tableInfo['keyFieldValue'],
      					'active' => 'y',
      				);
      	if($tableInfo['dateField'] == 'y')
      	{
      	  $vals['date'] = 'NOW()';
      	}
        makeInsertList($strColumns,$strValues, $vals, array('date'));
        insertItem($tableInfo['name'], $strColumns, $strValues);
      }
    }
    foreach($existValsStatus as $val => $status)
    {
      if(!in_array($val, $resultValues))
      {
        $vals = array(
      					'active' => 'n',
  		  		  );
  	  }
  	  elseif(in_array($val, $resultValues))
  	  {
  	    $vals = array(
      					'active' => 'y',
  		  		  );
  	  }
  	  if($vals['active'] != $existValsStatus[$val])
  	  {
        makeUpdateList($strSet, $vals);
        updateItemByFields($tableInfo['name'], $strSet, array($tableInfo['relatedField']." = '".$val."'", $tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'"));
      }
    }
  }

	function makeListOfRelationsIdsOnly($tableInfo=array(), $resultValues=array())
	{

        global $dbSet, $CONFIG;

		$query = "DELETE FROM ".$tableInfo['name']." WHERE ".$tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'";
		$dbSet->execute($query);

		if(sizeof($resultValues) && $resultValues)
		{
			$queryPart = array();
			foreach($resultValues as $value)
			{
				array_push($queryPart, "('".$tableInfo['keyFieldValue']."', '".$value."')");
			}
			$query = "INSERT INTO ".$tableInfo['name']." (".$tableInfo['keyField'].", ".$tableInfo['relatedField'].") VALUES ".join(',', $queryPart);
			$dbSet->execute($query);
		}
	}

function makeListOfRelationsIdsOnlyAdd($tableInfo=array(), $resultValues=array())
{
    global $dbSet, $CONFIG;
    if(sizeof($resultValues) && !isBlank($resultValues[0]))
    {
        $queryPart = array();
        foreach($resultValues as $value)
        {
            array_push($queryPart, "('".$tableInfo['keyFieldValue']."', '".$value."')");
        }
        $query = "INSERT INTO ".$tableInfo['name']." (".$tableInfo['keyField'].", ".$tableInfo['relatedField'].") VALUES ".join(',', $queryPart);
        $dbSet->execute($query);
    }
}
	function makeListOfRelationsIdOne($tableInfo=array(), $insertValue)
	{
		global $dbSet, $CONFIG;

		if($insertValue)
		{
			$query = "DELETE FROM ".$tableInfo['name']." WHERE ".$tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'";
			$dbSet->execute($query);

			$query = "INSERT INTO ".$tableInfo['name']." (".$tableInfo['keyField'].", ".$tableInfo['relatedField'].") VALUES ('".$tableInfo['keyFieldValue']."', '".$insertValue."')";
			$dbSet->execute($query);
		}
	}

  function makeRelation($tableInfo=array(), $resultValue)
  {
    /* Example of $tableInfo */
    /*
      $tableInfo = array(
  						'name' => $_SQL_TABLE['subdomain_brand'],
  						'keyField' => 'subdomain',
  						'keyFieldCol' => 'code',
  						'relatedField' => 'brand', // not required
  						'keyFieldValue' => $_REQUEST[id],
  						'dateField' => 'y/n', // is date field is presented
  					);
  	  $resultValue = 'y';
    */

    global $dbSet, $CONFIG;
    $dbSet->open("SELECT id, active FROM ".$tableInfo['name']." WHERE ".$tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'");
    $result = $dbSet->fetchArray();
    if(isBlank($result['id']))
    {
      if(!isBlank($resultValue))
      {
        $vals = array(
      					$tableInfo['keyField'] => $tableInfo['keyFieldValue'],
      					'active' => 'y',
      				);
        if($tableInfo['dateField'] == 'y')
        {
          $vals['date'] = 'NOW()';
        }
        if(!isBlank($tableInfo['relatedField']))
  	    {
          $vals[$tableInfo['relatedField']] = $resultValue;
          if(isBlank($resultValue))
          {
            $vals['active'] = 'n';
          }
        }
        makeInsertList($strColumns,$strValues, $vals, array('date'));
        insertItem($tableInfo['name'], $strColumns, $strValues);
      }
    }
    else
    {
      if(isBlank($resultValue))
      {
        $vals = array(
      					'active' => 'n',
  		  		  );
  	  }
  	  else
  	  {
  	    $vals = array(
      					'active' => 'y',
  		  		  );
  	    if(!isBlank($tableInfo['relatedField']))
  	    {
  	      $vals[$tableInfo['relatedField']] = $resultValue;
  	    }
  	  }
  	  makeUpdateList($strSet, $vals);
      $Conditions = array($tableInfo['keyField']." = '".$tableInfo['keyFieldValue']."'");
      updateItemByFields($tableInfo['name'], $strSet, $Conditions);
    }
  }

	function deleteListOfRelationsIdsOnly($tableInfo=array(), $itemsArr=array())
	{
		global $dbSet, $CONFIG;

		$itemsSet = join(',', $itemsArr);

	  	$query = "DELETE FROM ".$tableInfo['name']." WHERE ".$tableInfo['keyField']." IN (".$itemsSet.")";
	  	$dbSet->execute($query);
	}

	function deleteItemsFromSubTables($subTableInfo=array(), $itemsArr=array())
	{

	  	/* Example of $subTableInfo */
	  	/*
	  	 '$subTableInfo' => array(
				'table' => $_SQL_TABLE['teacher_date'],
				'primaryKey' => 'teacher_id',
		),
	  	$resultValues = array(1,2,3,45); // array of depended values
	  	*/

		global $dbSet, $CONFIG;

		$itemsSet = join(',', $itemsArr);

	  	$query = "DELETE FROM ".$subTableInfo['table']." WHERE ".$subTableInfo['primaryKey']." IN (".$itemsSet.")";
	  	$dbSet->execute($query);
	}

  function createTable($tblName, $fields = array(), $indexes = array(), $params = array())
  {
    global $CONFIG, $dbSet;

    $i=0;
    foreach($fields as $name => $value)
    {
      $fields_str .= (($i > 0) ? ',' : '')."`".$name."` ".$value;
      $i++;
    }
    if(count($indexes) > 0)
    {
      $fields_str .= ','.join(',',$indexes);
    }
    $i=0;
    foreach($params as $name => $value)
    {
      $params_str .= (($i > 0) ? ' ' : '').$name.'='.$value;
      $i++;
    }
    $query = "
        		CREATE TABLE IF NOT EXISTS ".$tblName."
        		".((count($fields) > 0) ? "(".$fields_str.")" : "")."
        		".((count($params) > 0) ? $params_str : "" )."
        		;";
    $dbSet->execute($query);
  }

  function tableExists($tblName, $dbName='')
  {
  	global $dbSet;

  	return $dbSet->tableExist($tblName, $dbName);
  }

  function DBExists($dbName='')
  {
  	global $dbSet;

    return $dbSet->DBExist($dbName);
  }

  function createDB($dbName)
  {
    global $dbSet;

    $Error_reporting = $dbSet->get_error_reporting();
    $dbSet->set_error_reporting('');
    $query = "CREATE DATABASE IF NOT EXISTS ".$dbName;
    $result = $dbSet->execute($query);
    $dbSet->set_error_reporting($Error_reporting);
    return $result;
  }

  function deleteTable($tblName)
  {
    global $dbSet;

    if(is_array($tblName) && count($tblName) > 0)
    {
      $table = join(',', $tblName);
    }
    elseif(is_string($tblName) && strlen($tblName) > 0)
    {
      $table = $tblName;
    }
    if(strlen($table) > 0)
    {
      $query = "DROP TABLE IF EXISTS ".$table;
      $dbSet->execute($query);
    }
  }

  function renameTable($TableNameOld, $TableNameNew, $DBName='')
  {
    global $CONFIG, $dbSet;

    if(!isBlank($DBName))
    {
      $DBName = "`".$DBName."`.";
    }
  	$query = "RENAME TABLE ".$DBName."`".$TableNameOld."`  TO ".$DBName."`".$TableNameNew."`";
  	$dbSet->execute($query);
  }

  function makeTableNameFromParts($tabNameParts)
  {
    global $CONFIG, $dbSet;

    return make_tablename(join($CONFIG['AdminDBTableNameDelim'], $tabNameParts));
  }

	function getSubTablesFromTableFields(array $generalTableFields)
	{
		$subTables = array();
		foreach($generalTableFields as $field => $farr)
		{
			if(is_array($farr['subTable']) && sizeof($farr['subTable']))
			{
				$subTables[$field] = $farr;
			}
		}
		return $subTables;
	}

	function getImageFieldsFromTableFields(array $generalTableFields)
	{
		$imageFields = array();
		foreach($generalTableFields as $field => $farr)
		{
			if($farr['type'] == 'image' || $farr['type'] == 'multi_image')
			{
				$imageFields[$field] = $farr;
			}
		}
		return $imageFields;
	}
function getFileFieldsFromTableFields(array $generalTableFields)
{
    $fileFields = array();
    foreach($generalTableFields as $field => $farr)
    {
        if($farr['type'] == 'files')
        {
            $fileFields[$field] = $farr;
        }
    }
    return $fileFields;
}

	function makeQueryArrFromSubTables(array $subTables, array $Row, array $valuesArr = array())
	{
		$queryArr = array();
		$flagValuesArr = (bool) sizeof($valuesArr);

		foreach($subTables as $field => $farr)
        {
        	$key = $farr['subTable']['table'];
        	if(!isset($queryArr[$key]))
        	{
        		$queryArr[$key] = array(
        			'primaryKey' => $farr['subTable']['primaryKey'],
        			'primaryKeyValue' => $Row[$farr['subTable']['primaryKey']],
        			'fields' => array(),
        		);
        	}
        	$queryArr[$key]['fields'][$field] = ($flagValuesArr) ? $valuesArr[$field] : '';
        }
        return $queryArr;
	}

	function updateSubTables(array $subTables, array $Row, array $valuesArr, array $OldRow = array())
	{
		global $MySQLFuncColumns, $subTableBreakColumns;

		if(!is_array($MySQLFuncColumns))
		{
			$MySQLFuncColumns = array();
		}

		if(!is_array($subTableBreakColumns))
		{
			$subTableBreakColumns = array();
		}

        $queryArr = makeQueryArrFromSubTables($subTables, $Row, $valuesArr);

        foreach($queryArr as $tableName => $params)
        {

        	$strSet = '';
        	makeUpdateList($strSet, $params['fields'], $MySQLFuncColumns, $subTableBreakColumns);
        	if($strSet)
        	{
        		updateItem($tableName, $strSet, $params['primaryKey'], $params['primaryKeyValue']);
        	}
        }
	}

	function insertSubTables(array $subTables, array $Row, array $valuesArr, array $OldRow = array())
	{
		global $MySQLFuncColumns, $subTableBreakColumns;

		if(!is_array($MySQLFuncColumns))
		{
			$MySQLFuncColumns = array();
		}

		if(!is_array($subTableBreakColumns))
		{
			$subTableBreakColumns = array();
		}

        $queryArr = makeQueryArrFromSubTables($subTables, $Row, $valuesArr);

        foreach($queryArr as $tableName => $params)
        {
        	$strColumns = '';
        	$strValues = '';
        	$paramArr = array();
        	$paramArr[$params['primaryKey']] = $params['primaryKeyValue'];
        	foreach(array_keys($params['fields']) as $fieldName)
			{
				$paramArr[$fieldName] = $valuesArr[$fieldName];
			}

        	makeInsertList($strColumns, $strValues, $paramArr, $MySQLFuncColumns);
        	insertItem($tableName, $strColumns, $strValues);
        }
	}

	function addItemsFromSubTables(array $subTables, array $Item)
	{
		$queryArr = makeQueryArrFromSubTables($subTables, $Item);
		foreach($queryArr as $tableName => $params)
		{
			$subRow = getRowByField($tableName, $params['primaryKey'], $params['primaryKeyValue']);
			foreach(array_keys($params['fields']) as $fieldName)
			{
				$Item[$fieldName] = $subRow[$fieldName];
			}
		}
		return $Item;
	}

function addItemFileArray(array $fileArray, array $Item)
{
    global $_SQL_TABLE, $dbSet, $WorkTable, $WorkTableKeyFieldName;
    foreach($fileArray as $name => $field)
    {
        $Item[$name] = $field;
        if($field['relationTable'])
        {
            $query = "	SELECT f.*
                                    FROM ".$field['relationTable']['name']." cf
                                    INNER JOIN ".$_SQL_TABLE['file']." f ON f.".$field['relationTable']['relatedField']." = cf.".$field['relationTable']['relatedField']."
                                    WHERE cf.".$field['relationTable']['keyField']." = '".$field['relationTable']['keyFieldValue']."'
                                ";

            $dbSet->open($query);
            $Item[$name]['files'] = $dbSet->fetchRowsAll();
        }
    }

    return $Item;
}
	function addItemImageArray(array $imageArray, array $Item)
	{
        global $_SQL_TABLE, $dbSet, $WorkTable, $WorkTableKeyFieldName;

		foreach($imageArray as $name => $field)
		{
			$Item[$name] = $field;
			if($field['relationTable'])
			{
				$query = "	SELECT  i.*, info.*,
									i.".$field['relationTable']['relatedField']." AS id
							FROM ".$field['relationTable']['name']." w
			 				INNER JOIN ".$_SQL_TABLE['image']." i ON i.".$field['relationTable']['relatedField']." = w.".$field['relationTable']['relatedField']."
			 				INNER JOIN ".$_SQL_TABLE['image_info']." info ON info.".$field['relationTable']['relatedField']." = w.".$field['relationTable']['relatedField']."
			 				WHERE w.".$field['relationTable']['keyField']." = '".$field['relationTable']['keyFieldValue']."'
			 				GROUP BY i.".$field['relationTable']['relatedField']."
			 				ORDER BY i.position ASC
						";
				$dbSet->open($query);
				$Item[$name]['images'] = $dbSet->fetchRowsAll();
			}
            else
            {
            	$query = "	SELECT 	i.*, info.*,
            						i.".$field['storeTable']['keyField']." AS id
							FROM ".$WorkTable." w
			 				INNER JOIN ".$field['storeTable']['tableName']." i ON i.".$field['storeTable']['keyField']." = w.".$name."
			 				INNER JOIN ".$field['storeTable']['tableInfoName']." info ON info.".$field['storeTable']['keyField']." = w.".$name."
			 				WHERE w.".$WorkTableKeyFieldName." = ".$Item[$WorkTableKeyFieldName]."
			 				GROUP BY i.".$field['storeTable']['keyField']."
			 				ORDER BY i.position ASC
						";
				$dbSet->open($query);
				$Item[$name]['images'] = $dbSet->fetchRowsAll();
            }


		}
		return $Item;
	}


?>