<?php

/*if($CART['items'])
{
    unset($CART);
}
*/

    if($_POST['task'] == 'addtocart')
    {
        $Item = $_POST;
        $productInfo = DFCms_Db_Select::factory()->from(array('p' => $_SQL_TABLE['product']))
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = p.product_id',
                array(
                    'title' => 'title'.__FLANG,
                    'description' => 'description'.__FLANG,
                    'number',
                    'price2',
                    'price3'
                )
            )
            ->join(array('pm' => $_SQL_TABLE['product_meta']), 'pm.product_id = p.product_id',
                array(
                    'meta_title' => 'meta_title'.__FLANG,
                    'meta_keywords' => 'meta_keywords'.__FLANG,
                    'meta_description' => 'meta_description'.__FLANG
                )
            )
            ->join(array('pc' => $_SQL_TABLE['product_category']), 'pc.product_category_id = p.product_category_id',
                array(
                    'product_section_id'
                )
            )
            ->join(array('pci' => $_SQL_TABLE['product_category_info']), 'pci.product_category_id = p.product_category_id',
                array(
                    'category_title' => 'title'.__FLANG,
                    'product_category_id',
                    'category_linkname' => 'linkname'
                )
            )
            ->joinleft(array('ppv' => $_SQL_TABLE['product_param_value']), 'ppv.product_id = p.product_id',
                array(
                    'product_width' => 'width',
                    'product_height' => 'height',
                    'product_scale' => 'scale'
                )
            )
            ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_logo_id',
                array(
                    'item_image' => 'orig_path'
                )
            )
            ->where('p.active = 1')
            ->where('p.product_id = '.$Item['id'])
            ->fetchRow();
        $productInfo['pricetype'] = $_POST['pricetype'];
        $productInfo['price'] = $productInfo[$_POST['pricetype']];
        $productInfo['quantity'] = $_POST['quantity'];
        $productInfo['category_link'] = $BaseURL.'catalog'.$CONFIG['linkPartSeparator'].$productInfo['category_linkname'].$CONFIG['AdminLinkNameDelim'].$productInfo['product_category_id'].$CONFIG['webPageFileType'];
        $productInfo['product_link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$productInfo['product_id'].$CONFIG['webPageFileType'];

        if(is_file(__CFG_CORE_PATH.$productInfo['item_image']))
        {
            $productInfo['logo'] = $HOST.$productInfo['item_image'];
        }
        else
        {
            $productInfo['logo'] = $HOST.$CONFIG['MainImageFolder'].'items/item_logo.jpg';
        }
        $productInfo['test'] = 'test';

        $CartClass->addItemToCart($CART, $productInfo, $Item['time']);
        $sID->assign("cart", $CART);
        $CART = $sID->fetch('cart');
    }
    elseif($_POST['task'] == 'deletefromcart')
    {
        $CartClass->removeItemFromCart($CART, $_POST['row']);
        $CartClass->calcTotalCart($CART);
        $sID->assign("cart", $CART);
        $CART = $sID->fetch('cart');
    }
    elseif($_POST['task'] == 'updatecart')
    {
        foreach($_POST['cart'] as $id => $quantity)
        {
            if($quantity > 0)
            {
                $CartClass->updateQuantOfItemInCart($CART, $id, $quantity);
            }
            else
            {
                $CartClass->removeItemFromCart($CART, $id);
            }
        }
        $CartClass->calcTotalCart($CART);
        $sID->assign("cart", $CART);
        $CART = $sID->fetch('cart');
    }
/*

elseif($_POST['task'] == 'updatequantincart')
{
  foreach($_POST['quantincart'] as $id => $quantity)
  {
  	if($quantity > 0)
  	{
  	  updateQuantOfItemInCart($CART, $id, $quantity);
  	}
  	else
  	{
  	  removeItemFromCart($CART, $id);
  	}
  }
  calcTotalCart($CART);
  $sID->assign("cart", $CART);
  $CART = $sID->fetch('cart');
}
elseif($_POST['task'] == 'emptycart')
{
  emptyCart($CART);
  calcTotalCart($CART);
  $sID->assign("cart", $CART);
  $CART = $sID->fetch('cart');
}
elseif($_POST['task'] == 'applyshippingmethod')
{
	applyShippingMethod($CART);
}


elseif($_POST['task'] == 'addticket')
{
  $ticket = getCurrentTicketByField('code', strtolower($_POST['code']), $CONFIG['defaultDiscountType']);
  if($ticket['code'] != strtolower($_POST['code']))
  {
  	showMessageAlertJVSC($ERRORS['shop'][__ERROR_WRONG_VOUCHER_CODE]);
  	go_toJVSC(getSameUri());
    exit();
  }
  elseif($ticket['active'] == 'n')
  {
  	showMessageAlertJVSC($ERRORS['shop'][__VOUCHER_DOUBLE_USE_CODE_ERROR]);
  	go_toJVSC(getSameUri());
    exit();
  }
  else
  {
    $_SESSION['tickets'] = $ticket;
    $_SESSION['isdiscount'] = 'yes';
    if(addTicketToCart($CART, $ticket, time()))
    {
      go_toJVSC(getSameUri());
      exit();
    }

    calcTotalCart($CART);
    $sID->assign("cart", $CART);
    $CART = $sID->fetch('cart');
    go_toJVSC(getSameUri());
    exit();
  }
}
elseif($_POST['task'] == 'deleteticket')
{
  $_SESSION['isdiscount'] = 'none';
  unset($CART['tickets']);
  $todbarr['active'] = 'y';
  $todbarr['date'] = 'NOW()';
  makeUpdateList($strSet, $todbarr, array('date'));
  updateItem($_SQL_TABLE['ticket'], $strSet, 'id', $_POST['item']);
  calcTotalCart($CART);
  $sID->assign("cart", $CART);
  $CART = $sID->fetch('cart');
}

cleanCart($CART);
if($CONFIG['useShoppingCart'] == 'n' && !isEmptyArr($CART['items']))
{
  $sID->assign('checkoutstep', $currCheckoutStep['nextStep']);
  go_to(getPath().$currCheckoutStep['nextPage'].$CONFIG['webPageFileType']);
  exit;
}
elseif($CONFIG['useShoppingCart'] == 'n' && isEmptyArr($CART['items']))
{
  go_to(getPath());
  exit;
}


$ShippingMethods = getTableAsArrayByKeyField($_SQL_TABLE['shipping'], 'code', 'title'.__FLANG, array("active='y'", "min_items <= '".$CART['itemsInCart']."'", "max_items >= '".$CART['itemsInCart']."'"), '', $fields='title'.__FLANG.' AS title, price, code, country');
$Countries = getTableAsArrayByKeyField($_SQL_TABLE['country'], $CONFIG['CountryCodeField'], 'title'.__FLANG, array("active='y'"), '', $fields='title'.__FLANG.' AS title, '.$CONFIG['CountryCodeField']);
foreach($ShippingMethods as $n => $arr)
{
  $ShippingMethods[$n]['countries'] = explode($CONFIG['AdminListInRowDelim'], $arr['country']);
}
$tpl->assign("ShippingMethods", $ShippingMethods);
$tpl->assign("Countries", $Countries);

$isCart = $CONFIG['discountVoucher'];
$tpl->assign("isCart", $isCart);
*/

    //print_r(substr($CART['total_count'], -2));

//print_r($CART);

    $sID->assign("cart", $CART);
    $tpl->assign("Cart", $CART);

    $Page->Title = $language['front']['cart'];

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['cart'],
        'link' => '',
    ));


    $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.cart.tpl";


?>