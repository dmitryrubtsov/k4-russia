<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.slider_main_page.tpl'))
	{

        $sliderArray = DFCms_Db_Select::factory()->from(array('s' => $_SQL_TABLE['slider']))
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = s.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = s.image_id')
            ->columns(
                array(
                    'slideTitle' => 's.title'.__FLANG
                )
            )
            ->where('s.slider_type_id = 1')
            ->where('s.active = 1')
            ->order('s.position ASC')
            ->group('s.slider_id')
            ->fetchAll();

        foreach($sliderArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['orig_path']))
            {
                $sliderArray[$n]['image'] = $HOST.$value['orig_path'];
            }
            else
            {
                unset($sliderArray[$n]);
            }
        }

        $tpl->assign("sliderArray", $sliderArray);

	}

	$pct->setBlock("SliderMainPage", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.slider_main_page.tpl'));

?>