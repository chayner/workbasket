<?
$module=16;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$sections_query = sql_query("select * from sections where deleted_p=0 and id=$section_s order by name"); 
$smarty->assign('sections', $sections_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>