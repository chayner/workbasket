<?
$module=52;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$sections_query = sql_query("select * from sections where deleted_p=0 and id=$id"); 
$smarty->assign('sections', $sections_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delete");
$smarty->display('./delete.tpl.html');


mysql_close();
?>