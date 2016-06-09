<?
$module=3;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$journals_query = sql_query("select * from journals where deleted_p=0 ".$cur_cat['filter']." $section_filter order by date desc"); 
$smarty->assign('journals', $journals_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');


mysql_close();
?>