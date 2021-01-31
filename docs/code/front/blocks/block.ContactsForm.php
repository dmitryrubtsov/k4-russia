<?

	if(!$tpl->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.contacts_form.tpl'))
	{
		/*
        $articleQuery = $db->select();
	    $articleQuery->from(array('ai' => $_SQL_TABLE['article_info']),
	    	array(
	                'id' => 'article_id',
	                'body' => 'body'.__FLANG
			)
	    )
	        ->where('ai.article_id IN (72,73)');
	    $articlesArr = $db->fetchAll($articleQuery);

	    foreach($articlesArr as $k => $val)
	    {
	    	$articles[$val['id']] = $val;
	    }
		$tpl->assign('articles', $articles);
		*/
	}
	$pct->setBlock("ContactsForm", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.contacts_form.tpl'));

?>