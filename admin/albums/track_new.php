<?
$module=14;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$track_id = get_new_id();
$smarty->assign('id', $track_id);

if ($album) {
	$albuminfo = sql_query("select * from albums where id=$album");
} else {
	$albuminfo[0]['id'] = 0;
} 

$smarty->assign('album', $albuminfo);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "add");
$smarty->display('track.tpl.html');



mysql_close();
?>