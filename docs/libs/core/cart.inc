<?php

$RowIDPartsName = array('number');
$ControlRowIDPart = 'number';

function generateRowIDForItem(&$Item, &$RowID)
{

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
{

  generateRowIDForItem($Item, $RowID);
  if(count($CART['items'][$RowID]) == 0)
  {
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
    {
      {
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
  {
  }
}



function calcTicketSum(&$CART)
{
  global $CONFIG, $_SQL_TABLE;
  $sum = 0;
  foreach($CART['tickets'] as $id => $arr)
  {
    if(($CART['total'] - $CART['shipping']['price']) >= $arr['min_sum_apply'])
    {
  	  $todbarr['active'] = 'n';
      $todbarr['date'] = 'NOW()';
      makeUpdateList($strSet, $todbarr, array('date'));
      updateItem($_SQL_TABLE['ticket'], $strSet, 'id', $arr['id']);
    }
    else
    {
      $todbarr['date'] = 'NOW()';
      makeUpdateList($strSet, $todbarr, array('date'));
      updateItem($_SQL_TABLE['ticket'], $strSet, 'id', $arr['id']);
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
{
  foreach($CART['items'] as $id => $arr)
  {
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
  {
  }

  return $profit;
}

function calcTotalCart(&$CART)
{

  $itemCount = 0;
  foreach($CART['items'] as $n => $item)
  {
  	$itemCount += ($item['quantincart'] * $item['ve']);
  }
  $CART['itemsInCart'] = $itemCount;

  $total -= calcTicketSum($CART);

  if(count($CART['items']) > 0)
  {
  	if(isEmptyArr($CART['shipping']))
  	{
 	  $shipping = getTableAsArray($_SQL_TABLE['shipping'], 'price', array("active='y'", "min_items <= '".$CART['itemsInCart']."'", "max_items >= '".$CART['itemsInCart']."'"), 'LIMIT 1', $ShipFields);
 	  $shipping[0]['countries'] = explode($CONFIG['AdminListInRowDelim'], $shipping[0]['country']);
  	  $CART['shipping'] = $shipping[0];
    }
    else
    {
      if(isEmptyArr($shipping))
      {
      }
      $shipping[0]['countries'] = explode($CONFIG['AdminListInRowDelim'], $shipping[0]['country']);
  	  $CART['shipping'] = $shipping[0];
    }
  	$total += $CART['shipping']['price'];
  	if($CONFIG['allowFreeShipping'] == 'y' && $itemCount >= $CONFIG['minCartItemsForFreeShipping'])
  	{
	  $CART['shipping']['price'] = 0;
  	}
  	$total += $CART['insurance'];
  	$total += calcFeesSum($CART);
  }
  $CART['total'] = $total;
  $CART['need_sum'] = $CART['total'] - $CART['shipping']['price'];
}

function removeItemFromCart(&$CART, $RowID)
{
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
{
}

function emptyCart(&$CART)
{
  $CART['tickets'] = array();
  $CART['shipping'] = array();
  $CART['fees'] = array();
  $CART['insurance'] = 0;
  calcTotalCart($CART);
}

function applyInsurance(&$CART)
{
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
{

  if(isEmptyArr($CART['items']))
  {
  	emptyCart($CART);
  	return true;
  }
  foreach($CART['items'] as $RowID => $item)
  {
  	if(isBlank($item[$ControlRowIDPart]) || $item[$ControlRowIDPart] != returnPartOfRowID($RowID, $ControlRowIDPart))
  	{
  	}
  	if($item['discount'] == 0)
  	{
  	}
  }
  if($discountFlag == 0)
  {
  }
  calcTotalCart($CART);
}



?>