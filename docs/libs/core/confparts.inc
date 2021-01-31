<?php

	function getAdminConfigArrayWithLangs($Array, $langArray)
	{
		global $dbSet, $CONFIG, $WorkTable, $_FLAGS;

		$LangFieldArr = array();
		foreach($Array as $name => $arr)
		{
			if(!isEmptyArr($arr['LANGUAGES']))
			{
				$Fields = array();
				foreach($arr['LANGUAGES'] as $lang => $langarr)
				{
					$Fields[$name.$lang] = array('Field' => $name.$lang);
				}
				$_FLAGS['NoCheckLangFieldsInTable'] = __TRUE;
			}
			else
			{
                if(is_array($arr['subTable']) && sizeof($arr['subTable']))
                {
                	$Fields = $dbSet->getFieldsOfTable($arr['subTable']['table'], $name."%");
                }
                else
                {
                	$Fields = $dbSet->getFieldsOfTable($WorkTable, $name."%");
                }
			}
			foreach($Fields as $key => $val)
			{
				$LastLangField = $key;
				$ExampleLangField = $key;
			}
			foreach($langArray as $lcode => $larr)
			{
				$flag = __FALSE;
				if(isEmptyArr($Fields[$name.$lcode]) && isBlank($_POST['correctLangDB']) && isBlank($_FLAGS['NoCheckLangFieldsInTable']))
				{
					$_FLAGS['NotAllLangFieldsInTable'] = __TRUE;
				}
				elseif(isEmptyArr($Fields[$name.$lcode]) && !isBlank($_POST['correctLangDB']) && isBlank($_FLAGS['NoCheckLangFieldsInTable']))
				{
					$query = "ALTER TABLE `".$WorkTable."` ADD `".$name.$lcode."` ".$Fields[$ExampleLangField]['Type']." ".(($Fields[$ExampleLangField]['Null'] == 'NO') ? 'NOT NULL' : 'NULL')." AFTER `".$LastLangField."`;";
					$dbSet->execute($query);
					$LastLangField = $name.$lcode;
					$flag = __TRUE;
					$RedirectFlag = __TRUE;
				}
				if(!isEmptyArr($Fields[$name.$lcode]) || (isEmptyArr($Fields[$name.$lcode]) && $flag == __TRUE))
				{
					$LangFieldArr[$name.$lcode] = $arr;
					$LangFieldArr[$name.$lcode]['title'] .= " (".$larr['title'].")";
					$LangFieldArr[$name.$lcode]['addVariable'] = $LangFieldArr[$name.$lcode]['addVariable'][$name.$lcode];
					$LangFieldArr[$name.$lcode]['editVariable'] = $LangFieldArr[$name.$lcode]['editVariable'][$name.$lcode];
					if($LangFieldArr[$name.$lcode]['makeSameValueFrom'] != $name.$lcode && !isBlank($LangFieldArr[$name.$lcode]['makeSameValue']))
					{
						$LangFieldArr[$name.$lcode]['makeSameValue'] = '';
					}
					$LangParams = array('old_filename', 'filename', 'filenamePrefix');
					foreach($LangParams as $n => $val)
					{
						if(strstr($LangFieldArr[$name.$lcode][$val], $CONFIG['AdminLangReplaceParam']))
						{
							$LangFieldArr[$name.$lcode][$val] = str_replace($CONFIG['AdminLangReplaceParam'], $lcode, $LangFieldArr[$name.$lcode][$val]);
						}
					}
				}
			}
		}
		if($RedirectFlag == __TRUE)
		{
			go_to(getSameUri());
			exit();
		}
		return $LangFieldArr;
	}

	function getFieldNamesWithLangs($tableName, $FieldsArr)
	{
		global $dbSet, $CONFIG;


		$retFields = array();
		foreach($FieldsArr as $n => $fieldName)
		{

            $Fields = $dbSet->getFieldsOfTable($tableName, $fieldName."%");

			if(array_key_exists($fieldName.__FLANG, $Fields))
			{
				$retFields[$fieldName] = $fieldName.__FLANG;
			}
			elseif(array_key_exists($fieldName.$CONFIG['AdminLanguageCode'], $Fields))
			{
				$retFields[$fieldName] = $CONFIG['AdminLanguageCode'];
			}
			else
			{
				$retFields[$fieldName] = key($Fields);
			}

		}
		return $retFields;
	}

?>