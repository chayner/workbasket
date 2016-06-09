<?
$module=15;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$images_query = sql_query("select * from images where deleted_p=0 and category=$cat"); 
$smarty->assign('images', $images_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delcat");
$smarty->assign('cat', $cat);
$smarty->assign('delmessage', "Delete this Category");
$smarty->display('./delete.tpl.html');


mysql_close();
?>