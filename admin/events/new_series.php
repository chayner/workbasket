<?
$module=2;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($id) {
$event_info = sql_query("select * from events where id = $id");

$series_info[0][fmonth] = date("n",strtotime($event_info[0][bdate]));
$series_info[0][fday] = date("j",strtotime($event_info[0][bdate]));
$series_info[0][fyear] = date("Y",strtotime($event_info[0][bdate]));

$smarty->assign('events', $event_info);
$smarty->assign('series',$series_info);
}

global $event_info, $sid_filter;



$smarty->assign('event_id', $id);
$smarty->assign('edit_type', "series");
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "series_add");
$smarty->display('series_form.tpl.html');



mysql_close();
?>