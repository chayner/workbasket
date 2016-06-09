<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$page_query = sql_query("select * from pages where deleted_p=0 and id=$id"); 
$smarty->assign('page', $page_query);

$page_file = $page_query[0]['filename'];

$file_p = file_exists($_SERVER['DOCUMENT_ROOT'].'/pages/'.$page_file);
$smarty->assign('file_p', $file_p);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delete");
$smarty->display('./delete.tpl.html');


mysql_close();
?>