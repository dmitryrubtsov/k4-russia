<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.banner_column_page.tpl'))
	{

        $bannerArray = DFCms_Db_Select::factory()->from(array('b' => $_SQL_TABLE['banner']))
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = b.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = b.image_id')
            ->columns(
                array(
                    'bannerTitle' => 'b.title'.__FLANG
                )
            )
            ->where('b.active = 1')
            ->order('b.position ASC')
            ->group('b.banner_id')
            ->limit(3, 0)
            ->fetchAll();

        foreach($bannerArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['orig_path']))
            {
                $bannerArray[$n]['image'] = $HOST.$value['orig_path'];
            }
        }

        $tpl->assign("bannerArray", $bannerArray);

	}

	$pct->setBlock("BannerColumnPage", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.banner_column_page.tpl'));

?>