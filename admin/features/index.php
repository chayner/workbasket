<?
$module=10;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$feature_query = sql_query("select distinct f.* from features as f left join categories as c on f.category=c.id or f.category = 0 where f.deleted_p=0 ".$cur_cat['filter']."and f.owner=$section_s order by c.lineage, f.priority"); 

$smarty->assign('features', $feature_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>