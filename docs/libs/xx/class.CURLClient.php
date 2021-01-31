<?php

  class CURLClient
  {
  	var $UserAgent;
  	var $LinkURL;
  	var $XMLCode;
  	var $XMLArray;
  	var $CurlReturnResult;
  	var $CurlResult;
  	var $CurlTimeout; //in seconds
  	var $fileLink;
  	var $GETParams;
  	var $ch;

  	function __construct($Link='')
    {
      global $CONFIG;

      $this->UserAgent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)";
      $this->CurlReturnResult = __TRUE;
      $this->LinkURL = $Link;
      $this->CurlTimeout = $CONFIG['CURLTimeout'];
    }

    function __destruct()
    {
      $this->close();
    }

    function __set($name, $value)
    {
      $this->$name = $value;
    }

    function __get($name)
    {
      return $this->$name;
    }

    function init()
    {      $this->ch = curl_init();
    }

    function close()
    {
      curl_close($this->ch);
    }

    function setOption($FLAG, $value)
    {
      curl_setopt($this->ch, $FLAG, $value);
    }

    function execute()
    {
      $this->CurlResult = curl_exec($this->ch);
    }

    function makeCurlResult($Link='')
    {
      if(!isBlank($Link))
      {
        $this->LinkURL = $Link;
      }
      $this->init();
	  $this->setOption(CURLOPT_URL, $this->LinkURL);
	  $this->setOption(CURLOPT_USERAGENT, $this->UserAgent);
	  $this->setOption(CURLOPT_RETURNTRANSFER, $this->CurlReturnResult);
	  $this->setOption(CURLOPT_TIMEOUT, $this->CurlTimeout);
	  $this->execute();
	  $this->close();
    }

    function getCurlResult()
    {
      return $this->CurlResult;
    }

    function connectAndGetCurlResult($Link='')
    {
      $this->makeCurlResult($Link);
      return $this->CurlResult;
    }

    function _XMLToArray(&$text, &$TagsAll)
    {
      preg_match_all('/<([\w\d\-\_]+)[\s[^\>]*]?>/Uis', $text, $matches);
      $Array = array();
      $Tags = $matches[1];
      foreach($Tags as $n => $tag)
      {
        if(preg_match('/<'.$tag.'>([^<]+)<\/'.$tag.'>/Uis', $text, $matches) && isset($TagsAll[$tag]) && $TagsAll[$tag] == $tag)
        {
          $Array[$tag] = unescapeValue($matches[1]);
          unset($TagsAll[$tag]);
        }
        elseif(isset($TagsAll[$tag]) && $TagsAll[$tag] == $tag)
        {
          preg_match('/<'.$tag.'>(.*)<\/'.$tag.'>/Uis', $text, $matches);
          $Array[$tag] = $this->_XMLToArray($matches[1], $TagsAll);
        }
      }
      return $Array;
    }

    function XMLToArray(&$text)
    {
      preg_match_all('/<([\w\d\-\_]+)[\s[^\>]*]?>/Uis', $text, $matches);
      $TagsAll = $matches[1];
      foreach($TagsAll as $n => $val)
      {
        $narr[$val] = $val;
      }
      $TagsAll = $narr;
      return $this->_XMLToArray($text, $TagsAll);
    }

  }

?>