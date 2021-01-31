<?php

/*
define("__TRUE", TRUE);
define("__FALSE", FALSE);
*/

  class MainFunc
  {    static $Config;
    static $ERRORS;
    static $language;

	static function setParams()
	{      global $CONFIG, $ERRORS;

	  self::$Config = &$CONFIG;
	  self::$ERRORS = &$ERRORS;
	}

	static function isBlank($v)
	{
	  if(!isset($v) || empty($v) || trim($v) == "")
	  {
		return __TRUE;
	  }
	  return __FALSE;
	}

    static function isEmptyArr(&$arr)
    {
  	  if(count($arr) == 0)
  	  {
  	    return __TRUE;
  	  }
  	  elseif(self::isBlank(reset($arr)))
  	  {  	  	return __TRUE;
  	  }
  	  else
  	  {  	    return __FALSE;
  	  }
    }

	static function isNotFullArr(&$arr, $MinCount=2)
	{
	  if(count($arr) < $MinCount)
	  {	  	return __TRUE;
	  }
	  else
	  {	  	return __FALSE;
	  }
	}

	static function array_kv($array, $key, $arrkey="")
	{
	  $result = array();
	  if(self::isBlank($arrkey))
	  {
	    foreach ($array as $item)
	    {
	      $result[] = $item[$key];
		}
  	  }
	  else
	  {
	    foreach ($array as $item)
	    {
	  	  $result[$item[$arrkey]] = $item[$key];
		}
	  }
	  return $result;
	}

	static function getPath()
    {
      $path = '/';
	  if(self::$Config['EnableMultiLanguage'] == 'y')
	  {
	    $path .= __LANG.'/';
	  }
      return $path;
    }

	static function showMessageJVSC($message)
	{
	  $output = "<script language='javascript'>window.confirm('".$message."');</script>";

	  if(__CFG_CLIENT_SCRIPT)
	  {
	  	global $xmlp;
	  	$xmlp->setPageContent($output);
	  }
	  else
	  {
	    echo $output;
	  }
	}

	static function showMessageAlertJVSC($message)
	{
	  $output = "<script language='javascript'>alert('".$message."');</script>";

	  if(__CFG_CLIENT_SCRIPT)
	  {
	  	global $xmlp;
	  	$xmlp->setPageContent($output);
	  }
	  else
	  {
	    echo $output;
	  }
	}

	static function generate_password($plength = 8, $symbols = 'DUL')
	{
	  srand((double)microtime()*1000000);
	  $passwordSymbols = array(
	  		'D' => '1234567890',
	  		'U' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
	  		'L' => 'abcdefghijklmnopqrstuvwxyz',
	  );
	  $password_letters = '';
	  for($i = 0; $i < strlen($symbols); $i++)
	  {
	  	$password_letters .= $passwordSymbols[$symbols[$i]];
	  }
	  $maxlet = strlen($password_letters)-1;
	  $password = "";
	  for($i = 1; $i <= $plength; $i++)
	  {
	    $password .= $password_letters[rand(0,$maxlet)];
	  }
	  return $password;
	}
  }

?>