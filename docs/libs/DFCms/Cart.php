<?php

class DFCms_Cart
{
    protected $menu;
    protected $menuSelect;
    protected $menuGroupSelect;
    protected $menuTree;
    protected $menuGroups;

    public function addItemToCart(&$CART, &$Item, $time)
    {
        global $CONFIG, $ERRORS;

        $RowID = $Item['pricetype']."-".$Item['product_id'];
        if(count($CART['items'][$RowID]) == 0)
        {
            $CART['items'][$RowID] = $Item;
            $CART['items'][$RowID]['time'] = $time;
            $this->updateSubtotalOfItemInCart($CART, $RowID);
        }
        /*
        else
        {
            if($time != $CART['items'][$RowID][time])
            {
                if($CART['items'][$RowID]['quantincart'] >= $CONFIG['maxQuantityItemInCart'])
                {
                    showMessageAlertJVSC($ERRORS['shop'][__ERROR_TOO_MUCH_QUANTITY_OF_ITEM_IN_CART]);
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
        */
    }

    public function updateSubtotalOfItemInCart(&$CART, $id)
    {
        $CART['items'][$id]['subtotal'] = $CART['items'][$id]['quantity'] * $CART['items'][$id]['price'];
        $CART['total_count'] = $CART['total_count'] + $CART['items'][$id]['quantity'];
        $CART['total_price'] = $CART['total_price'] + $CART['items'][$id]['subtotal'];
    }

    public function removeItemFromCart(&$CART, $RowID)
    {
        unset($CART['items'][$RowID]);
        $this->calcTotalCart($CART);
    }

    public function updateQuantOfItemInCart(&$CART, $id, $quantity)
    {
        global $CONFIG, $ERRORS;

        $CART['items'][$id]['quantity'] = $quantity;
        $this->updateSubtotalOfItemInCart($CART, $id);
    }

    public function calcTotalCart(&$CART)
    {
        global $CONFIG, $dbSet, $_SQL_TABLE;

        $itemCount = 0;
        $total = 0;
        foreach($CART['items'] as $n => $item)
        {
            $total += $item['subtotal'];
            $itemCount += $item['quantity'];
        }

        $CART['total_count'] = $itemCount;
        $CART['total_price'] = $total;
    }

    /*
    public function __construct($menuSelect, $menuGroupSelect)
    {
        $this->setMenuSelect($menuSelect);
        $this->setMenuGroupSelect($menuGroupSelect);
    }
    public function getMenu($code)
    {
        $nodeId = null;
        foreach($this->getMenuGroups() as $val)
        {
            if($val['code'] == $code)
            {
                $nodeId = $val['menu_id'];
            }
        }
        return $this->getMenuTree()->getNode($nodeId);

    }
    public function get_menu($code = null)
    {
        if(is_null($this->menu))
        {
            $menu = $this->getMenuSelect()->getAdapter()->fetchAssoc($this->getMenuSelect());
            $this->menu = arrayToTree($menu, 0, $rootField='parent_menu_id', $idField='menu_id', $childField='children');
        }
        return $this->menu[$code]['children'];
    }
    public function getMenuSelect()
    {
        if(!$this->menuSelect instanceof Zend_Db_Select)
        {
            throw new DFCms_Exception(' select is not instance of Zend_Db_Select');
        }
        return $this->menuSelect;
    }
    public function setMenuSelect(Zend_Db_Select $menuSelect)
    {
        $this->menuSelect = $menuSelect;
        return $this;
    }
    public function getMenuGroupSelect()
    {
        if(!$this->menuGroupSelect instanceof Zend_Db_Select)
        {
            throw new DFCms_Exception(' select group is not instance of Zend_Db_Select');
        }
        return $this->menuGroupSelect;

    }
    public function setMenuGroupSelect(Zend_Db_Select $menuGroupSelect)
    {
        $this->menuGroupSelect = $menuGroupSelect;
        return $this;

    }
    public function getMenuTree()
    {
        if(!$this->menuTree instanceof Bike_Tree_Abstract)
        {
            $this->setMenuTree(Bike_Tree_ArrayList::factory(array(
                'keyFields' => 'menu_id',
                'parentFields' => 'parent_menu_id',
                'rootKey' => '0',
            ))->setList($this->getMenuSelect()->fetchAll())->buildModel());
        }
//        print_r($this->menuTree);
        return $this->menuTree;

    }
    public function setMenuTree(Bike_Tree_Abstract $tree)
    {
        $this->menuTree = $tree;
        return $this;
    }
    public function setMenuGroups($menuGroups)
    {
        $this->menuGroups = $menuGroups;
        return $this;
    }
    public function getMenuGroups()
    {
        if(!is_array($this->menuGroups))
        {
            $this->setMenuGroups($this->getMenuGroupSelect()->fetchAll());
        }
        return $this->menuGroups;
    }
    */
}
