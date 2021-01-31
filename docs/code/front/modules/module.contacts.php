<?php


$query = "	SELECT a.*, ai.*, am.*
			FROM ".$_SQL_TABLE['article']." a
			INNER JOIN ".$_SQL_TABLE['article_info']." ai ON ai.article_id = a.article_id
			INNER JOIN ".$_SQL_TABLE['article_meta']." am ON am.article_id = a.article_id
			WHERE a.active = 1
			AND a.article_id = 19
		";
$dbSet->open($query);
$ContactArticle = $dbSet->fetchArray();

if($ContactArticle && count($ContactArticle))
{
	$ContactArticle['title'] = $ContactArticle['title'.__FLANG];
	$ContactArticle['text'] = $ContactArticle['text'.__FLANG];

	$tpl->assign("ContactArticle", $ContactArticle);

	$Page->Title = $ContactArticle['title'];
	$Page->MetaKeywords = $ContactArticle['meta_keywords'.__FLANG];
	$Page->MetaDescription = $ContactArticle['meta_description'.__FLANG];
	$Page->MetaTitle = $ContactArticle['meta_title'.__FLANG];

    array_push($Page->ContentPathArr, array(
        'title' => $ContactArticle['title'],
        'link' => '',
    ));
}


$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.contacts.tpl";

?>