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


	class Bike_InitialObject extends Bike_Initial
	{
		const MAGIC_SETGET_CHECK_EXISTENCE = False;

		static protected function getMagicSetgetCheckExistence()
		{
			return self::MAGIC_SETGET_CHECK_EXISTENCE;
		}

		public function __call($MethodName, array $Args=null)
		{
			try
			{
				return parent::__call($MethodName, $Args);
			}
			catch(Bike_Exception $e)
			{
				if(substr($MethodName, 0, 3) == 'get')
				{
					$Name = substr($MethodName, 3);
					$name = $this->lowerCaseFirst($Name);
					array_unshift($Args, $Name);
					$Value = call_user_func_array(array($this, '_getSetting'), $Args);
					if(method_exists($this, 'processGet'.$Name))
					{
						array_shift($Args);
						array_unshift($Args, $Value);
						$Value = call_user_func_array(array($this, 'processGet'.$Name), $Args);
					}
					return $Value;
				}
				elseif(substr($MethodName, 0, 5) == 'unset')
				{
					$name = substr($MethodName, 5);
					array_unshift($Args, $name);
					return call_user_func_array(array($this, '_unsetSetting'), $Args);
				}
				elseif(substr($MethodName, 0, 5) == 'isset')
				{
					$name = substr($MethodName, 5);
					array_unshift($Args, $name);
					return call_user_func_array(array($this, '_issetSetting'), $Args);
				}
				elseif(substr($MethodName, 0, 3) == 'set')
				{
					$Name = substr($MethodName, 3);
					$name = $this->lowerCaseFirst($Name);
					if(sizeof($Args) <= 1)
					{
						$Value = reset($Args);
					}
					else
					{
						$Value = $Args;
					}
					if(method_exists($this, 'processSet'.$Name))
					{
						$value = call_user_func(array($this, 'processSet'.$Name), $Value);
					}
					else
					{
						$value = $Value;
					}
					$args = array($Name, $value);
					return call_user_func_array(array($this, '_setSetting'), $args);
					return $this;
				}
			}
			throw new Zend_Db_Exception('Undefined method: '.$MethodName);
		}

		protected function lowerCaseFirst($Name)
		{
			return Bike_String::factory($Name)->lowerCaseFirst();
		}

		protected function _getSettings()
		{
			return $this;
		}

		protected function _setSetting($Name, $Value, array $Args = array())
		{
			$name = $this->lowerCaseFirst($Name);
			$this->$name = $Value;
			return $this;
		}

		protected function _getSetting($Name, $DefaultValue = null)
		{
			$name = $this->lowerCaseFirst($Name);
			return isset($this->$name) ? $this->$name : $DefaultValue;
		}

		protected function _unsetSetting($Name, array $Args = array())
		{
			$name = $this->lowerCaseFirst($Name);
			unset($this->$name);
			return $this;
		}

		protected function _issetSetting($Name, array $Args = array())
		{
			$name = $this->lowerCaseFirst($Name);
			return isset($this->$name);
		}
	}