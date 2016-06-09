<?
$module=3;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "add");
$smarty->display('form.tpl.html');



mysql_close();
?>