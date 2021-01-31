<?php

	if(!isBlank($pct->getParam('subtask')))
	{
		pageNotFound();
	}

	if(isBlank($pct->getParam('task')))
	{		$galleryQuery = $db->select();
	    $galleryQuery->from(array('g' => $_SQL_TABLE['gallery']))
	        ->join(array('gi' => $_SQL_TABLE['gallery_info']), 'g.gallery_id = gi.gallery_id',
	            array(
	                'galleryTitle' => 'title'.__FLANG,
	                'linkname'
	            )
	        )
	        ->join(array('gp' => $_SQL_TABLE['gallery_preview']), 'g.gallery_id = gp.gallery_id',
	            array(
	                'image_id'
	            )
	        )
	        ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = gp.image_id',
	            array(
	                'title' => 'title'.__FLANG,
	                'alt' => 'alt'.__FLANG,
	                'orig_path'
	            )
	        )
	        ->join(array('gim' => $_SQL_TABLE['gallery_image']), 'g.gallery_id = gim.gallery_id',
	            array(
	                'altImageId' => 'image_id'
	            )
	        )
	        ->join(array('iialt' => $_SQL_TABLE['image_info']), 'iialt.image_id = gim.image_id',
	            array(
	                'AltTitle' => 'title'.__FLANG,
	                'AltAlt' => 'alt'.__FLANG,
	                'AltOrigPath' => 'orig_path'
	            )
	        )
	        ->where('g.active = 1')
	        ->order('g.position')
	        ->group('g.gallery_id');
	    $galleryList = $db->fetchAll($galleryQuery);


		foreach($galleryList as $n => $value)
		{
			if(is_file(__CFG_CORE_PATH.$value['orig_path']))
			{
				$galleryList[$n]['logo'] = $HOST.$value['orig_path'];
			}
			elseif(is_file(__CFG_CORE_PATH.$value['AltOrigPath']))
			{
				$galleryList[$n]['logo'] = $HOST.$value['AltOrigPath'];
			}
			else
			{				unset($galleryList[$n]);			}
			$galleryList[$n]['link'] = $BaseURL.'gallery'.$CONFIG['linkPartSeparator'].$value['linkname'].$CONFIG['AdminLinkNameDelim'].$value['gallery_id'].$CONFIG['webPageFileType'];
		}
		$tpl->assign("galleryList", $galleryList);

	    // Find need article and meta data
	    $articleQuery = $db->select();
	    $articleQuery->from(array('a' => $_SQL_TABLE['article']))
	        ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
	            array(
	                'title' => 'title'.__FLANG,
	                'body' => 'body'.__FLANG,
	                'linkname'
	            )
	        )
	        ->join(array('am' => $_SQL_TABLE['article_meta']), 'a.article_id = am.article_id',
	            array(
	                'meta_title' => 'meta_title'.__FLANG,
	                'meta_keywords' => 'meta_keywords'.__FLANG,
	                'meta_description' => 'meta_description'.__FLANG
	            )
	        )
	        ->where('a.article_id = 76');
	    $article = $db->fetchRow($articleQuery);

	    $tpl->assign("articleText", $article['body']);

		$Page->Title = $article['title'];
		$Page->MetaTitle = trim($article['meta_title']);
    	$Page->MetaKeywords = trim($article['meta_keywords']);
    	$Page->MetaDescription = trim($article['meta_description']);

		$blocktype = 'list';
	}
	else
	{		preg_match('/^(.*)\-(\d+)$/s', $pct->Params['task'], $matches);

		$galleryQuery = $db->select();
	    $galleryQuery->from(array('gi' => $_SQL_TABLE['gallery_image']))
	        ->join(array('i' => $_SQL_TABLE['image']), 'i.image_id = gi.image_id')
	        ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = gi.image_id',
	            array(
	                'title' => 'title'.__FLANG,
	                'alt' => 'alt'.__FLANG,
	                'orig_path'
	            )
	        )
	        ->where('gi.gallery_id = '.$matches[2])
	        ->where('i.active = 1')
	        ->order('i.position')
	        ->group('i.image_id');
	    $galleryList = $db->fetchAll($galleryQuery);

		foreach($galleryList as $n => $value)
		{
			if(is_file(__CFG_CORE_PATH.$value['orig_path']))
			{
				$galleryList[$n]['logo'] = $HOST.$value['orig_path'];
			}
			else
			{
				unset($galleryList[$n]);
			}
			$galleryList[$n]['link'] = $HOST.$value['orig_path'];
		}
		$tpl->assign("galleryList", $galleryList);

		// Find need article and meta data
	    $articleQuery = $db->select();
	    $articleQuery->from(array('g' => $_SQL_TABLE['gallery']))
	        ->join(array('gi' => $_SQL_TABLE['gallery_info']), 'gi.gallery_id = g.gallery_id',
	            array(
	                'title' => 'title'.__FLANG,
	                'body' => 'text'.__FLANG,
	                'meta_keywords' => 'meta_keywords'.__FLANG,
	                'meta_description' => 'meta_description'.__FLANG,
	                'meta_title' => 'meta_title'.__FLANG
	            )
	        )
	        ->where('g.active = 1')
	        ->where('g.gallery_id = '.$matches[2]);
	    $article = $db->fetchRow($articleQuery);

	    $tpl->assign("articleText", $article['body']);

		$Page->Title = $article['title'];
		$Page->MetaTitle = trim($article['meta_title']);
    	$Page->MetaKeywords = trim($article['meta_keywords']);
    	$Page->MetaDescription = trim($article['meta_description']);

		$blocktype = 'curr';
	/*
	$linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $pct->getParam('task'))));
	if(is_int($linkID))
	{
		$where = "g.gallery_id = ".$linkID;	}
	else
	{
		$where = "gi.linkname = '".$pct->getParam('task');	}

	$query = "	SELECT g.*, gi.*, gi.title".__FLANG." AS title
				FROM ".$_SQL_TABLE['gallery']." g
				INNER JOIN ".$_SQL_TABLE['gallery_info']." gi ON gi.gallery_id = g.gallery_id
				WHERE g.active = 1
				AND ".$where."
			";
	$dbSet->open($query);
	$GalleryArray = $dbSet->fetchArray();

	$GalleryArray['link'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

	if($GalleryArray && count($GalleryArray))
	{		$query = "	SELECT i.*, ii.*, ii.title".__FLANG." AS title
					FROM ".$_SQL_TABLE['gallery_image']." img
					INNER JOIN ".$_SQL_TABLE['image']." i ON i.image_id = img.image_id
					INNER JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = i.image_id
					WHERE i.active = 1
					AND img.gallery_id = '".$GalleryArray['gallery_id']."'
				";
		$dbSet->open($query);
		$GalleryArray['images'] = $dbSet->fetchRowsAll();

		foreach($GalleryArray['images'] as $n => $image)
		{			if(is_file(__CFG_CORE_PATH.$image['path_orig']) && is_file(__CFG_CORE_PATH.$image['path_small']))
			{
				$GalleryArray['images'][$n]['logo'] = $HOST.$image['path_small'];
				$GalleryArray['images'][$n]['image'] = $HOST.$image['path_orig'];
			}
			else
			{
				unset($GalleryArray['images'][$n]);
			}		}

		$tpl->assign("GalleryArray", $GalleryArray);

		$Page->Title = $GalleryArray['title'];
		$Page->MetaKeywords = $GalleryArray['meta_keywords'.__FLANG];
		$Page->MetaDescription = $GalleryArray['meta_description'.__FLANG];
		$Page->MetaTitle = $GalleryArray['meta_title'.__FLANG];	}
	else
	{		pageNotFound();	}


	*/
	}


	$tpl->assign("blocktype", $blocktype);

	$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.gallery.tpl";

?>