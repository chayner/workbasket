<?
$module=7;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$maillists_query = sql_query("SELECT  * FROM maillists where id = $list_id and deleted_p = 0;"); 
$smarty->assign('maillist', $maillists_query);

if (!$ord) $ord = "lname, fname, email";

$user_query = sql_query("select * from maillist_users where maillist_id = $list_id order by $ord"); 
$smarty->assign('users', $user_query);

function insert_numUsers($id) {
	$users_query = sql_query("SELECT count(id) as users FROM maillist_users where maillist_id = $id[id]");
	return $users_query[0][users];
}
 
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $list_id);
$smarty->assign('feedback', $feedback);
$smarty->display('./users.tpl.html');


mysql_close();
?>