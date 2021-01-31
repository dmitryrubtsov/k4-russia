<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.site_news_block.tpl'))
	{

        $newsArray = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = a.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = a.image_id')
            ->columns(
                array(
                    'newsTitle' => 'ai.title'.__FLANG,
                    'newsDescription' => 'ai.description'.__FLANG
                )
            )
            ->where('a.article_type_id = 2')
            ->where('a.active = 1')
            ->order('a.publication_date DESC')
            ->group('a.article_id')
            ->limit($CONFIG['countNewsOnHomePage'], 0)
            ->fetchAll();

        foreach($newsArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['orig_path']))
            {
                $newsArray[$n]['image'] = $HOST.$value['orig_path'];
            }
            else
            {
                $newsArray[$n]['image'] = $HOST.'images/tpl/header_logo.png';
            }
            $newsArray[$n]['link'] = $BaseURL.'news'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
        }

        $tpl->assign("newsArray", $newsArray);

	}

	$pct->setBlock("SiteNewsBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.site_news_block.tpl'));

?>