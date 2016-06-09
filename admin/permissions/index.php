<?
$module=53;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if ($userid_c != "1") {
	$admin_filter = "and u.id != 1";
}

if ($user != "") {
	$user_filter = "and p.user_id = $user";	
} else {
	$user_filter = "";
}

if ($sec != "") {
	$section_filter = "and p.section = $sec";
} else {
	$section_filter = "";
}

function insert_get_user_dropdown() {
	return get_user_dropdown();
}

function insert_get_section_dropdown() {
	return get_section_dropdown();
}

function insert_get_module_dropdown() {
	return get_module_dropdown();
}

		

$user_query = sql_query("select distinct p.user_id from permissions as p, admin_users as u where p.user_id = u.id $user_filter $section_filter order by u.real_name"); 

$permissions_query = sql_query("select p.user_id,
									 p.module as module_id,
									 p.section as section_id,
									 u.real_name as user_name,
									 s.name as section_name,
									 mo.name as module_name
								from admin_users as u,
									 permissions as p,
									 sections as s,
									 modules as mo
							   where p.user_id = u.id
								 and p.section = s.id
								 and p.module = mo.id
								 $admin_filter
								 $user_filter
								 $section_filter
							order by u.real_name,s.name,mo.id");

//$permissions_query = sql_query("select * from permissions ".$cur_cat['filter']."order by user_id"); 
$smarty->assign('permissions', $permissions_query);
$smarty->assign('section_perm', $section_perm_query);

$smarty->assign('user', $user);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');

mysql_close();
?>