<?

	if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.product_main_block.tpl'))
	{
        $productArray = DFCms_Db_Select::factory()->from(array('pm' => $_SQL_TABLE['product_main']), array(
                'description'.__FLANG.' AS description'
            ))
            ->join(array('p' => $_SQL_TABLE['product']), 'p.product_id = pm.product_id')
            ->join(array('pi' => $_SQL_TABLE['product_info']), 'pi.product_id = pm.product_id', array(
                'title'.__FLANG.' AS productTitle',
                'linkname'
            ))
            ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = p.image_id')
            ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = p.image_id')
            /*
            ->columns(
                array(
                    'newsTitle' => 'ai.title'.__FLANG,
                    'newsDescription' => 'ai.description'.__FLANG
                )
            )
            */
            ->where('pm.active = 1')
            ->order('pm.position ASC')
            ->group('p.product_id')
            ->limit(2, 0)
            ->fetchAll();

        foreach($productArray as $n => $value)
        {
            if(is_file(__CFG_CORE_PATH.$value['orig_path']))
            {
                $productArray[$n]['image'] = $HOST.$value['orig_path'];
            }
            else
            {
                $productArray[$n]['image'] = $HOST.'images/tpl/header_logo.png';
            }
            $productArray[$n]['link'] = $BaseURL.'product'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['product_id'].$CONFIG['webPageFileType'];
        }

        $tpl->assign("productArray", $productArray);

	}

	$pct->setBlock("ProductMainBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.product_main_block.tpl'));

?>