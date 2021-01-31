<?php

class ClientValidator
{
  var $ValidStatus;
  var $ErrorMessage;
  var $DBSet;
  var $ClientConf;
  var $Config;
  var $ClientCode;

  function ClientValidator(&$dbSet,$AdminPanel)
  {
  	$this->DBSet = &$dbSet;
  	$this->ErrorMessage = "";
  	$this->ValidStatus = __FALSE;
  	$this->ClientConf = array();
  	$this->ClientCode = __CFG_CLIENT_CODE;
  	if(isBlank($AdminPanel))
  	{
	  $this->validateClient();
  	}
  	$this->SetConfigAsArray();
//  	$this->defineErrorsIDs();
  	$this->DBSet->close();
  	$dbSet->close();
  }

  function validateClient()
  {
    global $_SQL_TABLE;

    $this->ValidStatus = __TRUE;

    /*$arr = explode('.', $_SERVER['SERVER_NAME']);
    $ServerName = end($arr);
    $ServerName = "www.".prev($arr).".".$ServerName;
    $this->DBSet->open("SELECT cd.*, ct.folder AS SiteTypeFolder, ct.code AS SiteTypeCode FROM ".$_SQL_TABLE['client_domain'] ." cd INNER JOIN ".$_SQL_TABLE['client_type']." ct ON ct.id=cd.client_type WHERE cd.code = '".$this->ClientCode."' AND cd.sitedomain = '".$ServerName."'");
    $this->ClientConf = $this->DBSet->fetchArray();
    if($this->ClientConf['sitedomain'] != $ServerName)
    {
      $this->ErrorMessage = "<center><b><font color='red'>".$ServerName." is not verified by SYSTEM, because it is not registered in SYSTEM!</font></b></center>";
      if(__CFG_CLIENT_SCRIPT)
      {
  	    global $xmlp;
  	    $xmlp->setPageContent($this->ErrorMessage);
  	    $xmlp->display();
      }
      else
      {
       $this->display();
      }
      exit;
    }
    else
    {
      $this->ValidStatus = __TRUE;
    } */
  }

  function setConfigAsArray()
  {
    global $_SQL_TABLE;

    $this->DBSet->open("SELECT name, value FROM ".$_SQL_TABLE['configuration']);
    $arr = $this->DBSet->fetchRowsAll();
    foreach($arr as $n => $val)
    {
      if(array_key_exists(strToLower($val['name']), $this->ClientConf))
      {
        $this->Config[$val['name']] = $this->ClientConf[strtolower($val['name'])];
        $this->ClientConf[strtolower($val['name'])] = "";
      }
      else
      {
        $this->Config[$val['name']] = $val['value'];
      }
    }

    foreach($this->ClientConf as $name => $val)
    {
      if(!isBlank($val) && strtolower($name) != $name)
      {
        $this->Config[$name] = $val;
      }
    }
  }

  function getConfigArray()
  {
    return $this->Config;
  }

  function defineErrorsIDs()
  {
    global $_SQL_TABLE;

    $this->DBSet->open("SELECT name FROM ".$_SQL_TABLE['error']);
    $result = $this->DBSet->fetchRowsAll();
    foreach($result as $n => $arr)
    {
      define($arr['name'], ($n+1));
    }
  }

  function filterBlockedCountries($CountryCode)
  {
    global $sID, $_SQL_TABLE;

    require_once __CFG_PATH_LIBS.__CFG_PATH_CORE."common.php";
    $countries = getRowsByField($_SQL_TABLE['country'], 'active', 'n');
    foreach($countries as $n => $arr)
    {
      if($CountryCode == $arr['code'] && $sID->fetch('isAdminLogin') != __TRUE)
      {
      	go_to($this->Config['UrlForBlockedCountries']);
      	exit;
      }
    }
  }

  function checkBlackIP()
  {
  	global $sID, $_SQL_TABLE;

    if($sID->fetch('IPTestPassed') != __TRUE)
    {
      if(!isBlank($_GET['subtask']))
      {
        $Keyword = $_GET['subtask'];
      }
      elseif(!isBlank($_GET['task']))
      {
        $Keyword = $_GET['task'];
      }

      //$RedirectURL = $this->Config['UrlForBlockedCountries'].urlencode(str_replace($this->Config['AdminLinkNameDelim'], " ", $Keyword));
      $RedirectURL = $this->Config['UrlForBlockedCountries'];

      require_once __CFG_PATH_LIBS.__CFG_PATH_CORE."common.php";
  	  $IPParts = explode(".", trim($_SERVER["REMOTE_ADDR"]));
  	  $Count = count($IPParts)-1;

      $IPList = array();
      $IPList[] = trim($_SERVER["REMOTE_ADDR"]);

      for($i=$Count; $i>0; $i--)
      {
        $IPParts[$i] = "*";
        $IPList[] = join(".", $IPParts);
      }

      $Row = getRowByFields($_SQL_TABLE['black_ip'], array("ip IN ('".join("','", $IPList)."')", "active = 'n'"));
      if(in_array($Row['ip'], $IPList))
      {
        go_to($RedirectURL);
        exit;
      }
      else
      {
        require_once __CFG_PATH_LIBS."xx/class.CURLClient.php";
        $CURLC = new CURLClient($this->Config['BlackIPCheckerLink'].trim($_SERVER["REMOTE_ADDR"]));
        $ResultContent = $CURLC->connectAndGetCurlResult();
        $ResultArr = $CURLC->XMLToArray($ResultContent);
        if($ResultArr['appears'] == 'yes')
        {
          go_to($RedirectURL);
          exit;
        }
        else
        {
          $sID->assign('IPTestPassed', __TRUE);
        }
      }
    }
  }

  function display()
  {
    echo $this->ErrorMessage;
  }
}



?>