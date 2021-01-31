<?php

	$WorkTableKeyFieldName = 'mail_template_id';

	$WorkTableKeyVarName = $CONFIG['keyVarPrefix'].$WorkTableKeyFieldName;
	$WorkTable = &$_SQL_TABLE[$GlobPart];


	//$TabFields['af'] = getFieldNamesWithLangs($_SQL_TABLE['article_folder'], array('title'));
	$TabFields['mt'] = getFieldNamesWithLangs($_SQL_TABLE['article_info'], array('title'));

	//$ArticlesFoldersSelect = array_kv(getTableAsArray($_SQL_TABLE['article_folder'], $TabFields['af']['title'], array(), '', 'article_folder_id,'.$TabFields['af']['title']), $TabFields['af']['title'], 'article_folder_id');

	if($_REQUEST['mode'] == $GlobPart)
	{
		$PageTitle = '$language["admin"]["mailTemplate"]." :: ".$Item["'.$TabFields['mt']['title'].'"];';
		//$RowItem = getRowByField($_SQL_TABLE['article'], $WorkTableKeyFieldName, $_GET[$WorkTableKeyVarName]);
	}
	else
	{
		$PageTitle = '$language["admin"]["mailTemplates"];';
		$AloneMode = $GlobPart;

		$emptyPageTooltip = $language['admin']['mailTemplatesEmptyList'];
        /*
		$Query['FromTables'] = 	$WorkTable." a
							INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.".$WorkTableKeyFieldName." = a.".$WorkTableKeyFieldName."
  							INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.".$WorkTableKeyFieldName." = a.".$WorkTableKeyFieldName."
  							LEFT JOIN ".$_SQL_TABLE['article_folder']." af ON af.article_folder_id = a.article_folder_id
  							LEFT JOIN ".$_SQL_TABLE['article_group']." ag ON ag.article_group_id = a.article_group_id";
		$Query['Fields'] = "a.*, ai.*, af.".$TabFields['af']['title']." AS article_folder_id, ag.".$TabFields['ag']['title']." AS article_group_id, am.".$TabFields['am']['meta_title']."";
		$Query['TabOrder'] = "a.";
		$Query['Where'] = "";
		$Query['GroupBy'] = "a.".$WorkTableKeyFieldName;

		$EnableFilter = true;

			$listInfo['where']['article_folder_id'] = array(
  								'simple' => 'y',
  								'SQLField' => "a.article_folder_id = '".$_REQUEST['article_folder_id']."'",
  								'type' => 'select',
  								'title' => $language['admin']['articleFolder'],
  								'values' => array('' => $language['admin']['all']) + $ArticlesFoldersSelect,
  								'JSact' => '',
			);

		require_once __CFG_PATH_CODE."admin.filter.inc";
		*/
	}

	$ConfLangArr = array(

				'title_' => array(
								'type' => 'input',
								/*
								'subTable' => array(
										'table' => $_SQL_TABLE['article_info'],
										'primaryKey' => $WorkTableKeyFieldName,
								),
								*/
								'title' => $language['admin']['title'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								//'makeSameValue' => 'linkname',
								//'makeSameValueFrom' => 'title_'.$CONFIG['SiteLanguage'],
								//'makeSameValueFunc' => 'makeLinkName(this.value.toLowerCase())',
								'maxlength' => '255',
				),

				'subject_' => array(
								'type' => 'input',
								'title' => $language['admin']['mailTemplateSubject'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '120',
				),

  				'body_' => array(
								'type' => 'fckeditor',
								'title' => $language['admin']['mailTemplateBody'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST,
								'SmartyMods' => array('unescape'),
								'useInAddFormLocation' => 'full',
				),
	);

	$GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);

	//$LinkName = make_linkname($_POST['linkname']);

	$_SQL_TABLE_FIELDS[$GlobPart] = $GeneratedLangArr + array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'addVariable' => $_POST['code'],
								'useInAddForm' => 'y',
								'unique' => 'y',
								//'useInList' => $CONFIG['useInListSort'],
								//'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatLinkName'],
								'textUnderField' => '<span class="red">'.$language['admin']['latinAlphAttention'].'</span>',
								'maxlength' => '20',
				),

				/*
				'article_group_id' => array(
                                'type' => 'select',
                                'title' => $language['admin']['articlesGroup'],
                                'useInAddForm' => 'y',
                                'addVariable' => $_POST['article_group_id'],
                                'useInList' => $CONFIG['useInListSort'],
                                'required' => $CONFIG['AdminReqPatAll'],
                                'values' => array('' => $language['admin']['selectArticlesGroup']) + $ArticlesGroupSelect,
                                'orderby' => $TabFields['ag']['title'].',a.'.$TabFields['a']['title'],
                                'tabord' => 'ag.',
				),
				*/

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => '1',
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'1' => array(
													'title' => $language['admin']['active'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '0',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'0' => array(
													'title' => $language['admin']['inactive'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => '1',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
								),
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

?>