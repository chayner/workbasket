<?
$module=2;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$smarty->assign('current_month', $date_array[mon]);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);

if (!$et) {
	$smarty->assign('edit_type', "item");
	$smarty->assign('action', "add");

} else {
	$smarty->assign('edit_type', $et);
	$smarty->assign('action', "series_add");

}

$smarty->display('form.tpl.html');



mysql_close();
?>