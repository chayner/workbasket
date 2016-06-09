<?
$module=14;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$merch_query = sql_query("select * from merchandise order by name");
$smarty->assign('merch', $merch_query);

$album_query = sql_query("select a.*, m.name as merch_name from albums as a LEFT JOIN merchandise as m ON a.merch_id = m.id where a.deleted_p=0 and a.id=$id"); 
$smarty->assign('album', $album_query);

$smarty->assign('action', "edit");
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->display('./form.tpl.html');


mysql_close();
?>