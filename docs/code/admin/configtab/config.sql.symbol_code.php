<?php

  $WorkTable = &$_SQL_TABLE[$GlobPart];
  //$WorkTableKeyFieldName = 'code';

  if($_REQUEST['mode'] == $GlobPart)
  {
    $PageTitle = '$language["admin"]["symbolsCodes"]." :: ".$Item["code"];';
  }
  else
  {
  	$PageTitle = '$language["admin"]["symbolsCodes"];';
  	$AloneMode = $GlobPart;
  }

  /*
  function unhtmlentities($string)
  {
    $trans_tbl = get_html_translation_table(HTML_SPECIALCHARS);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
  }
  echo unhtmlentities($_POST['symbol']);
  echo "<br />".unhtmlentities($_POST['html_code']);

  print_r($_POST);
  echo html_entity_decode($_POST['symbol'], ENT_NOQUOTES, "UTF-8");
  exit;  */

  $_SQL_TABLE_FIELDS[$GlobPart] = array(

				'code' => array(
								'type' => 'input',
								'title' => $language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['code'],
								'useInList' => $CONFIG['useInListSort'],
								//'required' => '\[(.+)\]',
								'size' => '10',
								'maxlength' => '10',
								//'unique' => 'y',
								//'editFormOther' => 'disabled',
								'SmartyMods' => array('escape:"htmlchars"'),
								'inListSmartyMods' => array('escape:"htmlchars"'),
								),

				'symbol' => array(
								'type' => 'input',
								'title' => $language['admin']['symbol'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['symbol'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'size' => '10',
								'maxlength' => '10',
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								),

				'linkname_code' => array(
								'type' => 'input',
								'title' => $language['admin']['linknameCode'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['linkname_code'],
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'size' => '3',
								'maxlength' => '3',
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								),

				'html_code' => array(
								'type' => 'input',
								'title' => "HTML ".$language['admin']['code'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['html_code'],
								'useInList' => $CONFIG['useInListSort'],
								//'required' => $CONFIG['AdminReqPatAll'],
								'size' => '10',
								'maxlength' => '10',
								//'editFormOther' => 'disabled',
								'SmartyMods' => array('escape:"htmlchars"'),
								'inListSmartyMods' => array('escape:"htmlchars"'),
								),

				'active' => array(
								'type' => 'select_link',
								'title' => $language['admin']['status'],
								'formid' => $CONFIG['activeFormName'],
								'addVariable' => $CONFIG['addSymbolCodeActive'],
								'noUseInEdit' => 'y',
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'select_link',
								'values' => array(
											'y' => array(
													'title' => $language['admin']['active'],
													'className' => 'active',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'n',
																	'varname' => 'active',
																	getKeyVarName() => '{$Item.$WorkTableKeyFieldName}',
													),
											),
											'n' => array(
													'title' => $language['admin']['inactive'],
													'className' => 'inactive',
													'formFields' => array(
																	'act' => 'status',
																	'varvalue' => 'y',
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