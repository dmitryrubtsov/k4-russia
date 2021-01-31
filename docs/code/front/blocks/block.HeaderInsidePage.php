<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.header_inside_page.tpl'))
	{
		//$sitemapLink = $BaseURL.'sitemap'.$CONFIG['webPageFileType'];
		//$pct->assign('sitemapLink', $sitemapLink);
		$query = "	SELECT a.article_id, ai.body".__FLANG." AS body
					FROM ".$_SQL_TABLE['article']." a
					INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
	 				WHERE a.active = 1
	 				AND a.article_id IN ('3')
				";
		$dbSet->open($query);
		$result = $dbSet->fetchRowsAll();
		foreach($result as $n => $arr)
		{
			$HeadBlock[$arr['article_id']] = $arr;
		}
		$tpl->assign('HeadBlock', $HeadBlock);
	}
	$pct->setBlock("HeaderInsidePage", $pct->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.header_inside_page.tpl'));

?>