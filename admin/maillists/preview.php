<?
$module=7;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");


$preview = maillist_preview($list_id, $subject, $message, $from);

if (!session_is_registered("cur_email") || !$cur_email) {

	session_register("cur_email");
	$cur_email[$list_id] = $preview;
} 
	$cur_email[$list_id] = $preview;

$smarty->assign('preview', $preview);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "edit");
$smarty->display('./preview.tpl.html');


mysql_close();
?>