<?php

    $WorkTableKeyFieldName = 'main_slider_element_id';

    $WorkTableKeyVarName = $CONFIG['keyVarPrefix'] . $WorkTableKeyFieldName;
    $WorkTable = $_SQL_TABLE['main_slider_element'];

    $mainSliderElementTagrets = array(
        '' => $language['admin']['selectMainSliderElementVariant'],
        '1' => $language['admin']['mainSliderElementText'],
        '2' => $language['admin']['mainSliderElementImage'],
        '3' => $language['admin']['mainSliderElementButton'],
    );

    $mainSlides = DFCms_Db_Select::factory()->from(array('ms' => $_SQL_TABLE['main_slider']), array(
            'main_slider_id',
            'title'.__FLANG." AS title"
        ))
        ->where('ms.active = 1')
        ->order('ms.position ASC')
        ->fetchAll();
    $mainSlidesSelect = array_kv($mainSlides, 'title', 'main_slider_id');

    if ($_REQUEST['mode'] == $GlobPart)
    {
        //$PageTitle = '$language["admin"]["mainSliderElement"]." :: ".$Item["' . $TabFields['pi']['title'] . '"];';
        $PageTitle = '$language["admin"]["mainSliderElement"];';
    }
    else
    {
        $PageTitle = '$language["admin"]["mainSliderElements"];';
        $AloneMode = $GlobPart;

        $emptyPageTooltip = $language['admin']['mainSliderElementsEmptyList'];


        $Query['FromTables'] = $WorkTable . " mse
            LEFT JOIN " . $_SQL_TABLE['main_slider'] . " ms ON ms.main_slider_id = mse.main_slider_id
        ";
        $Query['Fields'] = "mse.*, ms.title".__FLANG." AS main_slider_id";
        $Query['TabOrder'] = "mse.";
        $Query['Where'] = "";
        $Query['GroupBy'] = "mse." . $WorkTableKeyFieldName;

        if(!$listInfo['order'])
        {
            $listInfo['order'] = "data_start";
            $listInfo['order_type'] = "ASC";
        }

        $EnableFilter = true;

        $listInfo['where']['main_slider_id'] = array(
            'simple' => 'y',
            'SQLField' => "mse.main_slider_id = '".$_REQUEST['main_slider_id']."'",
            'type' => 'select',
            'title' => $language['admin']['mainSlider'],
            'values' => array('' => $language['admin']['all']) + $mainSlidesSelect,
            'JSact' => '',
        );

        $listInfo['where']['type'] = array(
            'simple' => 'y',
            'SQLField' => "mse.type = '".$_REQUEST['type']."'",
            'type' => 'select',
            'title' => $language['admin']['mainSliderElementVariant'],
            'values' => $mainSliderElementTagrets,
            'JSact' => '',
        );

        require_once __CFG_PATH_CODE."admin.filter.inc";
    }

/*
$ConfLangArr = array(

        'title_' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_info'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['title'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST,
            'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatAll'],
            'maxlength' => '255',
            'size' => '60',
        ),
    );

    $GeneratedLangArr = getAdminConfigArrayWithLangs($ConfLangArr, $SITE_LANGS);
*/
    $_SQL_TABLE_FIELDS[$GlobPart] = /*$GeneratedLangArr + */array(

        'main_slider_id' => array(
            'type' => 'select',
            'title' => $language['admin']['mainSlider'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['main_slider_id'],
            'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatAll'],
            'values' => array('' => $language['admin']['selectMainSliderForElement']) + $mainSlidesSelect,
        ),

        'data_x' => array(
            'type' => 'input',
            'title' => $language['admin']['mainSliderElementDataX'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['data_x'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '3',
        ),

        'data_y' => array(
            'type' => 'input',
            'title' => $language['admin']['mainSliderElementDataY'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['data_y'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '3',
        ),

        'data_speed' => array(
            'type' => 'input',
            'title' => $language['admin']['mainSliderElementDataSpeed'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['data_speed'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '4',
        ),

        'data_start' => array(
            'type' => 'input',
            'title' => $language['admin']['mainSliderElementDataStart'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['data_start'],
            'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '4',
        ),

        'type' => array(
            'type' => 'select',
            'title' => $language['admin']['mainSliderElementVariant'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['type'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatAll'],
            'values' => $mainSliderElementTagrets,
            'textUnderField' => '<span class="red">'.$language['admin']['mainSliderElementVariantTooltip'].'</span>',
        ),

        'text' => array(
            'type' => 'input',
            'title' => $language['admin']['textForMainSliderText'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['text'],
            //'useInList' => $CONFIG['useInListSort'],
            //'required' => $CONFIG['AdminReqPatAll'],
            'maxlength' => '255',
        ),

        'text_colorcode' => array(
            'type' => 'input',
            'title' => $language['admin']['colorcodeForMainSliderText'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['text_colorcode'],
            //'useInList' => $CONFIG['useInListSort'],
            //'required' => $CONFIG['AdminReqPatAll'],
            'maxlength' => '7',
            'textUnderField' => '<span class="red">'.$language['admin']['colorcodeForMainSliderTextTooltip'].'</span>',
        ),

        'image_id' => array(
            'type' => 'image',
            //'useInAddFormLocation' => 'full',
            'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
            'filenameLength' => 12,
            'filenameSymbols' => 'DL',
            'filePathFolderCount' => 4,
            'filePathFolderSymbol' => 2,
            'addVariable' => $_POST['image_id'],
            'sizes' => array(
                'orig' => array(
                    'handler' => null,
                    'folderName' => 'orig',
                    'tableFieldPath' => 'orig_path',
                    'tableFieldWidth' => 'orig_width',
                    'tableFieldHeight' => 'orig_height',
                ),
            ),
            'title' => $language['admin']['imageForMainSliderImage'],
            'useInAddForm' => 'y',
            'noResize' => 'y',
            //'notUsedInDB' => 'y',
            'useFTP' => 'y',
            //'remoteServerLink' => $CONFIG['FTPImageServerURL'],
            'FTP' => array(
                'ftpServer' => __CFG_PTF_HOSTNAME,
                'ftpUserName' => __CFG_PTF_USERNAME,
                'ftpPassword' => __CFG_PTF_PASSWORD,
                'ftpRootPath' => __CFG_PTF_CORE_PATH,
            ),
            //'listOfRelations' => 'y',
            //'relationType' => 'idOne',
            'storeFolder' => 'image',
            'storeTable' => array(
                'keyField' => 'image_id',
                'tableName' => $_SQL_TABLE['image'],
                'tableInfoName' => $_SQL_TABLE['image_info'],
            ),
        ),

        'button_text' => array(
            'type' => 'input',
            'title' => $language['admin']['textForMainSliderButton'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['button_text'],
            //'useInList' => $CONFIG['useInListSort'],
            //'required' => $CONFIG['AdminReqPatAll'],
            'maxlength' => '50',
        ),

        'link' => array(
            'type' => 'input',
            'title' => $language['admin']['linkForMainSliderElements'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['link'],
            //'useInList' => $CONFIG['useInListSort'],
            //'required' => $CONFIG['AdminReqPatAll'],
            'maxlength' => '255',
            'textUnderField' => '<span class="red">'.$language['admin']['linkForMainSliderElementsTooltip'].'</span>',
        ),

        /*
        'price' => array(
            'type' => 'input',
            'title' => $language['admin']['price'],
            'useInAddForm' => 'y',
            'addVariable' => str_replace(',','.',$_POST['price']),
            //'useInList' => $CONFIG['useInListSort'],
            //'inListEdit' => 'list_input',
            //'useInListEdit' => 'y',
            'required' => $CONFIG['AdminReqPatPrice'],
            //'maxlength' => '6',
            //'size' => '7',
            //'textAfterField' => $CONFIG['currencySymbol'],
            'textUnderField' => '<span class="red">'.$language['admin']['priceFieldTooltip'].'</span>',
        ),

        'old_price' => array(
            'type' => 'input',
            'title' => $language['admin']['oldPrice'],
            'useInAddForm' => 'y',
            'addVariable' => str_replace(',','.',$_POST['old_price']),
            //'useInList' => $CONFIG['useInListSort'],
            //'inListEdit' => 'list_input',
            //'useInListEdit' => 'y',
            //'required' => $CONFIG['AdminReqPatPrice'],
            //'maxlength' => '6',
            //'size' => '7',
            //'textAfterField' => $CONFIG['currencySymbol'],
            'textUnderField' => '<span class="red">'.$language['admin']['oldPriceFieldTooltip'].'</span>',
        ),

        'price2' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_info'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['price2Title'],
            'useInAddForm' => 'y',
            'addVariable' => str_replace(',','.',$_POST['price2']),
            'textUnderField' => '<span class="red">'.$language['admin']['extraPriceFieldTooltip'].'</span>',
        ),

        'price3' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_info'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['price3Title'],
            'useInAddForm' => 'y',
            'addVariable' => str_replace(',','.',$_POST['price3']),
            'textUnderField' => '<span class="red">'.$language['admin']['extraPriceFieldTooltip'].'</span>',
        ),

        'width' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_param_value'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['productParamWidth'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['width'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '10',
            'textUnderField' => '<span class="red">'.$language['admin']['productParamWidthTooltip'].'</span>',
        ),

        'height' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_param_value'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['productParamHeight'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['height'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '10',
            'textUnderField' => '<span class="red">'.$language['admin']['productParamHeightTooltip'].'</span>',
        ),

        'scale' => array(
            'type' => 'input',
            'subTable' => array(
                'table' => $_SQL_TABLE['product_param_value'],
                'primaryKey' => $WorkTableKeyFieldName,
            ),
            'title' => $language['admin']['productParamScale'],
            'useInAddForm' => 'y',
            'addVariable' => $_POST['scale'],
            //'useInList' => $CONFIG['useInListSort'],
            'required' => $CONFIG['AdminReqPatDigits'],
            'maxlength' => '10',
            'textUnderField' => '<span class="red">'.$language['admin']['productParamScaleTooltip'].'</span>',
        ),

        'position' => array(
            'type' => 'input',
            'title' => $language['admin']['position'],
            'size' => '3',
            'useInAddForm' => 'y',
            'addVariable' => $_POST['position'],
            'useInList' => $CONFIG['useInListSort'],
            'allowEmpty' => 'y',
            'inListEdit' => 'list_input',
            'useInListEdit' => 'y',
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
            //'useInList' => $CONFIG['useInListSort'],
            'useInListEdit' => 'y',
        ),
/*


        'image_item_id' => array(
            'type' => 'image',
            //'useInAddFormLocation' => 'full',
            'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
            'filenameLength' => 12,
            'filenameSymbols' => 'DL',
            'filePathFolderCount' => 4,
            'filePathFolderSymbol' => 2,
            'addVariable' => $_POST['image_item_id'],
            'sizes' => array(
                'orig' => array(
                    'handler' => null,
                    'folderName' => 'orig',
                    'tableFieldPath' => 'orig_path',
                    'tableFieldWidth' => 'orig_width',
                    'tableFieldHeight' => 'orig_height',
                ),
            ),
            'title' => $language['admin']['productImageOnPages'],
            'useInAddForm' => 'y',
            'noResize' => 'y',
            //'notUsedInDB' => 'y',
            'useFTP' => 'y',
            //'remoteServerLink' => $CONFIG['FTPImageServerURL'],
            'FTP' => array(
                'ftpServer' => __CFG_PTF_HOSTNAME,
                'ftpUserName' => __CFG_PTF_USERNAME,
                'ftpPassword' => __CFG_PTF_PASSWORD,
                'ftpRootPath' => __CFG_PTF_CORE_PATH,
            ),
            'storeFolder' => 'image',
            'storeTable' => array(
                'keyField' => 'image_id',
                'tableName' => $_SQL_TABLE['image'],
                'tableInfoName' => $_SQL_TABLE['image_info'],
            ),
        ),

        'image_item_hover_id' => array(
            'type' => 'image',
            //'useInAddFormLocation' => 'full',
            'filetype' => array('.jpg', '.jpeg', '.png', '.gif'),
            'filenameLength' => 12,
            'filenameSymbols' => 'DL',
            'filePathFolderCount' => 4,
            'filePathFolderSymbol' => 2,
            'addVariable' => $_POST['image_item_hover_id'],
            'sizes' => array(
                'orig' => array(
                    'handler' => null,
                    'folderName' => 'orig',
                    'tableFieldPath' => 'orig_path',
                    'tableFieldWidth' => 'orig_width',
                    'tableFieldHeight' => 'orig_height',
                ),
            ),
            'title' => $language['admin']['productImageOnPagesHover'],
            'useInAddForm' => 'y',
            'noResize' => 'y',
            //'notUsedInDB' => 'y',
            'useFTP' => 'y',
            //'remoteServerLink' => $CONFIG['FTPImageServerURL'],
            'FTP' => array(
                'ftpServer' => __CFG_PTF_HOSTNAME,
                'ftpUserName' => __CFG_PTF_USERNAME,
                'ftpPassword' => __CFG_PTF_PASSWORD,
                'ftpRootPath' => __CFG_PTF_CORE_PATH,
            ),
            'storeFolder' => 'image',
            'storeTable' => array(
                'keyField' => 'image_id',
                'tableName' => $_SQL_TABLE['image'],
                'tableInfoName' => $_SQL_TABLE['image_info'],
            ),
        ),
*/


    );

    $_SQL_TABLE_EDIT_FORMS[$GlobPart] = array('active');

    ?>