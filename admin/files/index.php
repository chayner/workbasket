<?
$module=12;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();

$files_query = sql_query("select * from files where deleted_p=0 ".$cur_cat['filter']." $section_filter order by category, caption"); 
$smarty->assign('files', $files_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>