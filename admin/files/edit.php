<?
$module=12;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$files_query = sql_query("select * from files where deleted_p=0 and id=$id"); 
$smarty->assign('files', $files_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('./form.tpl.html');

mysql_close();
?>