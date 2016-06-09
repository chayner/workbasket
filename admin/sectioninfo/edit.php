<?
$module=16;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$sections_query = sql_query("select * from sections where deleted_p=0 and id=$id"); 

$dir_id = $sections_query[0][director_id];

if ($dir_id > 0) {
	$director_query = sql_query("select * from members where id=$dir_id");
	$smarty->assign('director', $director_query);

	$sections_query[0][director] = $director_query[0][fname]." ".$director_query[0][lname];
	$sections_query[0][director_email] = $director_query[0][email];
	$sections_query[0][director_phone] = $director_query[0][phone];
}

$smarty->assign('sections', $sections_query);

$member_name = sql_query("select item from modules where dbtable = 'members' limit 1");

$smarty->assign('member_name', $member_name[0][item]);

$members_query = sql_query("select * from members where deleted_p=0");
$smarty->assign('members', $members_query);



$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./form.tpl.html');


mysql_close();
?>