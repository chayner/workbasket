<?
$module=20;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if ($action == "remove") {
	$feedback = map_delete($mid, $mod, $id);
}

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

$smarty->assign('mod', $mod);


function insert_get_team($var) {
	global $smarty;
	
	$mod = $var['mod'];
	$id = $var['id'];
	
	$team_query = sql_query("select distinct s.*,
										 smap.comments,
										 smap.position, 
										 smap.ideas, 
										 smap.approved_p
									from events as e,
										 streetteam_".$mod."_map as smap,
										 streetteam as s
								   where smap.member_id = s.id
									 and smap.".$mod."_id = $id
								order by s.lname");
	return $team_query;
}


// Get event street teams
	$events = sql_query("select distinct count(smap.member_id) as count, 
										 smap.id, e.id as event_id, e.title, e.".$date_type." as date
									from streetteam_".$mod."_map as smap,
										 ".$mod."s as e
								   where smap.".$mod."_id = e.id
								     $current_fill
						        group by smap.".$mod."_id
								order by $order_fill");

	$smarty->assign('events', $events);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>