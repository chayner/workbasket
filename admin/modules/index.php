<?
$module=51;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");

if ($action == "show") {
		$sql = "update modules set public='1' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module now shown";
		}
} elseif ($action == "hide") {
		$sql = "update modules set public='0' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module now hidden";
		}
} elseif ($action == "adyes") {
		$sql = "update modules set add_del='1' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module add/delete permitted";
		}
} elseif ($action == "adno") {
		$sql = "update modules set add_del='0' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module add/delete disabled";
		}
} elseif ($action == "imgsyes") {
		$sql = "update modules set imgs_p='1' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module images available";
		}
} elseif ($action == "imgsno") {
		$sql = "update modules set imgs_p='0' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "module images not available";
		}
} elseif ($action == "catno") {
		$sql = "update modules set cat_p='0' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "categories not active for module";
		}
} elseif ($action == "catyes") {
		$sql = "update modules set cat_p='1' where id=$id";
       	$result = db_query($sql) or die ("Module modify error: ". mysql_error());
	   	if ($result) {
			$feedback = "categories active for module";
		}
}

include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($ord) {
	$ord_filter = "order by $ord";
} else {
	$ord_filter = "order by public desc, name";
}


$modules_query = sql_query("select * from modules where deleted_p=0 ".$cur_cat['filter']." $ord_filter"); 
$smarty->assign('module_list', $modules_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>