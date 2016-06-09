<?
// index.php
$module=4;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();


$photos_query = sql_query("select p.* from photos as p left join categories as c on p.category=c.id where p.deleted_p=0 ".$cur_cat['filter']." $sect_photo_filter order by c.ordervar desc, caption"); 
$smarty->assign('photos', $photos_query);

function insert_photoCategory($id) {
	return category_name($id[id], $modid[modid]);
}

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('c', $c);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>