<?
$module=14;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$track = sql_query("select * from album_tracks where id=$id");
$smarty->assign('track', $track);
$smarty->assign('id', $id);

$album = $track[0][album];

if ($album) {
	$albuminfo = sql_query("select * from albums where id=$album");
} else {
	$albuminfo[0]['id'] = 0;
} 
$smarty->assign('album', $albuminfo);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "edit");
$smarty->display('track.tpl.html');



mysql_close();
?>