<?

if(!$pct->is_cached($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.landing_steps.tpl'))
{
    /*$LandingSteps = DFCms_Db_Select::factory()->from(array('a' => $_SQL_TABLE['article']))
        ->join(array('ai' => $_SQL_TABLE['article_info']), 'ai.article_id = a.article_id')
        ->join(array('ii' => $_SQL_TABLE['image_info']), 'ii.image_id = a.image_id')
        ->columns(
            array(
                'text' => 'ai.description'.__FLANG
            )
        )
        ->where('a.active = 1')
        ->where('a.article_type_id = 6')
        ->order('a.position ASC')
        ->group('a.article_id')
        ->fetchAll();

    foreach($LandingSteps as $n => $value)
    {
        if(is_file(__CFG_CORE_PATH.$value['orig_path']))
        {
            $LandingSteps[$n]['image_path'] = $HOST.$value['orig_path'];
        }
        else
        {
            $LandingSteps[$n]['image_path'] = $HOST.$Config['MainImageFolder'].'tpl/step.png';
        }
    }

    $tpl->assign("LandingSteps", $LandingSteps);*/

}

$pct->setBlock("LandingSteps", $tpl->fetch($CONFIG['ModulesFolder'].$CONFIG['BlocksFolder'].'block.landing_steps.tpl'));

?>