<?
$module=19;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");


$page[0]['parent'] = 0;
$page[0]['id'] = 10000;

$smarty->assign('page', $page);
$smarty->assign('action', "add");
$smarty->assign('module', $module);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./form.tpl.html');


mysql_close();
?>