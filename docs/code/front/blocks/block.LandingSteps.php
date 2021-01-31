<?
if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.home_image.tpl'))
{
    $LandingSteps = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->columns(
            array(
                'text' => 'ai.text'.__FLANG
            )
        )
        ->where('a.active = 1')
        ->where('a.article_type_id = 7')
        ->order('a.position ASC')
        ->group('a.article_id')
        ->fetchAll();

    $tpl->assign("LandingSteps", $LandingSteps);

}

$pct->setBlock("LandingSteps", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.home_image.tpl'));

?>
