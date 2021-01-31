<?PHP

  $debug=1;
  function dprint($msg){
   global $debug;
   if ($debug==1)
    echo "debug: $msg<BR>";

  }

  function getPoolsFromIP($IP)
  {
    $IPParts = explode(".", trim($IP));
	$Count = count($IPParts)-1;

	$IPList = array();
	$IPList[] = trim($IP);

	for($i=$Count; $i>0; $i--)
	{
	  $IPParts[$i] = "*";
	  $IPList[] = join(".", $IPParts);
	}
	return $IPList;
  }

  function get_input_vars(){
    global $HTTP_SERVER_VARS;
    $REQUEST_METHOD = $HTTP_SERVER_VARS['REQUEST_METHOD'];
    global $HTTP_POST_VARS;
    global $HTTP_GET_VARS;

    $vars = $REQUEST_METHOD == 'POST' ? $HTTP_POST_VARS : $HTTP_GET_VARS;
    foreach ($vars as $k=>$v){
        if (is_array($v)) continue;
        if (get_magic_quotes_gpc()) $v = stripslashes($v);
        $vars[$k] = trim($v);
    }
    return $vars;
}


  function getmicrotime(){
    list($usec, $sec) = explode(" ",microtime());
    return ((float)$usec + (float)$sec);
  }

	function generate_password($plength = 8)
	{
		srand((double)microtime()*1000000);
		$password_letters = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$maxlet = strlen($password_letters)-1;
		$password = "";
		for($i = 1; $i <= $plength; $i++)
		{
			$password .= $password_letters{rand(0,$maxlet)};
		}
		return $password;
	}

  function generate_letters($plength = 8)
  {
	srand((double)microtime()*1000000);
	$password_letters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$maxlet = strlen($password_letters)-1;
	$password = "";
	for($i = 1; $i <= $plength; $i++)
	{
	  $password .= $password_letters{rand(0,$maxlet)};
	}
	return $password;
  }

  function generate_captcha($plength = 5)
  {
  	srand((double)microtime()*1000000);
  	$password_letters = "1234567890";
  	$maxlet = strlen($password_letters)-1;
  	$password = "";
  	for($i = 1; $i <= $plength; $i++)
  	{
  		$password .= $password_letters{rand(0,$maxlet)};
  	}
  	return $password;
  }

	function showMessageJVSC($message)
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

	function showMessageAlertJVSC($message)
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

function isUserIsset(&$USER)
{
  if(count($USER) == 0 || $USER['isLogin'] == false || count($USER['info']) == 0 || isBlank($USER['info']['email']))
  {
    return false;
  }
  return true;
}

function checkUserPage(&$USER, $redirectURL="")
{
	global $sID, $tpl, $CONFIG;

	if ($redirectURL=="")
		$redirectURL = "login".$CONFIG['webPageFileType'];

	if(!isUserIsset($USER))
	{
	   go_to(getPath().$redirectURL);
       exit;
	}
}

	function checkAdminPage($redirectURL="")
	{
		global $sID, $tpl, $ADMIN, $_SQL_TABLE;

		if(isBlank($redirectURL))
		{
			$redirectURL = "index.php?mode=login";
		}

		$Result = getRowByFields($_SQL_TABLE['admin_user'], array("login = '".$ADMIN['AdmLogin']."'", "password = '".$ADMIN['AdmPass']."'", "admin_user_group_id = '".$ADMIN['AdmGroup']."'"));
		if(!$sID->assigned("isAdminLogin") && $_REQUEST['mode'] != 'login')
		{
			$sID->assign("LoginMode", $_REQUEST['mode']);
			$sID->assign("LoginRedirect", getSameUri());
			go_to($redirectURL);
			exit;
		}
		elseif($_REQUEST['mode'] != 'login' && !isBlank($Result['login']) && ($Result['login'] != $ADMIN['AdmLogin'] || $Result['password'] != $ADMIN['AdmPass'] || $Result['admin_user_group_id'] != $ADMIN['AdmGroup']))
		{
			$sID->assign("LoginMode", $_REQUEST['mode']);
			$sID->assign("LoginRedirect", getSameUri());
			go_to($redirectURL);
			exit;
		}
		elseif ($_REQUEST['mode'] != 'login' && isBlank($Result['login']) && ($ADMIN['AdmLogin'] != __CFG_ADMIN_USERNAME || $ADMIN['AdmPass'] != __CFG_ADMIN_PASSWORD ))
		{
			$sID->assign("LoginMode", $_REQUEST['mode']);
			$sID->assign("LoginRedirect", getSameUri());
			go_to($redirectURL);
			exit;
		}
	}

	function checkAuthentication($loginURL=null)
	{
		global $sID, $ADMIN, $_SQL_TABLE, $dbSet, $noAuthModes, $Mode;

		if(in_array($Mode, $noAuthModes))
		{
			return true;
		}

		$ADMIN['user_id'] = $sID->fetch('admin');

        if(is_null($loginURL))
        {
        	$loginURL = "index.php?mode=login";
        }
		if(!$ADMIN['user_id'])
		{
			go_to($loginURL."&r=".urlencode($_SERVER['REQUEST_URI']));
			exit;
		}
		elseif($ADMIN['user_id'] == __CFG_ADMIN_USER_ID)
		{
			define('__LAMER', true);
		}
		else
		{
//            // Only active status users
//            $query = "
//		 			SELECT 	u.*, ua.*, ui.*,
//		 					l.code2 AS language_code
//		 			FROM ".$_SQL_TABLE['user']." u
//		 			INNER JOIN ".$_SQL_TABLE['user_auth']." ua ON ua.user_id = u.user_id
//		 			INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = u.user_id
//		 			LEFT JOIN ".$_SQL_TABLE['language']." l ON l.language_id = u.language_id
//					WHERE u.user_id = '".$ADMIN['user_id']."'
//					AND u.user_status_id = 1
//			";
//            $dbSet->open($query);
//            $ADMIN['user'] = $dbSet->fetchArray();
//
//            if(!$ADMIN['user']['user_id'])
//            {
//                $sID->assign('admin', null);
//                go_to($loginURL.'&from=NOT_USER_ID3');
//                exit;
//            }
//
//            $query = "
//		  			SELECT 	aug.admin_user_group_id
//		  			FROM ".$_SQL_TABLE['admin_user_group']." aug
//		  			LEFT JOIN ".$_SQL_TABLE['user_leader_type_admin_user_group']." ultaug ON ultaug.admin_user_group_id = aug.admin_user_group_id
//		  			WHERE ultaug.user_leader_type_id = '".$ADMIN['user']['user_leader_type_id']."'
//		  			UNION
//		  			SELECT 	aug.admin_user_group_id
//		  			FROM ".$_SQL_TABLE['admin_user_group']." aug
//		  			LEFT JOIN ".$_SQL_TABLE['user_admin_user_group']." uaug ON uaug.admin_user_group_id = aug.admin_user_group_id
//		  			WHERE uaug.user_id = '".$ADMIN['user_id']."'
//			";
//            $dbSet->open($query);
//
//            // User leader info
//            if($ADMIN['user']['leader_user_id'])
//            {
//                $query = "
//			 			SELECT 	ua.*, ui.*
//			 			FROM ".$_SQL_TABLE['user_auth']." ua
//			 			INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = ua.user_id
//						WHERE ua.user_id = '".$ADMIN['user']['leader_user_id']."'
//				";
//                $dbSet->open($query);
//                $ADMIN['leader'] = $dbSet->fetchArray();
//            }
//
//            // User inviter info
//            $userInviter = getFieldByEnother('referer_user_id', $_SQL_TABLE['user_referer'], 'user_id', $ADMIN['user_id']);
//            if($userInviter)
//            {
//                $query = "
//			 			SELECT 	ua.*, ui.*
//			 			FROM ".$_SQL_TABLE['user_auth']." ua
//			 			INNER JOIN ".$_SQL_TABLE['user_info']." ui ON ui.user_id = ua.user_id
//						WHERE ua.user_id = '".$userInviter."'
//				";
//                $dbSet->open($query);
//                $ADMIN['inviter'] = $dbSet->fetchArray();
//            }


			// Only active status users

			$query = "
		 			SELECT 	u.*
		 			FROM ".$_SQL_TABLE['admin_user']." u
					WHERE u.admin_user_id = '".$ADMIN['user_id']."'
					AND u.active = 1
			";
			$dbSet->open($query);
			$ADMIN['user'] = $dbSet->fetchArray();
			if(!$ADMIN['user']['admin_user_id'])
			{
				$sID->assign('admin', null);
				go_to($loginURL.'&from=NOT_USER_ID');
				exit;
			}
		}
		define('__LAMER', false);
	}


function allow($operation=""){
	global $sID, $tpl;

	// if admin performs operation
	if ($sID->assigned("isAdminLogin")){
		// logon as demo admin
		if ($sID->assigned("demoAdmin")){
			$da = $sID->fetch("demoAdmin");
			if ($da) return 0;
			else return 1;
		}
		else return 1;
	}

	// allow for everyone
	return 1;
}





function getOption($option=null, $def=NULL){
	global $dbObj, $_SQL_TABLE;
	static $options = array();
	$option = strtolower($option);
	if (!$options || !isset($option)) {
		$dbSet = new xxDataset($dbObj);
		$dbSet->open("SELECT name, value FROM ".$_SQL_TABLE['configuration']);
		$options = $dbSet->fetchPairs("name","value");
	}
	return isset($options[$option]) ? $options[$option] : $def;
}




  function isBlank($v){
  	//if (!isset($v) || empty($v) || $v=="" || $v==0){
  	if (!isset($v) || empty($v) || trim($v)==""){
  		return true;
  	}
  	return false;
  }

  function isEmptyArr($arr)
  {
  	if(count($arr) == 0)return true;
  	elseif(!is_array(reset($arr)) && isBlank(reset($arr)))return true;
  	else return false;
  }

  function isNotFullArr($arr, $MinCount=2)
  {
  	if(count($arr) < $MinCount)return true;
  	else return false;
  }

  function array_kv($array, $key, $arrkey = '')
  {
  	$result=array();
  	if($arrkey == '')
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

	function go_to($address, $redirects301 = 'y')
	{
		validateURL($address);
		if (preg_match("/\?/",$address))
			$delim = "&";
		else
			$delim = "?";

		if(__CFG_CLIENT_SCRIPT)
		{
			global $xmlp;
			$xmlp->setRedirect($address);
			$xmlp->display();
			exit;
		}
		else
		{
            if ($redirects301)
                Header("HTTP/1.1 301 Moved Permanently");
            Header("Location: " . $address);
		}
	}

  function go_toJVSC($address)
  {
	validateURL($address);
	if (preg_match("/\?/",$address))
		$delim = "&";
	else
		$delim = "?";
	$output = "<script language='javascript'>document.location.href='".$address."';</script>";
	if(__CFG_CLIENT_SCRIPT)
    {
  	  global $xmlp;
  	  $xmlp->addPageContent($output);
  	  $xmlp->display();
  	  exit;
    }
    else
    {
      echo $output;
    }
  }

  function go_toPOST($address, &$dataArr)
  {
	validateURL($address);
	$output = "<html><body onload='submitForm()'><form method='POST' action='".$address."' name='formpost'>";
	foreach($dataArr as $name => $value)
	{
	  $output .= "<input type='hidden' name='".$name."' value='".$value."'>";
	}
	$output .= "</form>";
	$output .= "<script language='javascript'>";
	$output .= "function submitForm() { document.forms['formpost'].submit(); }";
	$output .= "</script></body></html>";
	if(__CFG_CLIENT_SCRIPT)
    {
  	  global $xmlp;
  	  $xmlp->addPageContent($output);
  	  $xmlp->display();
  	  exit;
    }
    else
    {
      echo $output;
    }
  }

  function go_to_new_windowJVSC($address)
  {
	validateURL($address);
	if (preg_match("/\?/",$address))
		$delim = "&";
	else
		$delim = "?";
	$output = "<script language='javascript'>myRef = window.open('".$address."', 'w".mktime()."');</script>";
	if(__CFG_CLIENT_SCRIPT)
    {
  	  global $xmlp;
  	  $xmlp->addPageContent($output);
  	  $xmlp->display();
  	  exit;
    }
    else
    {
      echo $output;
    }
  }

  function getPath($lang='')
  {
    global $CONFIG;

    if(isBlank($lang))
    {
      $lang = __LANG;
    }

    $path = '/';
	if($CONFIG['EnableMultiLanguage'] == 'y')
	{
	  $path = '/'.$lang.__CFG_LINK_PART_SEPARATOR;
	}
    return $path;
  }

    function get_uri($array = array())
    {
       global $CONFIG;
       return getPath().join(__CFG_LINK_PART_SEPARATOR, $array).$CONFIG['webPageFileType'];
    }
  function validateURL(&$URL)
  {
    $URLParts = parse_url($URL);
    $validPath = str_replace('//', '/', $URLParts['path']);
    $URL = str_replace($URLParts['path'], $validPath, $URL);
  }


  function checksToArray($check=array())
  {
	$ids=array();
	if (isset($check)){
		foreach ($check as $id){
			$ids[] = $id;
		}
	}
	return $ids;
  }


  function prn($var)
  {
		echo "<PRE>";
		print_r($var);
		echo "</PRE>";
  }



  function checkSecurityNumber($operation, $memberType="member", $userSecurity){
	global $sID;


	if (getOption($memberType.$operation."Security",0)==0)
		return 1;

	$security = 0;

	$userSecurity = isset($userSecurity) ? $userSecurity : "";
	$sessionSecurity = $sID->get('SecurityNumber',"");

	//dprint("user=$userSecurity, sess=$sessionSecurity");
	if (strlen($userSecurity)==7 && $sessionSecurity!="" && strtolower($userSecurity)==$sessionSecurity)
   		$security = 1;
   	return $security;
  }

  function prepareSecurityNumber()
  {
    global $sID, $CONFIG;

    $sID->assign('secureCode', generate_captcha($CONFIG['secureImageSymbols']));
  }
  function getSecurityNumber()
  {
    global $sID;

    return $sID->fetch('secureCode');
  }

  function isGdLoaded(){
	return extension_loaded('gd');
  }

  function ip2ulong($ip) {
	$ipn=ip2long($ip);
	if ($ipn == -1)
		return false;
	if($ipn<0) {
		$ipn=$ipn+4294967296;
	}
	return $ipn;
  }

  function today2time($format="string" /*"int"*/, $start_end = 0){
	$today = getdate();
	$y = $today['year'];
	$m = $today['month'];
	$d = $today['mday'];

	$today_start = strtotime("$d $m $y");
	$today_end = $today_start + 60*60*24;

	$t = ($start_end==0 ? $today_start : $today_end);
	if ($format!="string")
		return $t;

	if ($format=="string"){
		$d = getdate($t);
		$y = $d['year'];
		$m = $d['month'];
		$d = $d['mday'];

		return "$d $m $y";
	}

	return 0;
  }

    function checkDomainName()
    {

        if(!strstr($_SERVER['HTTP_HOST'], 'www.') && count(explode('.', $_SERVER['HTTP_HOST'])) < 3)
        {

            preg_match("/^[^\/]+/", $_SERVER['SERVER_PROTOCOL'], $matches);
            $Protocol = strtolower($matches[0]);
            go_to($Protocol."://www.".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
            exit;
        }
    }

  function makeFolderName($dataArr, &$Dir, &$DirOld, &$DirNew)
  {
  	global $WorkTable, $WorkTableKeyFieldName;

  	/*$dataArr['folderNameField'] = 'linkname';
  	$dataArr['folderNameTable'] = $_SQL_TABLE['cut_type'];
  	$dataArr['folderNameKeyField'] = 'id';
  	$dataArr['folderNamePostVarName'] = 'cut_type';
    */

    if(isEmptyArr($_POST['item']))
    {
      $DirOld = getFieldByEnother($dataArr['folderNameField'], $dataArr['folderNameTable'], $dataArr['folderNameKeyField'], getFieldByEnother($dataArr['folderNamePostVarName'], $WorkTable, $WorkTableKeyFieldName, $_GET[getKeyVarName()]));
      $DirNew = getFieldByEnother($dataArr['folderNameField'], $dataArr['folderNameTable'], $dataArr['folderNameKeyField'], $_POST[$dataArr['folderNamePostVarName']])."/";
      $Dir = ((!isBlank($_POST[$dataArr['folderNamePostVarName']])) ? $DirNew : $DirOld);
    }
    else
    {
      foreach($_POST['item'] as $id)
      {
        $DirOld[$id] = getFieldByEnother($dataArr['folderNameField'], $dataArr['folderNameTable'], $dataArr['folderNameKeyField'], getFieldByEnother($dataArr['folderNamePostVarName'], $WorkTable, $WorkTableKeyFieldName, $id));
        $DirNew[$id] = getFieldByEnother($dataArr['folderNameField'], $dataArr['folderNameTable'], $dataArr['folderNameKeyField'], $_POST[$dataArr['folderNamePostVarName']][$id])."/";
        $Dir[$id] = ((!isBlank($_POST[$dataArr['folderNamePostVarName']][$id])) ? $DirNew[$id] : $DirOld[$id]);
      }
    }
  }

  function make_path($constPath, $pathVars=array())
  {
    $flag = 0;
    foreach($pathVars as $n => $arr)
    {
      if(is_array($arr) && !isEmptyArr($arr))
      {
      	$flag = 1;
      	$keyArr = $n;
      	break;
      }
    }
    if($flag == 1)
    {
	  foreach($pathVars[$keyArr] as $id => $value)
	  {
	    $Path[$id] .= $constPath;
	    foreach($pathVars as $m => $array)
	    {
	      $Path[$id] .= $array[$id];
	    }
	  }
    }
    else
    {
      $Path .= $constPath.(($constPath[(strlen($constPath)-1)] != '/') ? '/' : '');
      foreach($pathVars as $m => $value)
	  {
	    $Path .= $value.(($value[(strlen($value)-1)] != '/') ? '/' : '');
	  }
    }
    return $Path;
  }

  function getKeyVarName($KeyFieldName='')
  {
  	global $CONFIG, $WorkTableKeyFieldName;
    return $CONFIG['keyVarPrefix'].((!isBlank($KeyFieldName)) ? $KeyFieldName : $WorkTableKeyFieldName);
  }

  function getLangVarByKey($keyName1, $keyName2='')
  {
  	global $CONFIG, $language;

  	if(isBlank($keyName2))
  	{
  	  return $language[$keyName1];
  	}
  	else
  	{
	  return $language[$keyName1][$keyName2];
  	}
  }

  function getLangVarsInArray($Array, $keyName = '')
  {
  	if(isBlank($keyName))
  	{
  	  foreach($Array as $key => $val)
  	  {
  	    $Array[$key] = getLangVarByKey($val);
  	  }
    }
    else
    {
	  foreach($Array as $key => $val)
  	  {
  	    $Array[$key] = getLangVarByKey($keyName, $val);
  	  }
    }
    return $Array;
  }

  function check_linkname($title)
  {
  	if(isBlank($title))
  	{
  	  return true;
  	}
  	for($n=0;$n<strlen($title);$n++)
  	{
  	  $char = ord($title[$n]);
  	  if(!($char >= 95 && $char <= 122 || $char >= 48 && $char <= 57 || $char == 45 || $char == 46))
  	  {
  	    return true;
  	  }
  	}
  }

  function make_linkname($title,$flag=true,$Delim='',$IgnoreArr=array())
  {
  	global $CONFIG, $MakeLinkNameSearchArr, $MakeLinkNameReplaceArr;
  	$SearchArr = $MakeLinkNameSearchArr;
  	$ReplaceArr = $MakeLinkNameReplaceArr;
  	if(!isEmptyArr($IgnoreArr))
  	{
  	  foreach($SearchArr as $n => $val)
  	  {
  	    if(in_array($val, $IgnoreArr))
  	    {
  	      unset($SearchArr[$n]);
  	      unset($ReplaceArr[$n]);
  	    }
  	  }
  	}

    if(isBlank($Delim))
    {
      $Delim = $CONFIG['AdminLinkNameDelim'];
    }
    if(is_string($title) && !isBlank($title))
  	{
  	  $linkname = _make_linkname($title, $Delim, $SearchArr, $ReplaceArr);
    }
    elseif(is_array($title) && !isEmptyArr($title) && !is_array($title[0]) && $flag)
    {
      foreach($title as $n => $val)
      {
      	$linkname[$n] = _make_linkname($val, $Delim, $SearchArr, $ReplaceArr);
      }
    }
    elseif(is_array($title) && !isEmptyArr($title) && !is_array($title[0]) && !$flag)
    {

      foreach($title as $n => $val)
      {
      	$newarr[] = $val;
      }
      $linkname = _make_linkname(join(' ',$newarr), $Delim, $SearchArr, $ReplaceArr);
    }
    elseif(is_array($title) && !isEmptyArr($title) && is_array($title[0]))
    {
      $Counts = count($title);
      foreach($title[0] as $n => $val)
      {
      	$newarr = array();
      	for($i=0;$i<$Counts;$i++)
      	{
      	  $newarr[] = $title[$i][$n];
      	}
      	$linkname[$n] = _make_linkname(join(' ',$newarr), $Delim, $SearchArr, $ReplaceArr);
      }
    }
    return $linkname;
  }

  function _make_linkname($title, $Delim, $SearchArr, $ReplaceArr)
  {
    return preg_replace('/('.$Delim.'{2,})/s', $Delim, str_replace(' ', $Delim, trim(str_replace($SearchArr, $ReplaceArr, stripslashes(strToLowerCase($title))))));
  }

  function make_tablename($title,$flag=true)
  {
  	global $CONFIG;

    return make_linkname($title, $flag, $CONFIG['AdminDBTableNameDelim'], array('%'));
  }

  function correct_dialects($title, $SearchArr=array(), $ReplaceArr=array())
  {
    global $DialectSymbolSearch, $DialectSymbolReplace;

    if(isEmptyArr($SearchArr))
    {
      $SearchArr = $DialectSymbolSearch;
    }
    if(isEmptyArr($ReplaceArr))
    {
      $ReplaceArr = $DialectSymbolReplace;
    }

    return str_replace($SearchArr, $ReplaceArr, stripslashes($title));
  }

  function unescapeValue($string)
  {
    $search = array('&amp;', '&quot;', '&#039;', '&lt;', '&gt;');
    $replace = array('&', '"', "'", '<', '>');
    return stripslashes(str_replace($search, $replace, $string));
  }

  function prepareArrayToDb($name, $array)
  {
    $str = "\n--- ".$name." ---\n";
    foreach($array as $key => $value)
    {
      if(is_array($value))
      {
      	$str .= prepareArrayToDb($key, $value);
      }
      else
      {
      	$str .= $key.": ".$value."\n";
      }
    }
    return addslashes($str);
  }


  function replaceVariables(&$vars, &$str)
  {
    global $CONFIG;
    foreach($vars as $key => $value)
    {
      $str = str_replace($CONFIG['RVarLDelim'].strToUpperCase($key).$CONFIG['RVarRDelim'], $value, $str);
    }
  }

  function make_rand_sin($min, $max, $int='', $precision=0, $gain=1)
  {
    if(intval($int) == 0)
    {
      $int = time();
    }
    $mult = pow(10, $precision);
    $val = abs(sin($int+$gain)) * (($max - $min) * $mult) + $min * $mult;
    return round($val/$mult, $precision);
  }

  function make_rand_cos($min, $max, $int='', $precision=0, $gain=1)
  {
    if(intval($int) == 0)
    {
      $int = time();
    }
    $inv_precision = 0-$precision;
    $val = abs(cos($int+$gain)) * round(($max - $min), $inv_precision) + round($min, $inv_precision);
    return round($val/pow(10, $precision), $precision);
  }

	function getSameUri()
	{
		return $_SERVER['REQUEST_URI'];
	}

  function getConstUri()
  {
    $pos = strpos(getSameUri(), '?');
    if($pos > 0 || $pos === 0)
    {
      return substr(getSameUri(),0,$pos);
    }
    return getSameUri();
  }

  function getSameUriWithoutLangPath($langCode)
  {
    return str_replace('/'.$langCode.'/', '/', $_SERVER['REQUEST_URI']);
  }

  function getSameUriWithoutLangVar($langCode, $langVar = 'lang')
  {
    $str = str_replace('&'.$langVar.'='.$langCode, '', $_SERVER['REQUEST_URI']);
    return str_replace($langVar.'='.$langCode, '', $str);
  }

  function getSameUriWithoutVar($VarName)
  {
    $VarValue = $_GET[$VarName];
    $str = str_replace('&'.$VarName.'='.$VarValue, '', $_SERVER['REQUEST_URI']);
    return str_replace($VarName.'='.$VarValue, '', $str);
  }

  function getSameUriWithoutVars($VarNames = array())
  {
    $str = $_SERVER['REQUEST_URI'];
    foreach($VarNames as $n => $VarName)
    {
      $VarValue = $_GET[$VarName];
      $str = str_replace('&'.$VarName.'='.$VarValue, '', $str);
      $str = str_replace($VarName.'='.$VarValue, '', $str);
    }
    return $str;
  }

  function strToUpperCase($string)
  {
    return mb_convert_case($string, MB_CASE_UPPER, __LANG_CHARSET);
  }

  function strToLowerCase($string)
  {
    return mb_convert_case($string, MB_CASE_LOWER, __LANG_CHARSET);
  }

  function strCapitalize($string)
  {
    return mb_strtoupper(mb_substr($string, 0, 1, __LANG_CHARSET), __LANG_CHARSET).mb_substr($string, 1, mb_strlen($string, __LANG_CHARSET), __LANG_CHARSET);
  }

  function strCapitalizeAll($string)
  {
    return mb_convert_case($string, MB_CASE_TITLE, __LANG_CHARSET);
  }

    function pageNotFound()
    {
        /*
        global $ToOutput, $CONFIG, $language, $tpl, $pct, $xmlp;

        $SmartyTplName = 'frontend.main.tpl';

        $tpl->assign("PageTitle", $language['front']['pageNotFound']);
        $TplName = $CONFIG['ModulesFolder']."module.error.tpl";
        $cont = $tpl->fetch($TplName);
        $pct->setMainContent($cont);
        $pct->assignParams();
        if(__CFG_CLIENT_SCRIPT)
        {
            $xmlp->PageNotFound($tpl->fetch($SmartyTplName));
            exit;
        }
        header('Content-type: text/html; charset='.$language['charset']);
        header(__HEADER_PAGE_NOT_FOUND);
        $tpl->display($SmartyTplName);
        exit;
        */

        header('Content-type: text/html; charset='.$language['charset']);
        header(__HEADER_PAGE_NOT_FOUND);

        header('HTTP/1.1 301 Moved Permanently');
		header('Location: '.$HOST.'error'.$CONFIG['webPageFileType']);
		exit();
    }

  function uriPathToGETParams($uri, $CONFIG)
  {
  	if(($charPos = strpos($uri, '?')) !== false)
  	{
  		$uri = substr($uri, 0, $charPos);
  	}

  	$uriArr = explode($CONFIG['linkPartSeparator'], $uri);
  	foreach($uriArr as $n => $part)
  	{
  		if(!$part)
  		{
  			unset($uriArr[$n]);
  		}
  	}

  	if(sizeof($uriArr))
  	{
  		$last = array_pop($uriArr);
  		$len = strlen($CONFIG['webPageFileType']);
  		if(substr($last, -$len) == $CONFIG['webPageFileType'])
  		{
  			$last = substr($last, 0, -$len);
  		}
  		array_push($uriArr, $last);

  		if($CONFIG['EnableMultiLanguage'] == 'y')
  		{
  			$_GET[$CONFIG['SiteLangVarName']] = array_shift($uriArr);
  		}

  		$keysArr = explode(',', $CONFIG['GETArrKeys']);
  		foreach($uriArr as $param)
  		{
  			$_GET[array_shift($keysArr)] = $param;
  		}
  	}

  }

	function arrayToTree($Array, $root=0, $rootField='root', $idField='id', $childField='children')
	{
		return _arrayToTree($Array, $root, $rootField, $idField, $childField);
	}

	function _arrayToTree(&$Array, $root=0, $rootField='root', $idField='id', $childField='children')
	{
		$children = array();
		foreach($Array as $id => $arr)
		{
			if($arr[$rootField] == $root)
			{
				unset($Array[$id]);
				$arr[$childField] = _arrayToTree($Array, $arr[$idField], $rootField, $idField, $childField);
				$children[] = $arr;
			}
		}
		reset($Array);
		return $children;
	}

	function treeToSelectList($Array, $root=0, $rootField='root', $titleField="title", $childField='children', $prefix="&nbsp;&nbsp;")
	{
		$list = array();
		foreach($Array as $id => $arr)
		{
			$arr[$titleField] = str_repeat($prefix,$root).$arr[$titleField];
			$sublist = array();
			if(sizeof($arr[$childField]) > 0)
			{
				$sublist = treeToSelectList($arr[$childField], ($root+1), $rootField, $titleField, $childField, $prefix);
			}
			unset($arr[$childField]);
			$key = $arr[$rootField]."_".$id;
			$list[$key] = $arr;
			$list = array_merge($list, $sublist);
		}
		return $list;
	}

    function getMinPresentValue($valueArray)
    {
        if($valueArray)
        {
            $partArr = array();
            foreach($valueArray as $val)
            {
                if($val > 0)
                {
                    $partArr[] = $val;
                }
            }
        }

        return min($partArr);
    }


?>