<?
	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.home_image.tpl'))
	{
        $query = "	SELECT a.*, ai.*, am.*
			FROM ".$_SQL_TABLE['article']." a
			INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
			INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.article_id = a.article_id
			WHERE a.active = 1
			AND a.article_id = 8
		";
        $dbSet->open($query);
        $ContactArticle = $dbSet->fetchArray();

        if($ContactArticle && count($ContactArticle))
        {
            $ContactArticle['title'] = $ContactArticle['title'.__FLANG];
            $ContactArticle['text'] = $ContactArticle['text'.__FLANG];

            $tpl->assign("ContactArticle", $ContactArticle);

            $Page->Title = $ContactArticle['title'];
            $Page->MetaKeywords = $ContactArticle['meta_keywords'.__FLANG];
            $Page->MetaDescription = $ContactArticle['meta_description'.__FLANG];
            $Page->MetaTitle = $ContactArticle['meta_title'.__FLANG];

            array_push($Page->ContentPathArr, array(
                'title' => $ContactArticle['title'],
                'link' => '',
            ));
        }


        $LandingSteps = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
            ->columns(
                array(
                    'text' => 'ai.text'.__FLANG
                )
            )
            ->where('a.active = 1')
            ->where('a.article_type_id = 7')
            ->order('a.position ASC')
            ->group('a.article_id')
            ->fetchAll();

        $tpl->assign("LandingSteps", $LandingSteps);

	}

	$pct->setBlock("LandingSteps", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.home_image.tpl'));

?>
