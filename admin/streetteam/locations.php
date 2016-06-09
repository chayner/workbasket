<?
$module=11;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if ($sec) {
	$section_filter = "and p.section = $sec";
} else {
	$section_filter = "";
}

function insert_get_locations_dropdown() {
	return get_locations_dropdown();
}

$member = sql_query("select * from members where id=$member_id");
$smarty->assign('member', $member);

$locations_query = sql_query("select l.title, l.id as location_id
								from locations as l,
									 member_location_map as mlmap,
									 members as m
							   where m.id = $member_id
								 and mlmap.member_id = m.id
								 and mlmap.location_id = l.id
								 $section_filter
							order by l.title");
							
$smarty->assign('locations', $locations_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('member_id', $member_id);
$smarty->assign('feedback', $feedback);
$smarty->display('locations.tpl.html');

mysql_close();
?>