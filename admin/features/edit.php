<?
$module=10;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$feature_query = sql_query("select * from features where deleted_p=0 and id=$id"); 
$smarty->assign('features', $feature_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./form.tpl.html');


mysql_close();
?>