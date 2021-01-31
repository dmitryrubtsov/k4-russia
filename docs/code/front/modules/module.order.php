<?php
/*
if($CART['items'])
{
    unset($CART);
    $sID->assign("cart", $CART);
}
*/
if(!is_array($CART['items']) || $CART['total_count'] == 0)
{
    pageNotFound();
}

    // Список отделений
    $OrderDeliveryArray = DFCms_Db_Select::factory()->from(array('od' => $_SQL_TABLE['order_delivery']))
        ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = od.image_id')
        ->columns(
            array(
                'deliveryTitle' => 'od.title'.__FLANG
            )
        )
        ->where('od.active = 1')
        ->order('od.position')
        ->group('od.order_delivery_id')
        ->fetchAll();

    foreach($OrderDeliveryArray as $n => $value)
    {
        if(is_file(__CFG_CORE_PATH.$value['orig_path']))
        {
            $OrderDeliveryArray[$n]['image'] = $HOST.$value['orig_path'];
        }
    }

    $tpl->assign("OrderDeliveryArray", $OrderDeliveryArray);

    $DeliveryArticle = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
            array(
                'title' => 'title'.__FLANG,
                'text' => 'text'.__FLANG
            )
        )
        ->where('a.article_id = 27')
        ->where('a.active = 1')
        ->fetchRow();

    $tpl->assign('DeliveryArticle', $DeliveryArticle);

    $sID->assign("cart", $CART);
    $tpl->assign("Cart", $CART);



    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['cart'],
        'link' => $BaseURL.'cart'.$CONFIG['webPageFileType'],
    ));

    array_push($Page->ContentPathArr, array(
        'title' => $language['site']['orderPageTitle'],
        'link' => '',
    ));

    $Page->Title = $language['site']['orderPageTitle'];

    $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.order.tpl";


?>