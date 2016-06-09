<?
$module=14;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$artwork_items = sql_query("select p.* from photos as p, categories as c where p.category = c.id and c.name = 'album artwork' and p.deleted_p = 0") or die (mysql_error());

$smarty->assign("artwork", $artwork_items);
$smarty->display('./artwork.tpl.html');

mysql_close();
?>