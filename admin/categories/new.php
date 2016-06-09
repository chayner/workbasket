<?
$module=8;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
include("functions.php");


$cur_cat_mod_query = sql_query("select * from modules where id=$cur_cat_mod");
$smarty->assign('cur_cat_mod', $cur_cat_mod);
$smarty->assign('cur_cat_mod_name', $cur_cat_mod_query[0][name]);
$smarty->assign('cur_cat_mod_path', $cur_cat_mod_query[0][path]);

$smarty->assign('action', "add");
$smarty->assign('module', $module);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('id', $id);
$smarty->assign('feedback', $feedback);
$smarty->display('./form.tpl.html');


mysql_close();
?>