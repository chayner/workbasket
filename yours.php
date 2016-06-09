<?
// pics.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$param = "#id=6";
$smarty->assign("param", $param);
$smarty->assign("page", "yours");
$smarty->display('photos.tpl.html');

mysql_close();
?>