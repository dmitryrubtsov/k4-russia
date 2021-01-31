<?php

	$WorkTableKeyFieldName = 'article_folder_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];

	$TabFields['af'] = getFieldNamesWithLangs($WorkTable, array('title'));

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["articlesFolders"]." :: ".$Item["'.$TabFields['af']['title'].'"];';
	}
	else
	{
		$PageTitle = '$language["admin"]["articlesFolders"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['articleFolderEmptyList'];
	}

	$ConfLangArr = array(
				'title_' => array(
								'type' => 'input',
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '100',
				),

	);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	//$LinkName = make_linkname($_POST['linkname']);
	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatSymbols'],
								'editFormOther' => 'disabled',
								'maxlength' => '15',
								'size' => '15',
								'unique' => 'y',
				),

				'date' => array(
								'type' => 'value',
								'title' => $language['admin']['date'],
								'addVariable' => 'NOW()',
								'addVarType' => $CONFIG['VarTypeSQLFunction'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								),

	);

	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

	$NoUse['SaveButton'] = 'y';

?>