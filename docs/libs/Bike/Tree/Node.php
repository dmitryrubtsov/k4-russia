<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Bike_Initial
	 */
	require_once 'Bike/Initial.php';


	class Bike_Tree_Node extends Bike_Initial
	{
		const MULTI_OPTIONS_PREFIX = '   ';

		protected $_key;
		protected $_parentKey;
		protected $_item;
		protected $_parentNode;
		protected $_childNodes;
		protected $_childPositions = array();
		protected $_tree;

		public function &getItem()
		{
			return $this->_item;
		}

		public function setItem(&$item)
		{
			$this->_item = &$item;
			return $this;
		}

		public function setTree(Bike_Tree_Abstract $tree)
		{
			$this->_tree = $tree;
			return $this;
		}

		public function getTree()
		{
			if(!$this->_tree instanceof Bike_Tree_Abstract)
			{
				require_once 'Bike/Tree/Exception.php';
				throw new Bike_Tree_Exception('Undefined node tree');
			}
			return $this->_tree;
		}

		public function getKey()
		{
			return (array) $this->_key;
		}

		public function getKeySerialized()
		{
			return $this->getTree()->serializeKey($this->getKey());
		}

		public function setKey(array $key)
		{
			$this->_key = $key;
			return $this;
		}

		public function getParentKey()
		{
			return (array) $this->_parentKey;
		}

		public function getParentKeySerialized()
		{
			return $this->getTree()->serializeKey($this->getParentKey());
		}

		public function setParentKey($parentKey)
		{
			$this->_parentKey = $parentKey;
			return $this;
		}

		public function getParentNode()
		{
			if(!$this->_parentNode instanceof self)
			{
				require_once 'Bike/Tree/Exception.php';
				throw new Bike_Tree_Exception('Undefined parent node');
			}
			return $this->_parentNode;
		}

		public function setParentNode(Bike_Tree_Node $parentNode)
		{
			$this->_parentNode = $parentNode;
			return $this;
		}

		public function setChildNode(Bike_Tree_Node $node)
		{
			$childNodes = $this->getChildNodes();
			if(!is_array($childNodes))
			{
				$childNodes = array();
			}
			$childNodes[$node->getKeySerialized()] = $node;
			$this->setChildNodes($childNodes);

			return $this;
		}

		public function getChildNode($key)
		{
			$childNodes = $this->getChildNodes();
			$tree = $this->getTree();
			$serializedKey = $tree->serializeKey($tree->_createKeyArray($key));
			if(isset($childNodes[$serializedKey]) && $childNodes[$serializedKey] instanceof self)
			{
				return $childNodes[$serializedKey];
			}
			require_once 'Bike/Tree/Exception.php';
			throw new Bike_Tree_Exception(sprintf('Undefined child node "%s"', print_r($key, true)));
		}

		public function getChildNodes()
		{
			return $this->_childNodes;
		}

		public function setChildNodes(array $nodes)
		{
			$this->_childNodes = $nodes;
			return $this;
		}

		public function hasChildNodes()
		{
			return (is_array($this->_childNodes) && sizeof($this->_childNodes));
		}

		public function getSortedChildNodes($fieldName, $varType = 'int')
		{
			$nodes = array();
			$childNodes = $this->getChildNodes();
			foreach($this->getFieldNameChildIndex($fieldName, $varType) as $key)
			{
				$nodes[$key] = $childNodes[$key];
			}
			return $nodes;
		}

		public function __call($methodName, array $args)
		{
			try
			{
				return parent::__call($methodName, $args);
			}
			catch(Bike_Exception $e)
			{
				if(!is_object($this->getItem()))
				{
					throw $e;
				}
				return call_user_func_array(array($this->getItem(), $methodName), $args);
			}
		}

		public function __get($name)
		{
			try
			{
				return parent::__get($name);
			}
			catch(Bike_Exception $e)
			{
				if(!is_object($this->getItem()))
				{
					throw $e;
				}
				return $this->getItem()->$name;
			}
		}

		public function __set($name, $value)
		{
			try
			{
				return parent::__set($name, $value);
			}
			catch(Bike_Exception $e)
			{
				if(!is_object($this->getItem()))
				{
					throw $e;
				}
				return $this->getItem()->$name = $value;
			}
		}

		public function getMultiOptions(Bike_Params_MultiOptions $params)
		{
			$keys = array();
			foreach($params->getKeyFieldNames() as $fieldName)
			{
				array_push($keys, $this->getTree()->getFieldValueFromNode($this, $fieldName));
			}

			$values = array();
			foreach($params->getValueFieldNames() as $fieldName)
			{
				array_push($values, $this->getTree()->getFieldValueFromNode($this, $fieldName));
			}

			$multiOptions = $params->getMultiOptions();

			$multiOptions[$params->getKey($keys)] = $params->getValue($values, $withDeep = True);

			$params->setMultiOptions($multiOptions);

			foreach($this->getChildNodes() as $node)
			{
				$clonedParams = clone $params;

				$params->setMultiOptions($node->getMultiOptions($clonedParams->setDeepIndex($clonedParams->getDeepIndex() + 1)));
			}

			return $params->getMultiOptions();
		}

		protected function makeFieldNameChildIndex($fieldName, $varType='int')
	    {
    		switch($varType)
	    	{
	    		case 'float':
	    		case 'bool':
	    		case 'int':
	    				$funcName = $varType.'val';
	    				break;
	    		case 'str':
	    		default:
	    				$funcName = 'strval';
	    	}
    		if(!is_array($this->_childPositions[$fieldName]))
    		{
    			$this->_childPositions[$fieldName] = array();
    		}
    		if(!is_array($this->_childPositions[$fieldName][$varType]))
    		{
    			$this->_childPositions[$fieldName][$varType] = array();
    		}
    		foreach($this->getChildNodes() as $key => $childNode)
    		{
    			$value = $this->getTree()->getFieldValueFromNode($childNode, $fieldName);
    			$this->_childPositions[$fieldName][$varType][$key] = call_user_func($funcName, $value);
    		}
    		asort($this->_childPositions[$fieldName][$varType]);
	    }

	    protected function getFieldNameChildIndex($fieldName, $varType)
	    {
	    	if(!isset($this->_childPositions[$fieldName]) || !is_array($this->_childPositions[$fieldName]) || !is_array($this->_childPositions[$fieldName][$varType]))
	    	{
		    	$this->makeFieldNameChildIndex($fieldName, $varType);
	    	}
	    	return array_keys($this->_childPositions[$fieldName][$varType]);
	    }
	}
