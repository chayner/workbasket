<?
$module=5;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();

$media_query = sql_query("select * from media where deleted_p=0 ".$cur_cat['filter']." $section_filter order by category, title, caption"); 
$smarty->assign('media', $media_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>