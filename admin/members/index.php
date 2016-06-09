<?
$module=11;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$members_query = sql_query("select * from members where deleted_p=0 $section_filter order by category desc, fname"); 
$smarty->assign('members', $members_query);

function insert_location_list($var) {
	$location_query = db_query("select l.title from locations as l, member_location_map as mlmap where mlmap.member_id = $var[member_id] and mlmap.location_id = l.id");
	while(list($title) = db_fetch_array($location_query)) {
		echo "<br>$title";
	}
}

function insert_section_list($var) {
	$section_query = db_query("select msmap.position, s.name from sections as s, member_section_map as msmap where msmap.member_id = $var[member_id] and msmap.section_id = s.id");
	while(list($position, $name) = db_fetch_array($section_query)) {
		echo "<br><strong>$position</strong> - $name";
	}
}

$spanfill[0] = 1;
if ($configs[0]['memberloc']) {
	$spanfill[0]++;
}
$spanfill[1] = $spanfill[0] + 1;

$smarty->assign('spanfill', $spanfill);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>