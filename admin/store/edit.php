<?
$module=13;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$merchandise_query = sql_query("select * from merchandise where deleted_p=0 and id=$id"); 
$smarty->assign('merchandise', $merchandise_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('form.tpl.html');


mysql_close();
?>