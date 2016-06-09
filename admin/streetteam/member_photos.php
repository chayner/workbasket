<?
$module=11;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$member_photo_items = sql_query("select p.* from photos as p, categories as c where p.category = c.id and c.name = 'members' and p.deleted_p = 0") or die (mysql_error());

$smarty->assign("member_photos", $member_photo_items);
$smarty->display('./member_photos.tpl.html');

mysql_close();
?>