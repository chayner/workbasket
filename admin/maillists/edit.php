<?
$module=7;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$maillists_query = sql_query("select * from maillists where deleted_p=0 and id=$id"); 
$smarty->assign('maillists', $maillists_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./form.tpl.html');


mysql_close();
?>