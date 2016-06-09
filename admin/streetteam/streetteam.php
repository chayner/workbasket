<?
$module=11;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

function insert_get_events_dropdown() {
	return get_events_dropdown();
}

$member = sql_query("select * from members where id=$member_id");
$smarty->assign('member', $member);

$event_query = sql_query("select e.title, e.id as event_id, e.bdate, memap.position
								from events as e,
									 member_event_map as memap,
									 members as m
							   where m.id = $member_id
								 and memap.member_id = m.id
								 and memap.event_id = e.id
								 and e.bdate > now()
							order by e.bdate");
							
$smarty->assign('events', $event_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('member_id', $member_id);
$smarty->assign('feedback', $feedback);
$smarty->display('streetteams.tpl.html');

mysql_close();
?>