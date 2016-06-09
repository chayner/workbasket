<?
$module=15;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$images_query = sql_query("select * from images where deleted_p=0 and id=$id"); 
$smarty->assign('images', $images_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('./form.tpl.html');


mysql_close();
?>