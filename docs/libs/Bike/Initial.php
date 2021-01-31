<?php

	abstract class Bike_Initial
	{		const CALL_PREFIX_CONSTANT = 'getConst';

		const MAGIC_SETGET_CHECK_EXISTENCE = True;

		static protected $_reflections = array();
		static protected $_translate;

		static protected function getMagicSetgetCheckExistence()
		{
			return self::MAGIC_SETGET_CHECK_EXISTENCE;
		}

		static public function translate()
		{
			$args = func_get_args();
			if(is_null(self::$_translate))
			{
				self::$_translate = Zend_Controller_Front::getInstance()->getBootstrap()
																		->getPluginResource('translate')
																		->getTranslate();
			}
			return call_user_func_array(array(self::$_translate, 'translate'), $args);
		}

		public function __construct(array $Options=null)
	    {
	        $this->setOptions($Options);
	        $this->init();
	    }

	    public function init()
	    {
	    }

	    public function _clone()
	    {
	    	return clone $this;
	    }

		public function __set($Name, $Value)
	    {
	        $methodName = 'set'.ucfirst($Name);
	        if($this->getMagicSetgetCheckExistence() && !method_exists($this, $methodName))
	        {
	            throw new Bike_Exception('Invalid property name: '.$Name);
	        }
	        $this->$methodName($Value);
	    }

	    public function __get($Name)
	    {
	        $methodName = 'get'.ucfirst($Name);
	        if($this->getMagicSetgetCheckExistence() && !method_exists($this, $methodName))
	        {
	            throw new Bike_Exception('Invalid property name: '.$Name);
	        }
	        return $this->$methodName();
	    }

		public function __call($MethodName, array $Args=null)
		{			if(preg_match("/^getConst([\w\d]+)$/s", $MethodName, $matches))
			{
				return $this->getConst($matches[1], $Args);
			}

			throw new Bike_Exception('Undefined method: '.$MethodName);
		}

		public function getReflection($className = null)
	    {
	    	if(is_null($className))
	    	{
	    		$className = get_class($this);
	    	}
	    	if(!isset(self::$_reflections[$className]))
	    	{
	    		self::$_reflections[$className] = new Zend_Reflection_Class($className);
	   		}
	   		return self::$_reflections[$className];
	    }

	    protected function getConstant($Name=Null)
	    {
	    	if(is_null($Name))
	    	{
	    		throw new Bike_Exception('Invalid constant name provided');
	   		}
	   		return $this->getReflection()->getConstant($Name);
	    }

	    protected function getConst($Name)
	    {
	    	$constName = Bike_String::factory($Name)->toConstFromCamelCase();
	    	return $this->getConstant($constName);
	    }

	    protected function getConstants($Prefix=Null)
	    {	    	$constants = $this->getReflection()->getConstants();
	    	if(!is_null($Prefix))
	    	{	    		$prefixLen = strlen($Prefix);
	    		foreach($constants as $name => $value)
	    		{	    			if(substr($name, 0, $prefixLen) != $Prefix)
	    			{	    				unset($constants[$name]);
	    			}
	    		}
	    	}
	    	return $constants;
	    }

	    protected function getSetOptionsDefaultSpecialKeys()
	    {
	    	return array('options');
	    }

	    public function setOptions(array $Options=null, array $specialKeys=null)
	    {
	        if(!is_array($specialKeys))
	        {
	        	$specialKeys = array();
	        }
	        $specialKeys = array_merge($specialKeys, $this->getSetOptionsDefaultSpecialKeys());

	    	foreach((array) $Options as $key => $value)
	        {
	        	$setFlag = false;
	        	if(in_array($key, $specialKeys))
	        	{
	        		$methodName = 'setOption'.ucfirst($key);
	        		if(method_exists($this, $methodName))
	        		{
	        			$this->$methodName($value);
	        			$setFlag = true;
	        		}
	        	}
	        	if(!$setFlag)
	        	{
	        		$this->$key = $value;
	        	}
	        }
	        return $this;
	    }

	    public function getRegistry($Name)
	    {	    	try
	    	{
		    	$res = Zend_Registry::get($Name);
			}
			catch(Zend_Exception $e){}
			return $res;
	    }

	    public function setRegistry($Name, $Value)
	    {
	    	Zend_Registry::set($Name, $Value);
	    	return $this;
	    }
	}
