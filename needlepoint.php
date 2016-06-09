<?
// pics.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$param = "#id=11";
$smarty->assign("param", $param);
$smarty->assign("page", "needlepoint");
$smarty->display('photos.tpl.html');

mysql_close();
?>