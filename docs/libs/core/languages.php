<?php



	if(!__CFG_ADMIN_PANEL)
	{
		if(isBlank($_GET[$CONFIG['SiteLangVarName']]))
		{
			$_GET[$CONFIG['SiteLangVarName']] = $CONFIG['SiteLanguage'];
		}
		define('__LANG', $_GET[$CONFIG['SiteLangVarName']]);
		define('__FLANG', "_".__LANG);
		$sID->assign("LANG", __LANG);

		$SITE_LANGS = $LANGS = getTableAsArrayByKeyField($_SQL_TABLE['language'], 'code2', 'position', array("status_id = '1'", "site_lang = '1'"));

		if(isEmptyArr($LANGS) || isBlank($LANGS[__LANG]['code2'])/* || !is_file(__CFG_PATH_LANGUAGES_GENERATED.$LANGS[__LANG]['filename'])*/)
		{
			foreach($LANGS as $code => $arr)
			{
				showMessageAlertJVSC($CONFIG['ErrorLanguageInactive']);
				$URL_WITHOUT_LANG = getSameUriWithoutLangPath(__LANG);
				go_toJVSC("/".$code.$URL_WITHOUT_LANG);
				exit;
			}
		}
		else
		{
			//include_once __CFG_PATH_LANGUAGES_GENERATED.$LANGS[__LANG]['filename'];
			$sID->assign("langPath", "/".__LANG);
			$URL_WITHOUT_LANG = getSameUriWithoutLangPath(__LANG);
			$sID->assign("URL_WITHOUT_LANG", $URL_WITHOUT_LANG);
		}
	}
	else
	{
		if(!isBlank($_GET[$CONFIG['AdminLangVarName']]))
		{
			$sID->assign("ADMIN_LANG", $_GET[$CONFIG['AdminLangVarName']]);
		}
		elseif(isBlank($_GET[$CONFIG['AdminLangVarName']]) && isBlank($sID->fetch("ADMIN_LANG")))
		{
			$_GET[$CONFIG['AdminLangVarName']] = $CONFIG['AdminLanguageCode'];
		}
		elseif(isBlank($_GET[$CONFIG['AdminLangVarName']]) && !isBlank($sID->fetch("ADMIN_LANG")))
		{
			$_GET[$CONFIG['AdminLangVarName']] = $sID->fetch("ADMIN_LANG");
		}
		define('__LANG', $_GET[$CONFIG['AdminLangVarName']]);
		define('__FLANG', "_".__LANG);

		$LANGS = getTableAsArrayByKeyField($_SQL_TABLE['language'], 'code2', 'position', array("status_id = '1'", "admin_lang = '1'"));
		//print_r($LANGS);
		$SITE_LANGS = getTableAsArrayByKeyField($_SQL_TABLE['language'], 'code2', 'position', array("status_id = '1'", "site_lang = '1'"));
		//print_r($LANGS);
		//exit;
		if(isEmptyArr($LANGS) || isBlank($LANGS[__LANG]['code2'])/* || !is_file(__CFG_PATH_LANGUAGES_GENERATED.$LANGS[__LANG]['filename'])*/)
		{
			foreach($LANGS as $code => $arr)
			{
				showMessageAlertJVSC($CONFIG['ErrorLanguageInactive']);
				$URL_WITHOUT_LANG = getSameUriWithoutLangVar(__LANG, $CONFIG['AdminLangVarName']);
				go_toJVSC($URL_WITHOUT_LANG."&".$CONFIG['AdminLangVarName']."=".$code);
				exit;
			}
		}
		else
		{
			//require_once __CFG_PATH_LANGUAGES_GENERATED.$LANGS[__LANG]['filename'];
			$URL_WITHOUT_LANG = getSameUriWithoutLangVar(__LANG, $CONFIG['AdminLangVarName']);
			$sID->assign("URL_WITHOUT_LANG", $URL_WITHOUT_LANG);
		}
	}

$language = array();
$language = getLanghtArray(__LANG, __CFG_ZONE);

$language['charset'] = $CONFIG['siteCharset'];
$language['contentLanguage'] = __LANG;
//print_r($temp);

function getLanghtArray($language, $zone)
{
    global $_SQL_TABLE, $dbSet;

    $langArray = array();
    $zoneArray = getRowByField($_SQL_TABLE['site_zone'], 'site_zone_code', $zone);
    $group = getTableAsArray($_SQL_TABLE['lang_variable_group']);

    $newArray = array();
    foreach($group as $key => $val)
    {
        $groupArray[$val['lang_variable_group_id']] = $val['lang_variable_group_name'];
    }

    $langTable = array();
    $langTable = getTableAsArray($_SQL_TABLE['lang_variable'], '', array('site_zone_id = "'.$zoneArray['site_zone_id'].'"'), '', 'lang_variable_name, lang_variable_value_'.$language.' AS variable_value, lang_variable_group_id');

    foreach($langTable as $langValue)
    {
        $langArray[$groupArray[$langValue['lang_variable_group_id']]][$langValue['lang_variable_name']] = $langValue['variable_value'];
    }

    return $langArray;
}
?>