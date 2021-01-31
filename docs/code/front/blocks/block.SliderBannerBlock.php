<?

	if(!$tpl->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.slider_banner_block.tpl'))
	{
		$query = "	SELECT sb.link, sb.target, sb.slider_banner_id, sb.title".__FLANG." AS title, i.image_id, ii.orig_path
					FROM ".$_SQL_TABLE['slider_banner']." sb
					LEFT JOIN ".$_SQL_TABLE['image']." i ON i.image_id = sb.image".__FLANG."
					LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = i.image_id
			 		WHERE sb.active = 1
			 		GROUP BY sb.slider_banner_id
					ORDER BY sb.position";

		$dbSet->open($query);
		$SliderArray = $dbSet->fetchRowsAll();
       /*
		$SliderArray = array(
		    '0' => array(
		            'link' => 'news.html',
		            'target' => 0,
		            'slider_banner_id' => 1,
		            'title' => 'Banner one',
		            'image_id' => 1,
		            'path_orig' => 'slider/1.jpg',
		    ),

		    '1' => array(
		            'link' => 'news.html',
		            'target' => 0,
		            'slider_banner_id' => 2,
		            'title' => 'Second banner',
		            'image_id' => 2,
		            'path_orig' => 'slider/2.jpg',
		    ),

		    '2' => array(
		            'link' => 'news.html',
		            'target' => 0,
		            'slider_banner_id' => 3,
		            'title' => 'Banner number 3',
		            'image_id' => 3,
		            'path_orig' => 'slider/3.jpg',
		    ),
		);  */

		if(!isEmptyArr($SliderArray))
		{
			foreach($SliderArray as $n => $slider)
			{
				if(is_file(__CFG_CORE_PATH.$slider['orig_path']))
				{
					$SliderArray[$n]['image'] = $HOST.$slider['orig_path'];
				}
				else
				{
					unset($SliderArray[$n]);
				}
				if($slider['link'])
				{					if(!preg_match('/^http:\/\/+/', $slider['link']))
					{
						$SliderArray[$n]['link'] = getPath().$slider['link'];
					}
					else
					{
						$SliderArray[$n]['link'] = $slider['link'];
					}				}
			}
			$tpl->assign('SliderArray', $SliderArray);
		}
	}
	$pct->setBlock("SliderBannerBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.slider_banner_block.tpl'));

?>