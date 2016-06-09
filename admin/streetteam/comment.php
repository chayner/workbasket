<?
$module=20;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if (!$mod) {

	$mod = "event";
} 

if ($mod == "album") {

	$date_type = "release_date";
	$order_fill = "release_date desc";
	
} elseif ($mod == "event") {

	$date_type = "bdate";
	$current_fill = "and e.bdate >= now()";
	$order_fill = "bdate";
	
}
$events = sql_query("select  smap.id, 
									 e.".$date_type." as date,
									 e.title,
									 s.*,
									 smap.ideas,
									 smap.comments						 
								from streetteam_".$mod."_map as smap,
									 ".$mod."s as e,
									 streetteam as s
							   where smap.".$mod."_id = e.id
							     and smap.member_id = s.id
								 and smap.id = $id");

$smarty->assign("events",$events);
$smarty->assign('mod', $mod);	
$smarty->assign('id', $id);
$smarty->display('./comment.tpl.html');


mysql_close();
?>