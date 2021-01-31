<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.services_block.tpl'))
	{
        $servicesBlockArray = DFCms_Db_Select::factory()->from(array('s' => $_SQL_TABLE['service']))
            ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = s.article_id')
            ->joinleft(array('i' => $_SQL_TABLE['image']), 'i.image_id = s.image_id')
            ->joinleft(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = s.image_id')
            ->columns(
                array(
                    'servicesTitle' => 's.title'.__FLANG
                )
            )
            ->where('s.active = 1')
            ->order('s.position ASC')
            ->group('s.service_id')
            ->limit(3, 0)
            ->fetchAll();

        foreach($servicesBlockArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['orig_path']))
            {
                $servicesBlockArray[$n]['image'] = $HOST.$value['orig_path'];
            }
            else
            {
                $servicesBlockArray[$n]['image'] = $HOST.'images/tpl/service_logo.jpg';
            }
            $servicesBlockArray[$n]['link'] = $BaseURL.'service'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['article_id'].$CONFIG['webPageFileType'];
        }

        $tpl->assign("servicesBlockArray", $servicesBlockArray);

	}

	$pct->setBlock("ServicesBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.services_block.tpl'));

?>