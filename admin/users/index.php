<?
$module=50;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($userid_c != 1) {
	$admin_filter = "and id != 1";
}

if ($ord == "login") {
	$ord_filter = "order by last_login desc";
} elseif ($ord) {
	$ord_filter = "order by $ord";
} else {
	$ord_filter = "order by user_name";
}

$users_query = sql_query("select * from admin_users where deleted_p=0 $admin_filter ".$cur_cat['filter']." $ord_filter"); 
$smarty->assign('user_list', $users_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');

mysql_close();
?>