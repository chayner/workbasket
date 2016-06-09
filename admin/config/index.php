<?
$module=54;
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");

$config_query = sql_query("select * from config");
$s_norms_a = unserialize($config_query[0][s_norms]);
$smarty->assign('s_norms_a', $s_norms_a);

$allmodules_query = sql_query("select id, name from modules order by id");
$smarty->assign('allmodules', $allmodules_query);

//$permissions_query = sql_query("select * from permissions ".$cur_cat['filter']."order by user_id"); 
$smarty->assign('config_query', $config_query);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./index.tpl.html');

mysql_close();
?>