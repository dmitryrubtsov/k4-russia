<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Bike_Tree_Node
	 */
	require_once 'Bike/Tree/Node.php';


	class Bike_Tree_RootNode extends Bike_Tree_Node
	{
		public function &getItem()
		{
			require_once 'Bike/Tree/Exception.php';
			throw new Bike_Tree_Exception('Unable to get item of root node');
		}

		public function getParentKey()
		{
			require_once 'Bike/Tree/Exception.php';
			throw new Bike_Tree_Exception('Unable to get parent key of root node');
		}

		public function getParentNode()
		{
			require_once 'Bike/Tree/Exception.php';
			throw new Bike_Tree_Exception('Unable to get parent node of root node');
		}

		public function getMultiOptions(Bike_Params_MultiOptions $params)
		{
			foreach($this->getChildNodes() as $node)
			{
				$multiOptions = $node->getMultiOptions($params);
			}
			return $multiOptions;
		}
	}
