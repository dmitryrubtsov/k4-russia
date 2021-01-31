<?php

	/**
	 * @see Bike_Initial
	 */
	require_once 'Bike/Initial.php';
	
	
	class Bike_String extends Bike_Initial
	{		const DEFAULT_CHARSET = 'UTF-8';
		const V_DIGITS = 1;
		const V_UCASE = 2;
		const V_LCASE = 3;
		const V_SYMBOLS = 4;
		const REPLACER = '_';
		const LINKNAME_SEPARATOR = '-';

		static protected $_defaultCharset;

		protected $_string;
		protected $_charset;
		protected $_variety = array();

		static protected function getStandartVarieties()
		{			return array(
			    self::V_DIGITS		=> '1234567890',
				self::V_UCASE 		=> 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
				self::V_LCASE 		=> 'abcdefghijklmnopqrstuvwxyz',
				self::V_SYMBOLS 	=> '\/|&?!(){}[];:,.%=+$#"\'`<>_-~@^*',
			);
		}

		static public function factory($Options=null)
		{			return new self($Options);
		}

		static public function getDefaultCharset()
		{
			return (is_null(self::$_defaultCharset) ? self::DEFAULT_CHARSET : self::$_defaultCharset);
		}

		static public function setDefaultCharset($Charset)
		{
			self::$_defaultCharset = $Charset;
		}

		public function __construct($Options=array())
		{			if(is_string($Options))
			{				$Options = array('String' => $Options);
			}
			parent::__construct((array) $Options);
		}

		public function setCharset($Charset=Null)
		{			$this->_charset = (is_null($Charset)) ? self::getDefaultCharset() : $Charset;
			return $this;
		}

		public function getCharset()
		{
			return (is_null($this->_charset)) ? self::getDefaultCharset() : $this->_charset;
		}

		public function setString($String)
		{
			$this->_string = $String;
			return $this;
		}

		public function getString()
		{
			return $this->_string;
		}

		public function addVariety($Key, $Value)
		{            if(array_key_exists($Key, $this->getConstants('V_')))
            {            	Throw new Bike_Exception("Illegal key value '".$Key."'");
            }
            $this->_variety[$Key] = $Value;
            return $this;
		}

		public function toUpper($Multibyte=True)
		{			if($Multibyte)
			{				return mb_convert_case($this->getString(), MB_CASE_UPPER, $this->getCharset());
			}
			return strtoupper($this->getString());
		}

		public function toLower($Multibyte=True)
		{
			if($Multibyte)
			{
				return mb_convert_case($this->getString(), MB_CASE_LOWER, $this->getCharset());
			}
			return strtolower($this->getString());
		}

		public function capitalizeAll($Multibyte=True)
		{
			if($Multibyte)
			{
				return mb_convert_case($this->getString(), MB_CASE_TITLE, $this->getCharset());
			}
			return ucwords($this->getString());
		}

		public function capitalize($Multibyte=True)
		{
			if($Multibyte)
			{
				return mb_strtoupper(mb_substr($this->getString(), 0, 1, $this->getCharset()), $this->getCharset()).mb_substr($this->getString(), 1, mb_strlen($this->getString(), $this->getCharset()), $this->getCharset());
			}
			return ucfirst($this->getString());
		}

		public function lowerCaseFirst($Multibyte=True)
		{
			if($Multibyte)
			{
				return mb_strtolower(mb_substr($this->getString(), 0, 1, $this->getCharset()), $this->getCharset()).mb_substr($this->getString(), 1, mb_strlen($this->getString(), $this->getCharset()), $this->getCharset());
			}
			return strtolower(substr($this->getString(), 0, 1)).substr($this->getString(), 1);
		}

		public function getVarieties($Parts=array())
		{
			$varieties = self::getStandartVarieties() + $this->_variety;

			if(is_string($Parts) || is_int($Parts))
			{				$Parts = array($Parts);
			}
			if(!is_array($Parts))
			{				$Parts = array();
			}
			$symbols = "";
			if(sizeof($Parts))
			{
				foreach($Parts as $key)
				{
					$symbols .= $varieties[$key];
				}
			}
			else
			{				$symbols = join('', $varieties);
			}
			return $symbols;
		}

		public function generateString($Length=8, $Parts=array(self::V_DIGITS, self::V_UCASE, self::V_LCASE))
		{
			$symbols = $this->getVarieties($Parts);
			$maxpos = strlen($symbols)-1;
			$password = "";
			for($i=1; $i<=$Length; $i++)
			{
				$password .= $symbols[rand(0, $maxpos)];
			}
			return $password;
		}

		protected function _replace($String, $Delim, $Ignore=Null)
		{
			if(!is_string($String) || !strlen($String))
			{
				return False;
			}

			$AccessString = $this->getVarieties($Parts=array(self::V_DIGITS, self::V_LCASE));
			if(is_array($Ignore) && sizeof($Ignore))
			{
				$AccessString .= join("", $Ignore);
			}
			elseif(is_string($Ignore) && strlen($Ignore))
			{
				$AccessString .= $Ignore;
			}

			//$str = self::correctDialects(self::strToLowerCase($str));
			$strArr = str_split($str);
			foreach($strArr as $n => $val)
			{
				if(!strpos($AccessString, $val))
				{
					$strArr[$n] = $Delim;
				}
			}
			$newStr = preg_replace('/('.$Delim.'{2,})/s', $Delim, join("", $strArr));
			$length = strlen($Delim);
			if(substr($newStr, 0, $length) == $Delim)
			{
				$newStr = substr($newStr, $length);
			}
			$nslength = strlen($newStr);
			if(substr($newStr, ($nslength - $length)) == $Delim)
			{
				$newStr = substr($newStr, 0, ($nslength - $length));
			}
			return $newStr;
		}

		public function stripCamelCase()
		{
			$str = $this->getString();
			$sUArr = str_split($this->getVarieties(self::V_UCASE));
			$sLArr = str_split($this->getVarieties(self::V_LCASE));
			foreach($sUArr as $n => $val)
			{
				$SearchArr[] = $val;
				$ReplaceArr[] = self::REPLACER.$sLArr[$n];
			}
			$newStr = str_replace($SearchArr, $ReplaceArr, $str);
			$length = strlen(self::REPLACER);
			if(substr($newStr, 0, $length) == self::REPLACER)
			{
				$newStr = substr($newStr, $length);
			}
			return $newStr;
		}

		public function toCamelCase()
		{
			return str_replace(str_split($this->getVarieties(self::V_SYMBOLS)), "", $this->capitalizeAll());
		}

		public function toConstFromCamelCase()
		{
			return $this->setString($this->stripCamelCase())->toUpper();
		}

		public function toLinknameFromCamelCase($Separator = self::LINKNAME_SEPARATOR)
		{
			return str_replace(self::REPLACER, $Separator, $this->stripCamelCase());
		}
	}
