<?
$module=15;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$images_query = sql_query("select * from images where deleted_p=0 and id=$id"); 
$smarty->assign('images', $images_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delete");
$smarty->assign('delmessage', "Delete this ".$cur_module[0][item]);
$smarty->display('./delete.tpl.html');


mysql_close();
?>