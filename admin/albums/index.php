<?
$module=14;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();

$album_query = sql_query("select a.*, m.name as merch_name from albums as a LEFT JOIN merchandise as m ON a.merch_id = m.id where a.deleted_p=0 ".$cur_cat['filter']." $section_filter order by a.category, a.release_date desc");
$smarty->assign('albums', $album_query);

function insert_getTracks($album) {
	global $smarty;
	$album_id = $album[id];
	$tracks = "";
	$tracks = sql_query("select * from album_tracks where album = $album_id order by track");
	$smarty->assign('tracks', $tracks);
}

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>