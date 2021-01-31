<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Zend_Reflection_Class
	 */
	require_once 'Zend/Reflection/Class.php';

	/**
	 * @see Bike_Initial
	 */
	require_once 'Bike/Initial.php';

	/**
	 * @see Bike_Tree_Node
	 */
	require_once 'Bike/Tree/Node.php';

	/**
	 * @see Bike_Tree_RootNode
	 */
	require_once 'Bike/Tree/RootNode.php';


	abstract class Bike_Tree_Abstract extends Bike_Initial
	{
		const ROOT_ITEM = 'ROOT_ITEM';
		const NODE_CLASS_NAME = 'Bike_Tree_Node';
		const ROOT_NODE_CLASS_NAME = 'Bike_Tree_RootNode';

		protected $_keyFields;
		protected $_parentFields;
		protected $_rootKey;
		protected $_nodes = array();
		protected $_noParentNodes = array();
		protected $_list;

		static public function serializeKey($key)
		{
			return md5(serialize($key));
		}

		public function init()
		{
			$this->setNode($this->createNode($this->getRootKey(), null, $this->getRootItem(), self::ROOT_NODE_CLASS_NAME));
		}

		public function getRootItem()
		{
			return self::ROOT_ITEM;
		}

		public function getRootNode()
		{
			return $this->getNode($this->getRootKey());
		}

		protected function setKeyFields($keyFields)
		{
			if(!is_array($keyFields))
			{
				$keyFields = array($keyFields);
			}
			$this->_keyFields = array_values($keyFields);
			return $this;
		}

		public function getKeyFields()
		{
			if(!sizeof($this->_keyFields))
			{
				require_once 'Bike/Tree/Exception.php';
				throw new Bike_Tree_Exception('Undefined key fields');
			}
			return $this->_keyFields;
		}

		protected function setParentFields($parentFields)
		{
			if(!is_array($parentFields))
			{
				$parentFields = array($parentFields);
			}
			$this->_parentFields = array_values($parentFields);
			return $this;
		}

		public function getParentFields()
		{
			/*if(!sizeof($this->_parentFields))
			{
				require_once 'Bike/Tree/Exception.php';
				throw new Bike_Tree_Exception('Undefined parent fields');
			}*/
			return (array) $this->_parentFields;
		}

		public function _createKeyArray($key, array $fields=null)
		{
			if(is_null($fields))
			{
				$fields = $this->getKeyFields();
			}

			if(is_array($key))
			{
				$correctFlag = true;
				$correctArr = array();
				foreach($fields as $field)
				{
					if(!array_key_exists($field, $key))
					{
						$correctFlag = false;
						break;
					}
					$correctArr[$field] = $key[$field];
				}

				if($correctFlag)
				{
					return $correctArr;
				}
			}

			if(!is_array($key))
			{
				$key = array($key);
			}

			return array_combine($fields, $key);
		}

		protected function setRootKey($rootKey)
		{
			if(!is_array($rootKey))
			{
				$rootKey = array($rootKey);
			}
			$this->_rootKey = $rootKey;
			return $this;
		}

		public function getRootKey()
		{
			if(is_null($this->_rootKey))
			{
				$this->setRootKey($this->_createKeyArray(array_fill(0, sizeof($this->getKeyFields()), 0)));
			}
			return $this->_rootKey;
		}

		protected function linkNodes($node, $parentNode)
		{
			$node->setParentNode($parentNode);
			$parentNode->setChildNode($node);
			return $this;
		}

		final public function createNode($key, $parentKey, &$item, $nodeClass = null)
		{
			$key = $this->_createKeyArray($key);
			$parentKey = $this->_createKeyArray($parentKey);
			if(!is_null($nodeClass))
			{
				$reflection = new Zend_Reflection_Class($nodeClass);
				if(!$reflection->isSubclassOf(self::NODE_CLASS_NAME))
				{
					$nodeClass = null;
				}
			}

			if(is_null($nodeClass))
			{
				$nodeClass = self::NODE_CLASS_NAME;
			}

			$node = new $nodeClass();
			$node->setItem($item)
				->setKey($key)
				->setParentKey($parentKey)
				->setTree($this);

			$rootClassName = self::ROOT_NODE_CLASS_NAME;
			if(!$node instanceof $rootClassName)
			{
				if(!$this->issetNode($node->getParentKey()) && !$this->issetNoParentNode($node->getParentKey()))
				{
					$this->setNoParentNode($node);
				}
				elseif($this->issetNode($node->getParentKey()))
				{
					$parentNode = $this->getNode($node->getParentKey());
					$this->linkNodes($node, $parentNode);
				}
				else
				{
					$parentNode = $this->getNoParentNode($node->getParentKey());
					$this->linkNodes($node, $parentNode);
				}
			}

			return $node;
		}

		public function setNode(Bike_Tree_Node $node)
		{
			$this->_nodes[$node->getKeySerialized()] = $node;
		}

		public function getNode($key)
		{
			$key = $this->serializeKey($this->_createKeyArray($key));
			if(!$this->issetNode($key, true))
			{
				throw new Bike_Tree_Exception(sprintf('Undefined node "%s"', $key));
			}
			return $this->_nodes[$key];
		}

		public function issetNode($key, $serialized = false)
		{
			if(!$serialized)
			{
				$key = $this->serializeKey($this->_createKeyArray($key));
			}
			if(isset($this->_nodes[$key]) && $this->_nodes[$key] instanceof Bike_Tree_Node)
			{
				return true;
			}
		}

		public function setNoParentNode(Bike_Tree_Node $node)
		{
			$this->_noParentNodes[$node->getKeySerialized()] = $node;
		}

		public function issetNoParentNode($key, $serialized = false)
		{
			if(!$serialized)
			{
				$key = $this->serializeKey($this->_createKeyArray($key));
			}
			if(isset($this->_noParentNodes[$key]) && $this->_noParentNodes[$key] instanceof Bike_Tree_Node)
			{
				return true;
			}
		}

		public function getNoParentNode($key)
		{
			$key = $this->serializeKey($this->_createKeyArray($key));
			if(!$this->issetNoParentNode($key, true))
			{
				require_once 'Bike/Tree/Exception.php';
				throw new Bike_Tree_Exception(sprintf('Undefined no parent node "%s"', $key));
			}
			return $this->_noParentNodes[$key];
		}

		public function getNoParentNodes()
		{
			return $this->_noParentNodes;
		}

		protected function unsetNoParentNode($key, $serialized = false)
		{
			if(!$serialized)
			{
				$key = $this->serializeKey($this->_createKeyArray($key));
			}
			unset($this->_noParentNodes[$key]);
			return $this;
		}

		protected function addNoParentNodesToTree()
		{
			foreach($this->getNoParentNodes() as $node)
			{
				if($this->issetNode($node->getParentKey()))
				{
					$parentNode = $this->getNode($node->getParentKey());
					$this->linkNodes($node, $parentNode);
					$this->unsetNoParentNode($node->getKey());
				}
			}
		}

		public function buildModel()
		{
			$this->buildNodesFromList();
			$this->addNoParentNodesToTree();

			return $this;
		}

		public function getMultiOptions($keyFieldNames, $valueFieldNames, $prefix = Bike_Tree_Node::MULTI_OPTIONS_PREFIX, $deep = 0, array $multiOptions = array())
	    {
	    	$args = func_get_args();
	    	$params = array_shift($args);
	    	if(!$params instanceof Bike_Params_MultiOptions)
	    	{
	    		$params = Bike_Params_MultiOptions::factory(array(
	    				'keyFieldNames' => $keyFieldNames,
	    				'valueFieldNames' => $valueFieldNames,
	    				'valueDeepPrefix' => $prefix,
	    				'deepIndex' => $deep,
	    				'multiOptions' => $multiOptions,
	    		));
	    	}

	    	return $this->getRootNode()->getMultiOptions($params);
	    }

	    protected function nodeToMultiOptions()
	    {

	    }

		abstract static public function factory($options);
		abstract public function setList(&$list);
		abstract public function &getList();
		abstract public function buildNodesFromList();
	}
