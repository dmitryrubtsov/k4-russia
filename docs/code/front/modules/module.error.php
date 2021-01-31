<?php

    //pageNotFound();

    header('Content-type: text/html; charset='.$language['charset']);
    header(__HEADER_PAGE_NOT_FOUND);

    $Article = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'a.article_id = ai.article_id',
            array(
                'title' => 'title'.__FLANG,
                'text' => 'text'.__FLANG
            )
        )
        ->where('a.article_id = 66')
        ->where('a.active = 1')
        ->fetchRow();

    $tpl->assign('page404Title', $Article['title']);
    $tpl->assign('page404', $Article['text']);

    $Page->Title = $language['front']['error404'];

    array_push($Page->ContentPathArr, array(
        'title' => $language['front']['error404'],
        'link' => '',
    ));

    $_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.error.tpl";

?>