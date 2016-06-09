<?
$module=11;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if ($sec) {
	$section_filter = "and m.section = $sec";
} else {
	$section_filter = "";
}

function insert_get_sections_dropdown() {
	return get_sections_dropdown();
}

$member = sql_query("select * from members where id=$member_id");
$smarty->assign('member', $member);

$sections_query = sql_query("select s.name, s.id as section_id, msmap.position
								from sections as s,
									 member_section_map as msmap,
									 members as m
							   where m.id = $member_id
								 and msmap.member_id = m.id
								 and msmap.section_id = s.id
								 $section_filter
							order by s.name");
							
$smarty->assign('sections', $sections_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('member_id', $member_id);
$smarty->assign('feedback', $feedback);
$smarty->display('sections.tpl.html');

mysql_close();
?>