<?
$module=52;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

if (!session_is_registered("expand") || !$expand) {
	session_register("expand");
}

// If p exists, change priority

if ($id && $p) {
	
	$sect_info = sql_query("select * from sections where id=$id");
	$parent = $sect_info[0]['parent'];
	$old_order = $sect_info[0]['ordervar'];

	if ($p == "up") {
		$new_order = $old_order - 1;
	} elseif ($p == "down") {
		$new_order = $old_order + 1;
	}

	$sect_swap = sql_query("select id from sections where ordervar = $new_order and parent = $parent");
	$swap_id = $sect_swap[0]['id'];
	$change_order = db_query("update sections set ordervar = $new_order where id=$id");
	$change_order = db_query("update sections set ordervar = $old_order where id=$swap_id"); 
	
} elseif ($id && $e != "") {
	$expand[$id] = $e;
}

$expand[0] = 1;


$sections_query = sql_query("select * from sections where deleted_p=0 order by name"); 
$smarty->assign('sections', $sections_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>