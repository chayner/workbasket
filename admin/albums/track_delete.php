<?
$module=14;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$track = sql_query("select * from album_tracks where id=$id");
$smarty->assign('track', $track);
$smarty->assign('id', $id);

if ($album) {
	$album = $track[0][album];
	$albuminfo = sql_query("select * from albums where id=$album");
	$smarty->assign('album', $albuminfo);
}

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('action', "delete");
$smarty->display('track_delete.tpl.html');


mysql_close();
?>