<?

	if(!$tpl->is_cached($blockTplPath))
	{
	    $footer = DFCms_Db_Select::factory()
	        ->from(array('a' => $_SQL_TABLE['article']), array())
	        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id', array('body' => 'body'.__FLANG))
	        ->where('a.article_id = 7')
	        ->fetchRow();
	    $tpl->assign('article', $footer['body']);
	}

?>