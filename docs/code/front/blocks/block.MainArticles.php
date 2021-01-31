<?

if(!$tpl->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.main_articles.tpl'))
{
  $listInfo = array();
  $listInfo['page'] = 1;
  $listInfo['onpage'] = 1;
  $listInfo['order'] = 'p_date';
  $listInfo['order_type'] = 'DESC';
  $listInfo['where'][]['forSQL'] = "FIND_IN_SET('".$Block['id']."', n.important_block) > 0";
  $MainNews = getNewsPages($listInfo);

  $MNews = reset($MainNews);

  $listInfo = array();
  $listInfo['page'] = 1;
  $listInfo['onpage'] = $Block['news_count'] - sizeof($MainNews);
  $listInfo['order'] = 'p_date';
  $listInfo['order_type'] = 'DESC';
  $listInfo['where'][]['forSQL'] = "FIND_IN_SET('".$Block['id']."', n.block) > 0";
  $listInfo['where'][]['forSQL'] = "n.id != '".$MNews['id']."'";

  $News = getNewsPages($listInfo);
  $News = array_merge($MainNews, $News);

  $tpl->assign('News', $News);
  $tpl->assign('Block', $Block);
}
  $tpl->cache_lifetime = 300;
  $tpl->caching = 2;
  $Body = $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.main_articles.tpl');

?>