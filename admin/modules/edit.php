<?
$module=51;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$cur_module_query = sql_query("select * from modules where deleted_p=0 and id=$id"); 
$smarty->assign('cur_mod', $cur_module_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./form.tpl.html');


mysql_close();
?>