<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.banner_right_column.tpl'))
	{
        $Banner = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
                array(
                    'text' => 'text'.__FLANG
                )
            )
            ->where('a.article_id = 25')
            ->where('a.active = 1')
            ->fetchRow();

        $tpl->assign('BannerRight', $Banner['text']);
	}

	$pct->setBlock("BannerRightColumn", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.banner_right_column.tpl'));

?>