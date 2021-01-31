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

	class Bike_Params_MultiOptions extends Bike_Params
	{
		public $keyFieldNames;
		public $parentKeyFieldNames;
		public $valueFieldNames;
		public $keySeparator = '_';
		public $valueSeparator = ' ';
		public $valuePattern;			// {0} ({1})
		public $valueDeepPrefix = '  ';
		public $deepIndex = 0;
		public $multiOptions;

		static public function factory(array $options = array())
		{
			return new self($options);
		}

		public function processGetKeyFieldNames($value)
		{
			if(is_null($value))
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Undefined key field names for multi options');
			}
			return (array) $value;
		}

		public function processGetParentKeyFieldNames($value)
		{
			if(is_null($value))
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Undefined parent key field names for multi options');
			}
			return (array) $value;
		}

		public function processGetValueFieldNames($value)
		{
			if(is_null($value))
			{
				require_once 'Bike/Params/Exception.php';
				throw new Bike_Params_Exception('Undefined value field names for multi options');
			}
			return (array) $value;
		}

		public function processGetMultiOptions($value)
		{
			return (array) $value;
		}

		public function processSetMultiOptions($value)
		{
			return (array) $value;
		}

		public function getKey($keys)
		{
			if(!is_array($keys))
			{
				$keys = (array) $keys;
			}

			return join($this->getKeySeparator(), $keys);
		}

		protected function makeValueReplacer($i)
		{
			return '{'.$i.'}';
		}

		public function getValue($values, $withDeep = False)
		{
			if(!is_array($values))
			{
				$values = (array) $values;
			}

			$deepPrefix = '';
			if($withDeep)
			{
				$deepPrefix = str_repeat($this->getValueDeepPrefix(), $this->getDeepIndex());
			}

			if(is_null($this->getValuePattern()))
			{
				return $deepPrefix.join($this->getValueSeparator(), $values);
			}

			return $deepPrefix.str_replace(array_map(array($this, 'makeValueReplacer'), array_keys($values)), $values, $this->getValuePattern());
		}
	}

