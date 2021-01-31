<?php

    $WorkTable = &$_SQL_TABLE['configuration'];
    $WorkTableKeyFieldName = 'name';

    $TabFields['ct'] = getFieldNamesWithLangs($_SQL_TABLE['configuration_type'], array('title'));
    $ConfigurationTypesSelect = array_kv(getTableAsArray($_SQL_TABLE['configuration_type'], $TabFields['ct']['title'], array("code = 'owner'"), '', 'code,'.$TabFields['ct']['title']), $TabFields['ct']['title'], 'code');


    if($_REQUEST['mode'] == $GlobPart)
    {
        $PageTitle = '$language["admin"]["configuration"]." :: ".$Item["name"];';
    }
    else
    {
        $PageTitle = '$language["admin"]["configuration"];';
        $AloneMode = $GlobPart;

        $Query['FromTables'] = 	$WorkTable." c
  							LEFT JOIN ".$_SQL_TABLE['configuration_type']." ct ON ct.code = c.configuration_type
  							";
        $Query['Fields'] = "c.*, ct.".$TabFields['ct']['title']." AS configuration_type";
        $Query['TabOrder'] = "c.";
        $Query['Where'] = "c.configuration_type = 'owner'";
        $Query['GroupBy'] = "";

    }


    $_SQL_TABLE_FIELDS[$GlobPart] = array(
				'name' => array(
								'type' => 'input',
								'title' => $language['admin']['name'],
								'useInAddForm' => 'y',
								'editFormOther' => 'disabled',
								'addVariable' => $_POST['name'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatVariable'],
								'maxlength' => '50',
								'unique' => 'y',
								),

				'value' => array(
								'type' => 'input',
								'title' => $language['admin']['value'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['value'],
								'useInList' => $CONFIG['useInListSort'],
								'inListEdit' => 'list_input',
								'useInListEdit' => 'y',
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
								//'SmartyMods' => array('slashes'),
								//'inListSmartyMods' => array('slashes'),
								),

				/*
                'configuration_type' => array(
								'type' => 'select',
								'title' => $language['admin']['type'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['configuration_type'],
								'useInList' => $CONFIG['useInListSort'],
								'useInListEdit' => 'y',
								'values' => $ConfigurationTypesSelect,
								'orderby' => $TabFields['ct']['title'].',c.name',
								'tabord' => 'ct.',
								'required' => $CONFIG['AdminReqPatAll'],
								),
				*/

                'configuration_type' => array(
                                'type' => 'hidden',
                                'addVariable' => 'owner',
                ),

				'description' => array(
								'type' => 'textarea',
								'title' => $language['admin']['description'],
								'useInAddForm' => 'y',
								'addVariable' => $_POST['description'],
								'useInList' => $CONFIG['useInListSort'],
								'required' => $CONFIG['AdminReqPatAll'],
								'maxlength' => '255',
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

    //$NoUse['DeleteButton'] = 'y';
    $NoUse['ActivateButton'] = 'y';
    $NoUse['DeactivateButton'] = 'y';
    $NoUse['SendMailsButton'] = 'y';

    if(!__LAMER)
    {
        $NoUse['AddButton'] = 'y';
        $NoUse['DeleteButton'] = 'y';
    }

?>