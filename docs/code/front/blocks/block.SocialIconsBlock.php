<?

	if(!$tpl->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.social_icons_block.tpl'))
	{
		$query = "	SELECT si.image_id, si.title".__FLANG." AS title, si.link, ii.orig_path, ii.orig_width, ii.orig_height
					FROM ".$_SQL_TABLE['social_icon']." si
					INNER JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = si.image_id
	 				WHERE si.active = 1
					ORDER BY si.position
				";
		$dbSet->open($query);
		$SocialIcons = $dbSet->fetchRowsAll();

		foreach($SocialIcons as $n => $value)
		{
			if(is_file(__CFG_CORE_PATH.$value['orig_path']))
			{
				$SocialIcons[$n]['image_path'] = $HOST.$value['orig_path'];
			}
			else
			{
				unset($SocialIcons[$n]);
			}
		}

		$pct->assign('SocialIcons', $SocialIcons);
	}
	$pct->setBlock("SocialIconsBlock", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.social_icons_block.tpl'));

?>