<?

	if(!$tpl->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.lang_menu_block.tpl'))
	{
		$query = "	SELECT code2, title
					FROM ".$_SQL_TABLE['language']."
					WHERE site_lang = '1'
					AND status_id = '1'
					ORDER BY position DESC
		";
		$dbSet->open($query);
		$LangMenuArray = $dbSet->fetchRowsAll();

		foreach($LangMenuArray as $n => $lang)
		{
			if(is_file(__CFG_CORE_PATH.$CONFIG['MainImageFolder'].'tpl/'.$lang['code2'].'.jpg'))
			{
				$LangMenuArray[$n]['flag'] = $HOST.$CONFIG['MainImageFolder'].'tpl/'.$lang['code2'].'.jpg';
			}
		}
		$tpl->assign('LangMenuArray', $LangMenuArray);
	}
	$pct->setBlock("LangMenuBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.lang_menu_block.tpl'));

?>