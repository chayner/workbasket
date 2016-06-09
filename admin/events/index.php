<?
$module=2;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($expired == "1") {
	$expire_filter = "";
} else {
	$expire_filter = "AND bdate >= date_sub( now( ) , INTERVAL 14 HOUR)";
	$expired_html = "";
	$cell_format = "";
}

$smarty->assign('expired', $expired);
		
$expired_query = sql_query("select id from events where bdate < CURDATE() $section_filter");
$smarty->assign('numexpired', $expired_query);
		
$events_query = sql_query("select * from events where deleted_p=0 $expire_filter $section_filter order by bdate"); 
$smarty->assign('events', $events_query);

$smarty->display('./index.tpl.html');

mysql_close();
?>