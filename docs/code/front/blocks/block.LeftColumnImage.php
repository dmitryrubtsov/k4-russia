<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.left_column_image.tpl'))
	{

        $linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $pct->getParam('task'))));

        $imageRow = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = a.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = a.image_id')
            ->where('a.active = 1')
            ->where('a.article_id = '.$linkID)
            ->fetchRow();

        if(is_file(__CFG_CORE_PATH.$imageRow['orig_path']))
        {
            $imageLink = $HOST.$imageRow['orig_path'];
        }
        /*else
        {
            $imageLink = $HOST.'images/tpl/header_logo.png';
        }
        */

        $tpl->assign("imageLink", $imageLink);

	}

	$pct->setBlock("LeftColumnImage", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.left_column_image.tpl'));

?>