<?
$module=4;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$photos_query = sql_query("select * from photos where deleted_p=0 and id=$id"); 
$smarty->assign('photos', $photos_query);

$smarty->assign('cat', $cat);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('./form.tpl.html');


mysql_close();
?>