<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Bike_Tree_Abstract
	 */
	require_once 'Bike/Tree/Abstract.php';


	class Bike_Tree_ObjectList extends Bike_Tree_Abstract
	{
		static public function factory($options)
		{
			return new self($options);
		}

		public function setList(&$list)
		{
			$this->_list = $list;
			return $this;
		}

		public function &getList()
		{
			return $this->_list;
		}

		public function buildNodesFromList()
		{
			$list = $this->getList();
			foreach($list as $n => $row)
			{
				$key = array();
				$parentKey = array();
				$parentFields = $this->getParentFields();
				foreach($this->getKeyFields() as $i => $keyField)
				{
					$key[$keyField] = $row->$keyField;
					$parentKey[$keyField] = isset($parentFields[$i]) ? $row->{$parentFields[$i]} : 0;
				}
				$this->setNode($this->createNode($key, $parentKey, $list[$n]));
			}
			return $this;
		}

		public function getFieldValueFromNode($node, $fieldName)
		{
			$filter = new Zend_Filter_Word_UnderscoreToCamelCase();
			$method = 'get'.$filter->filter($fieldName);
			return $node->$method();
		}
	}
