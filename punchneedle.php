<?
// pics.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$param = "#id=10";
$smarty->assign("param", $param);
$smarty->assign("page", "punchneedle");
$smarty->display('photos.tpl.html');

mysql_close();
?>