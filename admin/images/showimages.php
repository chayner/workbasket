<?
$module=15;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$all_images = sql_query("select * from images where deleted_p = 0") or die (mysql_error());

$smarty->assign("all_images", $all_images);
$smarty->display('./showimages.tpl.html');

mysql_close();
?>