<?php

	/**
	 *
	 * @author d.mas
	 *
	 */

	/**
	 * @see Bike_Params
	 */
	require_once 'Bike/Params.php';

	class Bike_Params_FormHandler extends Bike_Params
	{
		public $form;
		public $responseHandler;
		public $formHandler;
		public $sendResponseHandler = true;

		static public function factory(array $options = array())
		{
			return new self($options);
		}

		public function processGetForm($value)
		{
			if(!$value instanceof Bike_Form)
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Form is not instance of Bike_Form');
			}
			return $value;
		}

		public function processGetResponseHandler($value)
		{
			if(is_null($value))
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Undefined response handler');
			}
			return $value;
		}

		public function processGetFormHandler($value)
		{
			if(!$value instanceof Bike_Callback)
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Form handler is not instance of Bike_Callback');
			}
			return $value;
		}
	}

