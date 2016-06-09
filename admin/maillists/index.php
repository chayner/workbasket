<?
$module=7;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($cur_email) {
	$smarty->assign('cur_email',$cur_email);
}

$maillists_query = sql_query("SELECT  * FROM maillists where deleted_p = 0 $section_filter;"); 
$smarty->assign('maillists', $maillists_query);

function insert_numUsers($id) {
	$users_query = sql_query("SELECT count(id) as users FROM maillist_users where maillist_id = $id[id]");
	return $users_query[0][users];
}

function insert_cur_email_p($id) {
	global $smarty, $cur_email;
	$list_id = $id['id'];
	$smarty->assign('current_email',$cur_email[$list_id]);
}

 
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>