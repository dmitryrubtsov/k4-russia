<?
if(!$tpl->is_cached($blockTplPath))
{
    $query = "	SELECT m.title".__FLANG." AS title, m.article_id, m.menu_id, ai.linkname
					FROM ".$_SQL_TABLE['menu']." m
					LEFT JOIN ".$_SQL_TABLE['article']." a ON a.article_id = m.article_id
					INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
	 				WHERE m.active = '1'
					ORDER BY m.position
				";
    $dbSet->open($query);
    $main_menu = $dbSet->fetchRowsAll();

    $tpl->assign('MainMenu', $main_menu);
}
?>