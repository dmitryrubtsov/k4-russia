<?php


if(isBlank($pct->getParam('task')))
{
    pageNotFound();
}
else
{
    $task = $pct->getParam('task');
    $linkID = intval(array_pop(explode($CONFIG['AdminLinkNameDelim'], $task)));
    $linkname = substr($task, 0, strpos($task, $CONFIG['AdminLinkNameDelim'].$linkID));

    if(is_int($linkID))
    {
        $where = "a.article_id = ".$linkID;
    }
    else
    {
        $where = "ai.linkname = '".$pct->getParam('task');
    }

    $Article = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->join(array('am' => $_SQL_TABLE['article_meta']), 'am.article_id = a.article_id')
        ->where('a.active = 1')
        ->where('a.article_type_id = 3')
        ->where($where)
        ->fetchRow();


    if(!$Article['article_id'])
    {
        pageNotFound();
    }
    if($Article['linkname'] !== $linkname)
    {
        go_to(get_uri(array('articles', $Article['linkname'].'-'.$Article['article_id'])));
    }

    if($Article && count($Article))
    {
        $Article['title'] = $Article['title'.__FLANG];
        $Article['text'] = $Article['text'.__FLANG];
        $tpl->assign("Article", $Article);

        $Page->Title = $Article['title'];
        $Page->MetaKeywords = $Article['meta_keywords'.__FLANG];
        $Page->MetaDescription = $Article['meta_description'.__FLANG];
        $Page->MetaTitle = $Article['meta_title'.__FLANG];

        /*
        array_push($Page->ContentPathArr, array(
            'title' => $language['front']['news'],
            'link' => $BaseURL.'news'.$CONFIG['webPageFileType'],
        ));
        */

        array_push($Page->ContentPathArr, array(
            'title' => $Article['title'],
            'link' => '',
        ));

        $Page->Title = $Article['title'];
    }
    else
    {
        pageNotFound();
    }

}

$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.article.tpl";


?>