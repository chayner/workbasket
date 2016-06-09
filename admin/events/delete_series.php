<?
$module=2;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$events_query = sql_query("select * from events where deleted_p=0 and series_id=$id order by bdate"); 
$smarty->assign('events', $events_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('sid', $sid);
$smarty->assign('action', "delete");
$smarty->display('./delete_series.tpl.html');


mysql_close();
?>