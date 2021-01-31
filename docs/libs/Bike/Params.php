<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Bike_InitialObject
	 */
	require_once 'Bike/InitialObject.php';


	class Bike_Params extends Bike_InitialObject
	{
		static public function factory(array $options = array())
		{
			return new self($options);
		}
	}
