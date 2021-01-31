<?
$query = "
SELECT ct.title".__FLANG." AS title, ii.orig_path, ct.template, ct.description".__FLANG." AS description
FROM ".$_SQL_TABLE['ckeditor_templates']." ct
INNER JOIN ".$_SQL_TABLE['ckeditor_template_image']." cti ON cti.template_id = ct.template_id
LEFT JOIN ".$_SQL_TABLE['image_info']." ii ON ii.image_id = cti.image_id
WHERE 1";
$dbSet->open($query);
$templates = $dbSet->fetchRowsAll();
?>
CKEDITOR.addTemplates("default",{imagesPath:"<?echo $HOST;?>",
templates:[
<?foreach($templates as $val):?>
    <?$val['template'] = preg_replace('/(\\n|\s{2,}|\\r\\r)/s', '', $val['template'] );?>
    {title:"<?echo trim($val['title']);?>",image:"<?echo '/'.trim($val['orig_path']);?>",description:"<?echo trim($val['description']);?>",html:'<?echo trim($val['template']);?>'},
<?endforeach;?>
]});
<?
exit;
?>
