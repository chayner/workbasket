<?
// pics.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$param = "#id=4";
$smarty->assign("param", $param);

$smarty->assign("page", "ours");
$smarty->display('photos.tpl.html');

mysql_close();
?>
