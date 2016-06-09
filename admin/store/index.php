<?
// index.php
$module=13;

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$smarty->clear_all_cache();

$config_query = sql_query("select * from config");
$smarty->assign('config_query', $config_query);



$merchandise_query = sql_query("select * from merchandise where deleted_p=0 ".$cur_cat['filter']." $section_filter order by category, name"); 
$smarty->assign('merchandise', $merchandise_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('index.tpl.html');


mysql_close();
?>