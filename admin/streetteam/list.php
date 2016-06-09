<?
$module=20;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if (!$ord) {
	$ord = "fname";
} elseif ($ord == "teams") {
	$ord = "count desc";
}

$members_query = sql_query("select s.*, count(smap.id) as count from streetteam as s left join streetteam_event_map as smap on s.id = smap.member_id where deleted_p=0 group by s.id order by $ord"); 
$num_members = count($members_query);
for ($i=0; $i<$num_members; $i++) {
	$cur_member = $members_query[$i]['id'];
	$album_query = sql_query("select count(id) as count from streetteam_album_map where member_id = $cur_member group by member_id");
	if ($album_query) {
		$members_query[$i]['count'] += $album_query[0]['count'];
	}
}
$smarty->assign('members', $members_query);

$smarty->assign('spanfill', $spanfill);
$smarty->assign('ord', $ord);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./list.tpl.html');


mysql_close();
?>