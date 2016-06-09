<?
$module=1;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$news_query = sql_query("select * from news where deleted_p=0 and id=$id"); 
$smarty->assign('news', $news_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./delete.tpl.html');


mysql_close();
?>