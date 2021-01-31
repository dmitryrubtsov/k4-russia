<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.header_logo_block.tpl'))
	{
		$query = "	SELECT a.article_id, ai.body".__FLANG." AS body
					FROM ".$_SQL_TABLE['article']." a
					INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
	 				WHERE a.active = 1
	 				AND a.article_id IN ('7')
				";
		$dbSet->open($query);
		$HeaderLogoBlock = $dbSet->fetchArray();
		$tpl->assign('HeaderLogoBlock', $HeaderLogoBlock);
	}

	$pct->setBlock("HeaderLogoBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.header_logo_block.tpl'));

?>