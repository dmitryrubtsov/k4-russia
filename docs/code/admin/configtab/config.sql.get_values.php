<?php

	if(!isBlank($_GET['cntonly']))
	{
		$_FLAGS['ContentOnly'] = 'y';
		$PageTitle = '"";';

		function addActionsGetItem()
		{
			global $Item, $WorkTableKeyFieldName;

			$Item[$WorkTableKeyFieldName] = 1;
		}
	}

	if($_GET['tsk'] == 'get_menu_blocks')
	{

		if($_GET['resize_win'] == 'y')
		{
			$_FLAGS['ResizeWindowToContentParams'] = __TRUE;
		}

		$_FLAGS['NoReadDB'] = __TRUE;
		$TabFields['mb'] = getFieldNamesWithLangs($_SQL_TABLE['menu_block'], array('title'));
		$MenuBlocksSelect = array_kv(getTableAsArray($_SQL_TABLE['menu_block'], 'id', array("active = 1"), '', 'id,'.$TabFields['mb']['title']), $TabFields['mb']['title'], 'id');

		$_SQL_TABLE_FIELDS[$GlobPart]['menu_blocks'] = array(

								'type' => 'checkboxes',
								'title' => $language['admin']['frontMenuBlocks'],
								'separator' => '<br />',
								'useInAddForm' => 'y',
								'addVariable' => $_POST['menu_blocks'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $MenuBlocksSelect,
								'required' => $CONFIG['AdminReqPatAll'],
								'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
								'joinFunc' => 'y',
								'parentElemID' => '',
								'parentWindowName' => '',
								'position' => 'vertical',
		);

		$NoUse['BackButton'] = 'y';
		$NoUse['SaveItemButton'] = 'y';
		$ItemButtons['makeJoinVals'] = array(
  												'cssClass' => '',
  												'newRow' => '',
  												'img' => 'done_ico.png',
  												'value' => $language['admin']['doneButton'],
  												'onclick' => 'joinElementsmenu_blocks(\''.$CONFIG['AddFormName'].'\');window.close();',
		);
	}
	elseif($_GET['tsk'] == 'get_admin_menus')
	{
		if($_GET['resize_win'] == 'y')
		{
			$_FLAGS['ResizeWindowToContentParams'] = __TRUE;
		}

		$_FLAGS['NoReadDB'] = __TRUE;
		$TabFields['am'] = getFieldNamesWithLangs($_SQL_TABLE['admin_menu'], array('title'));
		$AdminMenuSelect = array_kv(getTableAsArray($_SQL_TABLE['admin_menu'], $TabFields['am']['title'], array(), '', 'admin_menu_id,'.$TabFields['am']['title']), $TabFields['am']['title'], 'admin_menu_id');

		$_SQL_TABLE_FIELDS[$GlobPart]['admin_menu'] = array(

								'type' => 'checkboxes',
								'useInAddFormLocation' => 'full',
								'title' => $language['admin']['adminMenu'],
								'separator' => '</li><li>',
								'useInAddForm' => 'y',
								'addVariable' => $_POST['admin_menu'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $AdminMenuSelect,
								'required' => $CONFIG['AdminReqPatAll'],
								'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
								'joinFunc' => 'y',
								'parentElemID' => '',
								'parentWindowName' => '',
								'position' => 'vertical',
		);

		$NoUse['BackButton'] = 'y';
		$NoUse['SaveItemButton'] = 'y';
		$ItemButtons['makeJoinVals'] = array(
  												'cssClass' => '',
  												'newRow' => '',
  												'img' => 'done_ico.png',
  												'value' => $language['admin']['doneButton'],
  												'onclick' => 'joinElementsadmin_menu(\''.$CONFIG['AddFormName'].'\');window.close();',
		);
	}
	elseif($_GET['tsk'] == 'get_cities')
	{
		if($_GET['resize_win'] == 'y')
		{
			$_FLAGS['ResizeWindowToContentParams'] = __TRUE;
		}

		$_FLAGS['NoReadDB'] = __TRUE;
		$TabFields['ci'] = getFieldNamesWithLangs($_SQL_TABLE['city_info'], array('title'));
		$CitiesSelect = array_kv(getTableAsArray($_SQL_TABLE['city_info'], $TabFields['ci']['title'], '', '', 'city_id,'.$TabFields['ci']['title']), $TabFields['ci']['title'], 'city_id');

		$_SQL_TABLE_FIELDS[$GlobPart]['cities'] = array(

								'type' => 'checkboxes',
								'useInAddFormLocation' => 'full',
								'title' => $language['admin']['cities'],
								'separator' => '</li><li>',
								'useInAddForm' => 'y',
								'addVariable' => $_POST['cities'],
								'useInList' => $CONFIG['useInListSort'],
								'values' => $CitiesSelect,
								//'required' => $CONFIG['AdminReqPatAll'],
								'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
								'joinFunc' => 'y',
								'parentElemID' => '',
								'parentWindowName' => '',
								'position' => 'vertical',
		);

		$NoUse['BackButton'] = 'y';
		$NoUse['SaveItemButton'] = 'y';
		$ItemButtons['makeJoinVals'] = array(
  												'cssClass' => '',
  												'newRow' => '',
  												'img' => 'done_ico.png',
  												'value' => $language['admin']['doneButton'],
  												'onclick' => 'joinElementscities(\''.$CONFIG['AddFormName'].'\');window.close();',
		);
	}
    elseif($_GET['tsk'] == 'get_admin_menu_lists')
    {
        if($_GET['resize_win'] == 'y')
        {
            $_FLAGS['ResizeWindowToContentParams'] = __TRUE;
        }

        $_FLAGS['NoReadDB'] = __TRUE;
        $TabFields['am'] = getFieldNamesWithLangs($_SQL_TABLE['admin_menu'], array('title'));
        $AdminMenuSelect = array_kv(getTableAsArray($_SQL_TABLE['admin_menu'], $TabFields['am']['title'], '', '', 'admin_menu_id,'.$TabFields['am']['title']), $TabFields['am']['title'], 'admin_menu_id');

        $_SQL_TABLE_FIELDS[$GlobPart]['admin_menu_list'] = array(

            'type' => 'checkboxes',
            'useInAddFormLocation' => 'full',
            'title' => $language['admin']['adminMenu'],
            'separator' => '</li><li>',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['admin_menu_list'],
            'useInList' => $CONFIG['useInListSort'],
            'values' => $AdminMenuSelect,
            //'required' => $CONFIG['AdminReqPatAll'],
            'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
            'joinFunc' => 'y',
            'parentElemID' => '',
            'parentWindowName' => '',
            'position' => 'vertical',
        );

        $NoUse['BackButton'] = 'y';
        $NoUse['SaveItemButton'] = 'y';
        $ItemButtons['makeJoinVals'] = array(
            'cssClass' => '',
            'newRow' => '',
            'img' => 'done_ico.png',
            'value' => $language['admin']['doneButton'],
            'onclick' => 'joinElementsadmin_menu_list(\''.$CONFIG['AddFormName'].'\');window.close();',
        );
    }
    elseif($_GET['tsk'] == 'get_admin_user_group')
    {
        if($_GET['resize_win'] == 'y')
        {
            $_FLAGS['ResizeWindowToContentParams'] = __TRUE;
        }

        $_FLAGS['NoReadDB'] = __TRUE;
        $TabFields['aug'] = getFieldNamesWithLangs($_SQL_TABLE['admin_user_group'], array('title'));
        $AdminUserGroupSelect = array_kv(getTableAsArray($_SQL_TABLE['admin_user_group'], 'position', array("active = 1"), '', 'admin_user_group_id,'.$TabFields['aug']['title']), $TabFields['aug']['title'], 'admin_user_group_id');

        $_SQL_TABLE_FIELDS[$GlobPart]['admin_user_group'] = array(

            'type' => 'checkboxes',
            'useInAddFormLocation' => 'full',
            'title' => $language['admin']['adminUserGroups'],
            'separator' => '</li><li>',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['admin_menu_list'],
            'useInList' => $CONFIG['useInListSort'],
            'values' => $AdminUserGroupSelect,
            //'required' => $CONFIG['AdminReqPatAll'],
            'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
            'joinFunc' => 'y',
            'parentElemID' => '',
            'parentWindowName' => '',
            'position' => 'vertical',
        );

        $NoUse['BackButton'] = 'y';
        $NoUse['SaveItemButton'] = 'y';
        $ItemButtons['makeJoinVals'] = array(
            'cssClass' => '',
            'newRow' => '',
            'img' => 'done_ico.png',
            'value' => $language['admin']['doneButton'],
            'onclick' => 'joinElementsadmin_user_group(\''.$CONFIG['AddFormName'].'\');window.close();',
        );
    }
    elseif($_GET['tsk'] == 'get_product_params')
    {
        if($_GET['resize_win'] == 'y')
        {
            $_FLAGS['ResizeWindowToContentParams'] = __TRUE;
        }

        $_FLAGS['NoReadDB'] = __TRUE;
        //$TabFields['ppi'] = getFieldNamesWithLangs($_SQL_TABLE['product_param_info'], array('title'));
        //$AdminUserGroupSelect = array_kv(getTableAsArray($_SQL_TABLE['product_param_info'], 'position', array("active = 1"), '', 'admin_user_group_id,'.$TabFields['aug']['title']), $TabFields['aug']['title'], 'admin_user_group_id');

        $ProductParams = DFCms_Db_Select::factory()->from(array('pp' => $_SQL_TABLE['product_param']))
            ->join(array('ppi' => $_SQL_TABLE['product_param_info']), 'ppi.product_param_id = pp.product_param_id', array(
                'product_param_id',
                'title'.__FLANG.' AS title'
            ))
            ->where('pp.active = 1')
            ->fetchAll();

        $ProductParamsSelect = array_kv($ProductParams, 'title', 'product_param_id');

        $_SQL_TABLE_FIELDS[$GlobPart]['product_params'] = array(

            'type' => 'checkboxes',
            'useInAddFormLocation' => 'full',
            'title' => $language['admin']['productParams'],
            'separator' => '</li><li>',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['product_params'],
            'useInList' => $CONFIG['useInListSort'],
            'values' => $ProductParamsSelect,
            //'required' => $CONFIG['AdminReqPatAll'],
            'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
            'joinFunc' => 'y',
            'parentElemID' => '',
            'parentWindowName' => '',
            'position' => 'vertical',
        );

        $NoUse['BackButton'] = 'y';
        $NoUse['SaveItemButton'] = 'y';
        $ItemButtons['makeJoinVals'] = array(
            'cssClass' => '',
            'newRow' => '',
            'img' => 'done_ico.png',
            'value' => $language['admin']['doneButton'],
            'onclick' => 'joinElementsproduct_params(\''.$CONFIG['AddFormName'].'\');window.close();',
        );
    }
    elseif($_GET['tsk'] == 'get_product_recommend')
    {
        if($_GET['resize_win'] == 'y')
        {
            $_FLAGS['ResizeWindowToContentParams'] = __TRUE;
        }

        $_FLAGS['NoReadDB'] = __TRUE;

        $ProductRecommend = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']))
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = p.product_id', array(
                'product_id',
                'title'.__FLANG.' AS title'
            ))
            ->where('p.active = 1')
            ->order('pi.title'.__FLANG.' ASC')
            ->fetchAll();

        $ProductRecommendSelect = array_kv($ProductRecommend, 'title', 'product_id');

        $_SQL_TABLE_FIELDS[$GlobPart]['product_recommend'] = array(

            'type' => 'checkboxes',
            'useInAddFormLocation' => 'full',
            'title' => $language['admin']['productRecommend'],
            'separator' => '</li><li>',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['product_recommend'],
            'useInList' => $CONFIG['useInListSort'],
            'values' => $ProductRecommendSelect,
            //'required' => $CONFIG['AdminReqPatAll'],
            'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
            'joinFunc' => 'y',
            'parentElemID' => '',
            'parentWindowName' => '',
            'position' => 'vertical',
        );

        $NoUse['BackButton'] = 'y';
        $NoUse['SaveItemButton'] = 'y';
        $ItemButtons['makeJoinVals'] = array(
            'cssClass' => '',
            'newRow' => '',
            'img' => 'done_ico.png',
            'value' => $language['admin']['doneButton'],
            'onclick' => 'joinElementsproduct_recommend(\''.$CONFIG['AddFormName'].'\');window.close();',
        );
    }
    elseif($_GET['tsk'] == 'get_product_mapping_block')
    {
        if($_GET['resize_win'] == 'y')
        {
            $_FLAGS['ResizeWindowToContentParams'] = __TRUE;
        }

        $_FLAGS['NoReadDB'] = __TRUE;

        $ProductMappingBlocks = DFCms_Db_Select::factory()->from(array('pmb' => $_SQL_TABLE['product_mapping_block']), array(
                'product_mapping_block_id',
                'title'.__FLANG.' AS title'
            ))
            ->where('pmb.active = 1')
            ->fetchAll();

        $ProductMappingBlocksSelect = array_kv($ProductMappingBlocks, 'title', 'product_mapping_block_id');

        $_SQL_TABLE_FIELDS[$GlobPart]['product_mapping_block'] = array(

            'type' => 'checkboxes',
            'useInAddFormLocation' => 'full',
            'title' => $language['admin']['productMappingBlocks'],
            'separator' => '</li><li>',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['product_mapping_block'],
            'useInList' => $CONFIG['useInListSort'],
            'values' => $ProductMappingBlocksSelect,
            //'required' => $CONFIG['AdminReqPatAll'],
            'selected' => explode($CONFIG['AdminListInRowDelim'], $_GET['currval']),
            'joinFunc' => 'y',
            'parentElemID' => '',
            'parentWindowName' => '',
            'position' => 'vertical',
        );

        $NoUse['BackButton'] = 'y';
        $NoUse['SaveItemButton'] = 'y';
        $ItemButtons['makeJoinVals'] = array(
            'cssClass' => '',
            'newRow' => '',
            'img' => 'done_ico.png',
            'value' => $language['admin']['doneButton'],
            'onclick' => 'joinElementsproduct_mapping_block(\''.$CONFIG['AddFormName'].'\');window.close();',
        );
    }


	$_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');


?>