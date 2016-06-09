<?
// pics.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$news = sql_query("select * from features where id=6 limit 1");
$smarty->assign("news", $news);

$param = "#id=7";
$smarty->assign("param", $param);

$smarty->assign("page", "new");
$smarty->display('photos_new.tpl.html');

mysql_close();
?>