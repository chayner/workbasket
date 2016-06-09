<?
$module=52;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$section_photo_items = sql_query("select p.* from photos as p, categories as c where p.category = c.id and c.name = 'sections' and p.deleted_p = 0") or die (mysql_error());

$smarty->assign("section_photos", $section_photo_items);
$smarty->display('./section_photos.tpl.html');

mysql_close();
?>