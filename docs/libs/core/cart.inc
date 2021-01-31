<?php

$RowIDPartsName = array('number');
$ControlRowIDPart = 'number';

function generateRowIDForItem(&$Item, &$RowID)
{  global $CONFIG, $RowIDPartsName;

  foreach($RowIDPartsName as $n => $val)
  {
    $RowIDParts[$n] = $Item[$val];
  }
  $RowID = join($CONFIG['ItemIDDelimiterInCart'], $RowIDParts);
}

function returnPartOfRowID($RowID, $PartName)
{
  global $CONFIG, $RowIDPartsName;

  $RowIDParts = explode($CONFIG['ItemIDDelimiterInCart'], $RowID);
  foreach($RowIDPartsName as $n => $val)
  {
    if($val == $PartName)
    {
      return $RowIDParts[$n];
    }
  }
}

function addItemToCart(&$CART, &$Item, $time)
{  global $CONFIG, $ERRORS;

  generateRowIDForItem($Item, $RowID);
  if(count($CART['items'][$RowID]) == 0)
  {  	if(count($CART['items']) >= $CONFIG['maxCartItems'])
    {
      showMessageAlertJVSC($ERRORS['shop'][__ERROR_CART_IS_FULL]);
      go_toJVSC(getSameUri());
      exit;
    }
    else
    {

	      $CART['items'][$RowID] = $Item;
	      $CART['items'][$RowID]['quantincart'] = 1;
	      $CART['items'][$RowID]['time'] = $time;
	      $CART['items'][$RowID]['profit'] = $Item['price'] - $Item['costprice'];
	      updateSubtotalOfItemInCart($CART, $RowID);
	}
  }
  else
  {
    if($time != $CART['items'][$RowID][time])
    {      if($CART['items'][$RowID]['quantincart'] >= $CONFIG['maxQuantityItemInCart'])
      {      	showMessageAlertJVSC($ERRORS['shop'][__ERROR_TOO_MUCH_QUANTITY_OF_ITEM_IN_CART]);
		go_toJVSC(getSameUri());
		exit;
      }
      else
      {
        $CART['items'][$RowID]['time'] = $time;
        $CART['items'][$RowID]['quantincart']++;
        updateSubtotalOfItemInCart($CART, $RowID);
      }
    }
  }
}

function addTicketToCart(&$CART, &$Item, $time)
{
  global $CONFIG;
  if(count($CART['tickets'][$Item['id']]) == 0 && count($CART['tickets']) < $CONFIG['countOfAllowedTickets'])
  {
      $CART['tickets'][$Item['id']] = $Item;
      $CART['tickets'][$Item['id']]['time'] = $time;
  }
  elseif(count($CART['tickets']) >= $CONFIG['countOfAllowedTickets'])
  {    return true;
  }
}



function calcTicketSum(&$CART)
{
  global $CONFIG, $_SQL_TABLE;
  $sum = 0;
  foreach($CART['tickets'] as $id => $arr)
  {
    if(($CART['total'] - $CART['shipping']['price']) >= $arr['min_sum_apply'])
    {  	  $sum += $arr['discount'];
  	  $todbarr['active'] = 'n';
      $todbarr['date'] = 'NOW()';
      makeUpdateList($strSet, $todbarr, array('date'));
      updateItem($_SQL_TABLE['ticket'], $strSet, 'id', $arr['id']);
    }
    else
    {      $todbarr['active'] = 'y';
      $todbarr['date'] = 'NOW()';
      makeUpdateList($strSet, $todbarr, array('date'));
      updateItem($_SQL_TABLE['ticket'], $strSet, 'id', $arr['id']);    }
  }
  return $sum;
}


function calcFeesSum(&$CART)
{
  $sum = 0;
  foreach($CART['fees'] as $id => $arr)
  {
  	$sum += $arr['fee'];
  }
  return $sum;
}

function calcItemsProfit(&$CART)
{  $profit = 0;
  foreach($CART['items'] as $id => $arr)
  {  	$profit += ($arr['profit'] * $arr['quantincart']);
  }
  return $profit;
}

function calcCartProfit(&$CART)
{
  global $CONFIG;
  $profit = 0;
  $profit += calcItemsProfit($CART);
  $profit -= calcTicketSum($CART);
  $profit += calcFeesSum($CART);
  $profit += ($CART['shipping']['price'] - $CART['shipping']['cost_price']);
  if($CART['insurance'] > 0)
  {  	$profit += ($CART['insurance'] - $CONFIG['InsuranceDillerPrice']);
  }

  return $profit;
}

function calcTotalCart(&$CART)
{  global $CONFIG, $dbSet, $_SQL_TABLE;

  $itemCount = 0;
  foreach($CART['items'] as $n => $item)
  {  	$total += $item['subtotal'];
  	$itemCount += ($item['quantincart'] * $item['ve']);
  }
  $CART['itemsInCart'] = $itemCount;

  $total -= calcTicketSum($CART);

  if(count($CART['items']) > 0)
  {  	$ShipFields = 'title'.__FLANG.' AS title, price, cost_price, code, country';
  	if(isEmptyArr($CART['shipping']))
  	{
 	  $shipping = getTableAsArray($_SQL_TABLE['shipping'], 'price', array("active='y'", "min_items <= '".$CART['itemsInCart']."'", "max_items >= '".$CART['itemsInCart']."'"), 'LIMIT 1', $ShipFields);
 	  $shipping[0]['countries'] = explode($CONFIG['AdminListInRowDelim'], $shipping[0]['country']);
  	  $CART['shipping'] = $shipping[0];
    }
    else
    {      $shipping = getTableAsArray($_SQL_TABLE['shipping'], 'price', array("active='y'","code='".$CART['shipping']['code']."'", "min_items <= '".$CART['itemsInCart']."'", "max_items >= '".$CART['itemsInCart']."'"), 'LIMIT 1', $ShipFields);
      if(isEmptyArr($shipping))
      {        $shipping = getTableAsArray($_SQL_TABLE['shipping'], 'price', array("active='y'", "min_items <= '".$CART['itemsInCart']."'", "max_items >= '".$CART['itemsInCart']."'"), 'LIMIT 1', $ShipFields);
      }
      $shipping[0]['countries'] = explode($CONFIG['AdminListInRowDelim'], $shipping[0]['country']);
  	  $CART['shipping'] = $shipping[0];
    }
  	$total += $CART['shipping']['price'];
  	if($CONFIG['allowFreeShipping'] == 'y' && $itemCount >= $CONFIG['minCartItemsForFreeShipping'])
  	{	  $total -= $CART['shipping']['price'];
	  $CART['shipping']['price'] = 0;
  	}
  	$total += $CART['insurance'];
  	$total += calcFeesSum($CART);
  }
  $CART['total'] = $total;
  $CART['need_sum'] = $CART['total'] - $CART['shipping']['price'];
}

function removeItemFromCart(&$CART, $RowID)
{  unset($CART['items'][$RowID]);
}

function updateQuantOfItemInCart(&$CART, $id, $quantity)
{
  global $CONFIG, $ERRORS;
  if($quantity > $CONFIG['maxQuantityItemInCart'])
  {
   	showMessageAlertJVSC($ERRORS['shop'][__ERROR_TOO_MUCH_QUANTITY_OF_ITEM_IN_CART]);
	go_toJVSC(getSameUri());
  	exit;
  }
  else
  {
    $CART['items'][$id]['quantincart'] = $quantity;
    updateSubtotalOfItemInCart($CART, $id);
  }
}

function updateSubtotalOfItemInCart(&$CART, $id)
{  $CART['items'][$id]['subtotal'] = $CART['items'][$id]['quantincart'] * $CART['items'][$id]['price'];
}

function emptyCart(&$CART)
{  $CART['items'] = array();
  $CART['tickets'] = array();
  $CART['shipping'] = array();
  $CART['fees'] = array();
  $CART['insurance'] = 0;
  calcTotalCart($CART);
}

function applyInsurance(&$CART)
{  $CART['insurance'] = $_POST['insurval'];
}

function applyShippingMethod(&$CART)
{
  $CART['shipping'] = array('code' => $_POST['item']);
}

function applyFee(&$CART, $Fee)
{
  $CART['fees'][$Fee['cartcode']] = $Fee;
}

function cleanCart(&$CART)
{  global $ControlRowIDPart;

  if(isEmptyArr($CART['items']))
  {
  	emptyCart($CART);
  	return true;
  }
  foreach($CART['items'] as $RowID => $item)
  {
  	if(isBlank($item[$ControlRowIDPart]) || $item[$ControlRowIDPart] != returnPartOfRowID($RowID, $ControlRowIDPart))
  	{  	  removeItemFromCart($CART, $RowID);
  	}
  	if($item['discount'] == 0)
  	{  	  $discountFlag = 1;
  	}
  }
  if($discountFlag == 0)
  {  	$CART['tickets'] = array();
  }
  calcTotalCart($CART);
}



?>