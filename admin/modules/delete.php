<?
$module=51;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$modules_query = sql_query("select * from modules where deleted_p=0 and id=$id"); 
$smarty->assign('modules', $modules_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./delete.tpl.html');


mysql_close();
?>