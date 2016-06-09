<?
$module=52;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->display('upload.tpl.html');



mysql_close();
?>