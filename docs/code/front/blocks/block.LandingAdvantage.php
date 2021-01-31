<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.landing_advantage.tpl'))
	{
        $LandingAdvantage = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
            ->columns(
                array(
                    'text' => 'ai.description'.__FLANG
                )
            )
            ->where('a.active = 1')
            ->where('a.article_type_id = 5')
            ->order('a.position ASC')
            ->group('a.article_id')
            ->fetchAll();
        $tpl->assign("LandingAdvantage", $LandingAdvantage);

	}

	$pct->setBlock("LandingAdvantage", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.landing_advantage.tpl'));

?>