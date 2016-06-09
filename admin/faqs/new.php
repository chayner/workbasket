<?
$module=17;
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

$next_p_query = sql_query("select priority from faqs order by priority desc limit 1");
$next_p = ($next_p_query[0][priority]) + 1;

$smarty->assign('next_p', $next_p);
$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "add");
$smarty->display('form.tpl.html');



mysql_close();
?>