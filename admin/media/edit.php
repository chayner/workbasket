<?
$module=5;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$media_query = sql_query("select * from media where deleted_p=0 and id=$id"); 
$smarty->assign('media', $media_query);

if ($media_query[0][category]) {
	$cur_category = $media_query[0][category];
} else {
	$cur_category = "0";
}

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('./form.tpl.html');


mysql_close();
?>