<?php

if(!isBlank($pct->getParam('task')))
{	pageNotFound();}


$query = "	SELECT p.*, pi.*, pi.title".__FLANG." AS title
			FROM ".$_SQL_TABLE['partner']." p
			INNER JOIN ".$_SQL_TABLE['partner_info']." pi ON pi.partner_id = p.partner_id
			WHERE p.active = 1
			ORDER BY p.position
		";
$dbSet->open($query);
$PartnersArray = $dbSet->fetchRowsAll();

foreach($PartnersArray as $n => $image)
{
	if(is_file(__CFG_CORE_PATH.$image['partner_image']))
	{
		$PartnersArray[$n]['logo'] = $image['partner_image'];
	}
	else
	{
		unset($PartnersArray[$n]);
	}
}

$tpl->assign("PartnersArray", $PartnersArray);

$Page->Title = $language['front']['ourFriendsAndPartners'];

$_BODY_SMARTY_TEMPLATE = $CONFIG['ModulesFolder']."module.partner.tpl";


?>