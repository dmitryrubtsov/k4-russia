<?
  class Statistic
  {
	var $dbName;
	var $tablePrefix;
	var $Params;
	var $NoUseReferer;
	var $GEOIP_COUNTRY_CODE;

	function Statistic()
	{	  global $sID;
	  $this->dbName = __CFG_STAT_DATABASE;
	  $this->tablePrefix = __CFG_STAT_TAB_PREFIX;
	  $this->GEOIP_COUNTRY_CODE = $sID->fetch('GEOIP_COUNTRY_CODE');
	}

	function getFullTableName($tabNameParts, $ReturnFlag='')
	{
	  global $dbSet, $CONFIG;

	  $currPrefix = $dbSet->getTablePrefix();
	  $dbSet->setTablePrefix($this->tablePrefix);
	  foreach($tabNameParts as $n => $val)
	  {
	    $tabNameParts[$n] = $dbSet->make_statement_correct($val);
	  }
	  $dbSet->setTablePrefix($currPrefix);
	  $tblName = makeTableNameFromParts($tabNameParts);
	  $tableName = $this->dbName.".".$tblName;

	  if(isBlank($ReturnFlag))
	  {
	    return $tableName;
	  }
	  else
	  {	  	return array($this->dbName, $tblName);
	  }
	}

	function checkTableExists($tabNameParts, $CreateMethodName, $CreateFlag = __TRUE)
	{
	  list($DBName, $TableName) = $this->getFullTableName($tabNameParts, __TRUE);
	  $Result = tableExists($TableName, $DBName);
   	  if(!$Result && $CreateFlag == __TRUE)
      {
        $this->$CreateMethodName($DBName, $TableName);
      }
      elseif(!$Result && $CreateFlag != __TRUE)
      {        return __FALSE;
      }

      return __TRUE;
   	}

    function getStatisticDates($TableName)
   	{
      global $CONFIG, $dbSet, $_SQL_TABLE;

	  $tabNameParts[] = $TableName;
      list($dbName, $tblName) = $this->getFullTableName($tabNameParts, $ReturnFlag=__TRUE);
  	  $Tables = $dbSet->getTables($tblName."%", $dbName);

      $LastDate = intval(date("Ymd")) - $CONFIG['MainStatisticDaysCount'];

  	  $StatDates = array();
  	  foreach($Tables as $n => $val)
  	  {
    	if(preg_match("/^".$tblName.$CONFIG['AdminDBTableNameDelim']."[\d]{8}[".$CONFIG['AdminDBTableNameDelim']."]?(.*)$/Uis", $val))
    	{
      	  $DBDate = substr(str_replace($tblName.$CONFIG['AdminDBTableNameDelim'], '', $val), 0, 8);
      	  if(intval($DBDate) < $LastDate && $TableName != $_SQL_TABLE['stat_search_query'] && $TableName != $_SQL_TABLE['stat_search_query_count'])
      	  {
      	    deleteTable($dbName.".".$val);
      	  }
      	  else
      	  {
      	    $Year = substr($DBDate, 0, 4);
      	    $Month = substr($DBDate, 4, 2);
      	    $Day = substr($DBDate, 6, 2);
      	    $StatDates[$DBDate] = $Day.'.'.$Month.'.'.$Year;
      	  }
    	}
  	  }
  	  return $StatDates;
    }

    function getStatisticSeoParts($TableName)
   	{
      global $CONFIG, $dbSet;

	  $tabNameParts[] = $TableName;
      list($dbName, $tblName) = $this->getFullTableName($tabNameParts, $ReturnFlag=__TRUE);
  	  $Tables = $dbSet->getTables($tblName."%", $dbName);

  	  $StatSeoParts = array();
  	  $SeoPartMatch = "[\w]{2,3}".$CONFIG['AdminDBTableNameDelim']."[\w]{3}".$CONFIG['AdminDBTableNameDelim']."[\w]{3}";
  	  foreach($Tables as $n => $val)
  	  {
    	if(preg_match("/^".$tblName.$CONFIG['AdminDBTableNameDelim'].$SeoPartMatch."$/Uis", $val))
    	{
      	  $SeoPart =str_replace($tblName.$CONFIG['AdminDBTableNameDelim'], '', $val);
      	  $StatSeoParts[$SeoPart] = str_replace($CONFIG['AdminDBTableNameDelim'], $CONFIG['AdminLinkNameDelim'], $SeoPart);

    	}
  	  }
  	  return $StatSeoParts;
    }

    function createRefererHostTable($DBName, $TableName)
	{
	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
	  	CREATE TABLE IF NOT EXISTS `".$TableName."` (
		`id` mediumint(7) unsigned NOT NULL auto_increment,
		`refhost` varchar(255) collate utf8_bin NOT NULL,
		`count` int(11) unsigned NOT NULL default '1',
		`date` datetime NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `count` (`count`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

    function createRefererTable($DBName, $TableName)
	{
	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
	  	CREATE TABLE IF NOT EXISTS `".$TableName."` (
	  	`id` mediumint(7) unsigned NOT NULL auto_increment,
		`referer` text collate utf8_bin NOT NULL,
		`client_domain` mediumint(6) unsigned NOT NULL,
		`link` text collate utf8_bin NOT NULL,
		`ip` varchar(20) collate utf8_bin NOT NULL,
		`country` char(3) collate utf8_bin NOT NULL,
		`camp` varchar(50) collate utf8_bin NOT NULL,
		`subcamp` varchar(50) collate utf8_bin NOT NULL,
		`keyword` varchar(255) collate utf8_bin NOT NULL,
		`date` datetime NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `client_domain` (`client_domain`,`country`,`ip`(5)),
		KEY `country` (`country`,`ip`(5)),
		KEY `ip` (`ip`(5)),
		KEY `camp` (`camp`(5))
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

	function createClickTable($DBName, $TableName)
	{	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
		CREATE TABLE IF NOT EXISTS `".$TableName."` (
		`id` mediumint(7) unsigned NOT NULL auto_increment,
		`client_domain` mediumint(6) unsigned NOT NULL default '0',
		`ads_item` smallint(5) unsigned NOT NULL default '0',
		`referer` mediumint(7) unsigned NOT NULL default '0',
		`ads_site` smallint(5) unsigned NOT NULL default '0',
		`click_link` text collate utf8_bin NOT NULL,
		`camp` varchar(50) collate utf8_bin NOT NULL,
		`subcamp` varchar(50) collate utf8_bin NOT NULL,
		`keyword` varchar(255) collate utf8_bin NOT NULL,
		`country` char(3) collate utf8_bin NOT NULL,
		`ip` varchar(20) collate utf8_bin NOT NULL,
		`date` datetime NOT NULL default '0000-00-00 00:00:00',
		`info` text collate utf8_bin NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `client_domain` (`client_domain`),
		KEY `country` (`country`,`ip`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

	function createSearchQueryTable($DBName, $TableName)
	{
	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
	  	CREATE TABLE IF NOT EXISTS `".$TableName."` (
		`id` mediumint(7) unsigned NOT NULL auto_increment,
		`query` int(11) unsigned NOT NULL,
		`client_domain` mediumint(6) unsigned NOT NULL,
		`ip` varchar(20) collate utf8_bin NOT NULL,
		`country` char(3) collate utf8_bin NOT NULL,
		`date` datetime NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `client_domain` (`client_domain`,`ip`,`country`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

	function createSearchQueryCountTable($DBName, $TableName)
	{
	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
	  	CREATE TABLE IF NOT EXISTS `".$TableName."` (
		`id` int(11) unsigned NOT NULL auto_increment,
  		`query` varchar(255) collate utf8_bin NOT NULL,
  		`count` smallint(5) unsigned NOT NULL,
  		PRIMARY KEY  (`id`),
  		KEY `query` (`query`(10),`count`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

	function createClickIPCounterTable($DBName, $TableName)
	{
	  global $CONFIG, $dbSet;

	  $dbSet->__cID->setDatabase($DBName);
	  $query = "
	  	CREATE TABLE IF NOT EXISTS `".$TableName."` (
		`id` smallint(5) unsigned NOT NULL auto_increment,
		`ip` varchar(15) character set utf8 collate utf8_bin NOT NULL,
		`count` smallint(5) unsigned NOT NULL default '0',
		`blocked` enum('y','n') character set utf8 collate utf8_bin NOT NULL,
		`date` datetime NOT NULL,
		PRIMARY KEY  (`id`),
		KEY `ip` (`ip`,`count`,`blocked`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
	  ";
	  $dbSet->execute($query);
	  $dbSet->__cID->setDatabase(__CFG_DATABASE);
	}

	function catchRefHost()
    {
      global $sID, $CONFIG, $_SQL_TABLE, $CLIENT;

      if($sID->fetch('isRefCatched') != 'y')
      {
        $URLParts = parse_url($_SERVER['HTTP_REFERER']);
        if(!isBlank($URLParts['host']))
        {
          if($CONFIG['ServerDomain'] == $URLParts['host'])
          {
        	$this->NoUseReferer = __TRUE;
          }
          else
          {
            $tabNameParts[] = $_SQL_TABLE['stat_referer_host'];

            $this->checkTableExists($tabNameParts, 'createRefererHostTable');
            $TableName = $this->getFullTableName($tabNameParts);

            $toDBArr['refhost'] = $URLParts['scheme']."://".$URLParts['host'];
            makeSearchList($strSet, $toDBArr);
            $Host = getRowByStrSet($TableName, $strSet);
            if($Host['refhost'] == $toDBArr['refhost'] && $Host['count'] > 0)
            {              $result['count'] = $Host['count']+1;
              makeUpdateList($strSet, $result);
              updateItem($TableName, $strSet, 'id', $Host['id']);
            }
            else
            {
              $toDBArr = array();
              $toDBArr['refhost'] = $URLParts['scheme']."://".$URLParts['host'];
              $toDBArr['date'] = 'NOW()';
              $toDBArr['count'] = '1';
              makeInsertList($strColumns,$strValues, $toDBArr, array('date'));
              insertItem($TableName, $strColumns, $strValues);
            }
          }
        }
	    $sID->assign('isRefCatched', 'y');
      }
    }

	function catchVisitor()
    {
      global $sID, $CONFIG, $CLIENT, $_SQL_TABLE;

      if($sID->fetch('isVisitorCatched') != 'y')
      {
  		$VisitorCatched = array();
  		if(isBlank($this->NoUseReferer))
  		{
	      $VisitorCatched['referer'] = $_SERVER['HTTP_REFERER'];
	    }
	    if(!isBlank($_GET[$CONFIG['CampaignVarName']]))
	    {
	      $VisitorCatched['camp'] = $_GET[$CONFIG['CampaignVarName']];
	    }
	    if(!isBlank($_GET[$CONFIG['SubCampaignVarName']]))
	    {
	      $VisitorCatched['subcamp'] = $_GET[$CONFIG['SubCampaignVarName']];
	    }
	    if(!isBlank($_GET[$CONFIG['KeywordVarName']]))
	    {
	      $VisitorCatched['keyword'] = $_GET[$CONFIG['KeywordVarName']];
	    }
	    $sID->assign('visitor_info', $VisitorCatched);

	    require_once __CFG_PATH_LIBS."ip/geoip.inc";
  		$gi = geoip_open(__CFG_PATH_LIBS."ip/GeoIP.dat",GEOIP_STANDARD);
  		$this->GEOIP_COUNTRY_CODE = geoip_country_code_by_addr($gi, $_SERVER["REMOTE_ADDR"]);
  		geoip_close($gi);

  		$sID->assign('GEOIP_COUNTRY_CODE', $this->GEOIP_COUNTRY_CODE);

        $VisitorCatched['ip'] = $_SERVER['REMOTE_ADDR'];
        $VisitorCatched['link'] = $CONFIG['SiteProtocol'].'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $VisitorCatched['country'] = $this->GEOIP_COUNTRY_CODE;
        $VisitorCatched['date'] = 'NOW()';
        $tabNameParts[] = $_SQL_TABLE['stat_referer'];
        $tabNameParts[] = date("Ymd");
        //$tabNameParts[] = join($CONFIG['AdminDBTableNameDelim'], $SeoPartParts);

        $this->checkTableExists($tabNameParts, 'createRefererTable');
        $TableName = $this->getFullTableName($tabNameParts);

        makeInsertList($strColumns, $strValues, $VisitorCatched, array('date'));
	    $RID = insertItem($TableName, $strColumns, $strValues);
	    $sID->assign('refererID', $RID);
        $sID->assign('isVisitorCatched', 'y');
      }
    }

    function catchClick()
    {      global $sID, $CONFIG, $CLIENT, $_SQL_TABLE, $AdParams, $Link;

      $ClickInfo['id'] = '';
	  $ClickInfo['client_domain'] = __CFG_CLIENT_ID;

	  $ClickInfo['ads_item'] = $AdParams['itemId'];
	  $ClickInfo['ads_site'] = $AdParams['siteId'];

	  $ClickInfo['click_link'] = $Link;

	  $ClickInfo['referer'] = $sID->fetch('refererID');
	  $ClickInfo['country'] = $this->GEOIP_COUNTRY_CODE;
	  $ClickInfo['ip'] = $_SERVER['REMOTE_ADDR'];

	  $VisitorInfo = $sID->fetch('visitor_info');
	  $ClickInfo['camp'] = $VisitorInfo['camp'];
	  $ClickInfo['subcamp'] = $VisitorInfo['subcamp'];
	  $ClickInfo['keyword'] = $VisitorInfo['keyword'];
	  $ClickInfo['date'] = 'NOW()';

	  //$ClickInfo['info'] = prepareArrayToDb('Visitor Info', $VisitorInfo);
	  $SeoPartParts['db'] = $CLIENT['sitelanguage'];
	  $SeoPartParts['cat_categ'] = $CLIENT['config']['category_code'];
	  $SeoPartParts['cat_subcateg'] = $CLIENT['config']['subcategory_code'];

	  $tabNameParts[] = $_SQL_TABLE['stat_click'];
      $tabNameParts[] = date("Ymd");
      $tabNameParts[] = join($CONFIG['AdminDBTableNameDelim'], $SeoPartParts);

      $this->checkTableExists($tabNameParts, 'createClickTable');
      $TableName = $this->getFullTableName($tabNameParts);

	  makeInsertList($strColumns, $strValues, $ClickInfo, array('date'));
	  $ClickID = insertItem($TableName, $strColumns, $strValues);

      $tabNameParts = array();
	  $tabNameParts[] = $_SQL_TABLE['stat_click_counter'];
      $tabNameParts[] = date("Ymd");
      $tabNameParts[] = join($CONFIG['AdminDBTableNameDelim'], $SeoPartParts);

      $this->checkTableExists($tabNameParts, 'createClickIPCounterTable');
      $TableName = $this->getFullTableName($tabNameParts);

      $Item = getRowByField($TableName, 'ip', $_SERVER['REMOTE_ADDR']);
      if($Item['ip'] != $_SERVER['REMOTE_ADDR'])
      {        $ToDBArr = array();
        $ToDBArr['ip'] = $_SERVER['REMOTE_ADDR'];
        $ToDBArr['count'] = 1;
        $ToDBArr['blocked'] = 'n';
        $ToDBArr['date'] = 'NOW()';
        makeInsertList($strColumns, $strValues, $ToDBArr, array('date'));
	    insertItem($TableName, $strColumns, $strValues);
      }
      else
      {        if($Item['count'] >= $CONFIG['MaxClickCountPerIP'])
        {
          $IPParts = explode(".", trim($_SERVER["REMOTE_ADDR"]));
	  	  $Count = count($IPParts)-1;

	      $IPList = array();
	      $IPList[] = trim($_SERVER["REMOTE_ADDR"]);

	      for($i=$Count; $i>0; $i--)
	      {
	        $IPParts[$i] = "*";
	        $IPList[] = join(".", $IPParts);
	      }

	      $WhiteIPItem = getRowByFields($_SQL_TABLE['white_ip'], array("ip IN ('".join("','", $IPList)."')", "active = 'y'"));
          if(!in_array($WhiteIPItem['ip'], $IPList))
          {
            $ToDBArr = array();
	        $ToDBArr['ip'] = $_SERVER['REMOTE_ADDR'];
            $ToDBArr['active'] = 'n';
            $ToDBArr['date'] = 'NOW()';
            $BlackIPItem = getRowByField($_SQL_TABLE['black_ip'], 'ip', $_SERVER['REMOTE_ADDR']);
            if($BlackIPItem['ip'] == $_SERVER['REMOTE_ADDR'])
            {              makeUpdateList($strSet, $ToDBArr, array('date'));
              updateItem($TableName, $strSet, 'id', $BlackIPItem['id']);
            }
            else
            {
              makeInsertList($strColumns, $strValues, $ToDBArr, array('date'));
              insertItem($_SQL_TABLE['black_ip'], $strColumns, $strValues);
            }
            $sID->assign('IPTestPassed', __FALSE);
            $BlockedFlag = __TRUE;
          }
        }
        $ToDBArr = array();
        $ToDBArr['count'] = 'count + 1';
        $ToDBArr['blocked'] = ($BlockedFlag == __TRUE) ? 'y' : 'n';
        $ToDBArr['date'] = 'NOW()';
        makeUpdateList($strSet, $ToDBArr, array('date', 'count'));
        updateItem($TableName, $strSet, 'ip', $Item['ip']);

      }

	  /*
	  $VisitorSteps = $sID->fetch('visitor_steps');
	  foreach($VisitorSteps as $n => $arr)
	  {
	    $arr[click] = $ClickID;
	    makeInsertList($strColumns, $strValues, $arr);
	    insertItem($_SQL_TABLE['click_steps'], $strColumns, $strValues);
	  } */
    }

    function catchSearchQuery($SearchQuery="")
    {	  global $sID, $CONFIG, $CLIENT, $_SQL_TABLE;

	  if(strlen($SearchQuery) > 3 && $SearchQuery != $sID->fetch('searchQuery'))
	  {
		$sID->assign('searchQuery', $SearchQuery);

		$SeoPartParts['db'] = $CLIENT['sitelanguage'];
	  	$SeoPartParts['cat_categ'] = $CLIENT['config']['category_code'];
	  	$SeoPartParts['cat_subcateg'] = $CLIENT['config']['subcategory_code'];

	  	$tabNameParts[] = $_SQL_TABLE['stat_search_query_count'];
      	$tabNameParts[] = date("Ym01");
      	$tabNameParts[] = join($CONFIG['AdminDBTableNameDelim'], $SeoPartParts);

      	$this->checkTableExists($tabNameParts, 'createSearchQueryCountTable');
      	$TableName = $this->getFullTableName($tabNameParts);

		$QueryStat = array();
      	$QueryStat['query'] = $SearchQuery;
      	$QueryStat['count'] = 1;

      	$QueryRow = getRowByField($TableName, 'query', $SearchQuery);
      	if($QueryRow['query'] == $SearchQuery)
      	{
          $strSet = "count = count + 1";
          updateItem($TableName, $strSet, 'query', $SearchQuery);
		}
		else
		{		  makeInsertList($strColumns, $strValues, $QueryStat);
		  $QueryRow['id'] = insertItem($TableName, $strColumns, $strValues);
		}

      	$QueryStat = array();
      	$QueryStat['client_domain'] = __CFG_CLIENT_ID;
		$QueryStat['query'] = $QueryRow['id'];
		$QueryStat['country'] = $this->GEOIP_COUNTRY_CODE;
		$QueryStat['ip'] = $_SERVER['REMOTE_ADDR'];
		$QueryStat['date'] = 'NOW()';

      	$tabNameParts = array();
      	$tabNameParts[] = $_SQL_TABLE['stat_search_query'];
      	$tabNameParts[] = date("Ym01");
      	$tabNameParts[] = join($CONFIG['AdminDBTableNameDelim'], $SeoPartParts);

      	$this->checkTableExists($tabNameParts, 'createSearchQueryTable');
      	$TableName = $this->getFullTableName($tabNameParts);

		makeInsertList($strColumns, $strValues, $QueryStat, array('date'));
		insertItem($TableName, $strColumns, $strValues);
	  }
    }

  }

?>