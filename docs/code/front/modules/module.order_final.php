<?php

    if($sID->fetch('orderNumber'))
    {
        $Article = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
                array(
                    'text' => 'text'.__FLANG
                )
            )
            ->where('a.article_id = 26')
            ->where('a.active = 1')
            ->fetchRow();

        $tpl->assign('successText', $Article['text']);

        $orderNumber = $sID->fetch('orderNumber');
        $tpl->assign("orderNumber", $orderNumber);

        $sID->assign("cart", $CART);
        $tpl->assign("Cart", $CART);



        /*
            array_push($Page->ContentPathArr, array(
                'title' => $language['front']['cart'],
                'link' => $BaseURL.'cart'.$CONFIG['webPageFileType'],
            ));
        */
        array_push($Page->ContentPathArr, array(
            'title' => $language['site']['orderPageTitle'],
            'link' => '',
        ));

        $Page->Title = $language['site']['orderPageTitle'];


        $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.order_final.tpl";
    }
    else
    {
        pageNotFound();
    }







?>