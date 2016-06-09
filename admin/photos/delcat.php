<?
$module=4;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$photos_query = sql_query("select * from photos where deleted_p=0 and category=$cat"); 
$smarty->assign('photos', $photos_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delcat");
$smarty->assign('cat', $cat);
$smarty->assign('delmessage', "Delete this Category");
$smarty->display('./delete.tpl.html');


mysql_close();
?>