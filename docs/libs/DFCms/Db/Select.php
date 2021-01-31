<?php

class DFCms_Db_Select extends Zend_Db_Select
{
    protected $SQL_CALC_FOUND_ROWS = 'n';
    static protected $_defaultAdapter;

    static function setDefaultAdapter(Zend_Db_Adapter_Abstract $adapter)
    {
        self::$_defaultAdapter = $adapter;
    }
    static function getDefaultAdapter()
    {
        if(!self::$_defaultAdapter instanceof Zend_Db_Adapter_Abstract)
        {
            throw new DFCms_Db_Exception('Default adapter is not instance of Zend_Db_Adapter_Abstract');
        }
        return self::$_defaultAdapter;
    }
    static public function factory(Zend_Db_Adapter_Abstract $adapter = null)
    {
        return new self($adapter);
    }
    public function __construct(Zend_Db_Adapter_Abstract $adapter = null)
    {
        if(is_null($adapter))
        {
            $adapter = $this->getDefaultAdapter();
        }
        parent::__construct($adapter);
    }
    public function assemble()
    {
        $sql = parent::assemble();
        if($this->SQL_CALC_FOUND_ROWS == 'y')
        {
            $sql = str_replace('SELECT', 'SELECT SQL_CALC_FOUND_ROWS', $sql);
        }
        return $sql;
    }
    public function  fetchAll()
    {
        return $this->getAdapter()->fetchAll($this);
    }

    public function  fetchAssoc()
    {
        return $this->getAdapter()->fetchAssoc($this);
    }
    public function  fetchCol()
    {
        return $this->getAdapter()->fetchCol($this);
    }
    public function  fetchPairs()
    {
        return $this->getAdapter()->fetchPairs($this);
    }
    public function  fetchRow()
    {
        return $this->getAdapter()->fetchRow($this);
    }
    public function calcFoundRows()
    {
        $this->SQL_CALC_FOUND_ROWS = 'y';
        return $this;
    }
    public function foundRows()
    {
        $query = $this->getAdapter()->query('SELECT FOUND_ROWS() AS count')->fetch();
        return $query['count'];
    }
}
