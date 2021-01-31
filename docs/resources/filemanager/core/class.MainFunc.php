<?php
/*
 * DF-FileManager
 * Version: 1.0 (3/06/2010)
 * Copyright (c) 2010 Dmytro Feshchenko www.df-studio.net
 * Licensed under the MIT License: http://en.wikipedia.org/wiki/MIT_License
*/

  if(!defined("__TRUE"))
  {
    define("__TRUE", true);
  }
  if(!defined("__FALSE"))
  {
    define("__FALSE", false);
  }


  class MF
  {
    const FILENAME_DELIM = "_";
	const LINKNAME_DELIM = "-";
	const TABNAME_DELIM = "_";
	const DBNAME_DELIM = "_";
	const REPLACER = "_";

	static public $FileNameDelim;
	static public $LinkNameDelim;
	static public $TabNameDelim;
	static public $DBNameDelim;
	static public $symbols = array(
								'D' => '1234567890',
								'U' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
								'L' => 'abcdefghijklmnopqrstuvwxyz',
								'S' => '\/|&?!(){}[];:,.%=+$#"\'`<>_-~@^*',
	);
    static public $dialects = array(
    						'ä' => 'ae',
    						'á' => 'a',
    						'â' => 'a',
    						'à' => 'a',
    						'à' => 'a',
    						'ö' => 'oe',
    						'ü' => 'ue',
    						'ß' => 'ss',
    						'а' => 'a',
    						'б' => 'b',
    						'в' => 'v',
    						'г' => 'g',
    						'д' => 'd',
    						'е' => 'e',
    						'ё' => 'e',
    						'є' => 'e',
    						'ж' => 'zh',
    						'з' => 'z',
    						'и' => 'i',
    						'і' => 'i',
    						'ї' => 'ji',
    						'й' => 'j',
    						'к' => 'k',
    						'л' => 'l',
    						'м' => 'm',
    						'н' => 'n',
    						'о' => 'o',
    						'п' => 'p',
    						'р' => 'r',
    						'с' => 's',
    						'т' => 't',
    						'у' => 'u',
    						'ф' => 'f',
    						'х' => 'h',
    						'ц' => 'c',
    						'ч' => 'ch',
    						'ш' => 'sh',
    						'щ' => 'sch',
    						'ь' => '',
    						'ъ' => '',
    						'ы' => 'y',
    						'э' => 'e',
    						'ю' => 'yu',
    						'я' => 'ya',
    );

	static function isBlank($Value)
	{
	  $value = (is_string($Value)) ? trim($Value) : $Value;
	  if(!isset($Value) || empty($value))
	  {
		return __TRUE;
	  }
	  return __FALSE;
	}

    static function isEmptyArr($Arr)
    {
  	  if(sizeof($Arr) == 0)
  	  {
  	    return __TRUE;
  	  }
  	  elseif(self::isBlank(reset($Arr)) && !is_array(reset($arr)))
  	  {  	  	return __TRUE;
  	  }
  	  else
  	  {  	    return __FALSE;
  	  }
    }

	static function isNotFullArr(&$Arr, $MinCount=2)
	{
	  if(sizeof($Arr) < $MinCount)
	  {	  	return __TRUE;
	  }
	  else
	  {	  	return __FALSE;
	  }
	}

	static function array_kv($Array, $Key, $ArrKey="")
	{
	  $result = array();
	  if(self::isBlank($ArrKey))
	  {
	    foreach($Array as $item)
	    {
	      $result[] = $item[$Key];
		}
  	  }
	  else
	  {
	    foreach ($Array as $item)
	    {
	  	  $result[$item[$ArrKey]] = $item[$Key];
		}
	  }
	  return $result;
	}

	static function hex($string)
	{	  $return = '';
      for($i=0;$i<strlen($string);$i++)
      {
        $return .= '%'.bin2hex($string[$i]);
      }
      return $return;
	}

	static function getLangCharset($Charset="")
	{	  if(self::isBlank($Charset) && defined('__CFG_FLMGR_LANG_CHARSET'))
	  {
	    $Charset = __CFG_FLMGR_LANG_CHARSET;
	  }
	  return $Charset;
	}

	static function strToUpperCase($String, $Charset="")
	{
	  return mb_convert_case($String, MB_CASE_UPPER, self::getLangCharset($Charset));
	}

	static function strToLowerCase($String, $Charset="")
	{
	  return mb_convert_case($String, MB_CASE_LOWER, self::getLangCharset($Charset));
	}

	static function strCapitalize($String, $Charset="")
	{
	  $Charset = self::getLangCharset($Charset);
	  return mb_strtoupper(mb_substr($String, 0, 1, $Charset), $Charset).mb_substr($String, 1, mb_strlen($String, $Charset), $Charset);
	}

	static function strCapitalizeAll($String, $Charset="")
	{
	  return mb_convert_case($String, MB_CASE_TITLE, self::getLangCharset($Charset));
	}

    static function getMicroTime()
    {
      list($usec, $sec) = explode(" ",microtime());
      return ((float)$usec + (float)$sec);
    }

    static function getDULSSymbols($Code="DUL")
    {      $parts = str_split($Code);
	  $symbols = "";
	  foreach($parts as $n => $val)
	  {
	  	$symbols .= self::$symbols[$val];
	  }
	  return $symbols;
    }

	static function generateString($Length=8, $Code="DUL")
	{
	  $symbols = self::getDULSSymbols($Code);
	  $maxpos = strlen($symbols)-1;
	  $password = "";
	  for($i=1; $i<=$Length; $i++)
	  {
	    $password .= $symbols[rand(0, $maxpos)];
	  }
	  return $password;
	}

	static function setDelims()
	{	  self::$LinkNameDelim	= (defined('__CFG_LINKNAME_DELIM')) ? __CFG_LINKNAME_DELIM 	: self::LINKNAME_DELIM;
	  self::$FileNameDelim 	= (defined('__CFG_FILENAME_DELIM')) ? __CFG_FILENAME_DELIM 	: self::FILENAME_DELIM;
	  self::$TabNameDelim  	= (defined('__CFG_TABNAME_DELIM')) 	? __CFG_TABNAME_DELIM 	: self::TABNAME_DELIM;
	  self::$DBNameDelim 	= (defined('__CFG_DBNAME_DELIM')) 	? __CFG_DBNAME_DELIM 	: self::DBNAME_DELIM;
	}

	static function makeLinkname($str, $Ignore="")
	{
      return self::Replace($str, self::$LinkNameDelim, $Ignore);
	}

	static function makeFilename($str, $Ignore="")
	{
      return self::Replace($str, self::$FileNameDelim, $Ignore);
	}

	static function makeDBname($str, $Ignore="")
	{
      return self::Replace($str, self::$DBNameDelim, $Ignore);
	}

	static function makeTablename($str, $Ignore="")
    {
  	  return self::Replace($str, self::$TabNameDelim, $Ignore);
    }

	static function Replace($str, $Delim, $Ignore="")
    {
      if(!is_string($str) || self::isBlank($str))
      {        return __FALSE;
      }

      $AccessString = self::getDULSSymbols("DL");
  	  if(is_array($Ignore) && !self::isEmptyArr($Ignore))
  	  {
  	    $AccessString .= join("",$Ignore);
  	  }
  	  elseif(is_string($Ignore) && !self::isBlank($Ignore))
  	  {
  	    $AccessString .= $Ignore;
  	  }

      $str = self::correctDialects(self::strToLowerCase($str));
      $strArr = str_split($str);
      foreach($strArr as $n => $val)
      {        if(strpos($AccessString, $val) === false)
        {          $strArr[$n] = $Delim;
        }
      }
      $newStr = preg_replace('/('.$Delim.'{2,})/s', $Delim, join("", $strArr));
      $length = strlen($Delim);
      if(substr($newStr, 0, $length) == $Delim)
      {        $newStr = substr($newStr, $length);
      }
      $nslength = strlen($newStr);
      if(substr($newStr, ($nslength - $length)) == $Delim)
      {
        $newStr = substr($newStr, 0, ($nslength - $length));
      }
      return $newStr;
    }

    static function correctDialects($str)
    {
      if(!is_string($str) || self::isBlank($str))
      {
        return __FALSE;
      }
      $SearchArr = array();
      $ReplaceArr = array();
      foreach(self::$dialects as $search => $replace)
      {        $SearchArr[] = $search;
        $ReplaceArr[] = $replace;
      }

      return str_replace($SearchArr, $ReplaceArr, $str);
    }

    static function stripCamelCase($str)
    {
      $sArr = str_split(self::getDULSSymbols("U"));
      foreach($sArr as $n => $val)
      {
        $SearchArr[] = $val;
        $ReplaceArr[] = self::REPLACER.self::strToLowerCase($val);
      }
      $newStr = str_replace($SearchArr, $ReplaceArr, $str);
      $length = strlen(self::REPLACER);
      if(substr($newStr, 0, $length) == self::REPLACER)
      {
        $newStr = substr($newStr, $length);
      }
      return $newStr;
    }

    static function makeCamelCase($str)
    {
      return str_replace(str_split(self::getDULSSymbols("S")), "", self::strCapitalizeAll($str));
    }

    static function makeLinknameFromCamelCase($str)
    {	  return self::makeLinkname(self::stripCamelCase($str));
    }

    static function processed($URL='')
    {      if(self::isBlank($URL))
      {        header("Location: ".$_SERVER['REQUEST_URI']);
      }
      else
      {      	header("Location: ".$URL);
      }
      exit;
    }
  }

?>