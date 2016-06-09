<?
// bio.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$bio_query = sql_query("select * from features where category=9 ORDER BY priority"); 
$smarty->assign('bio', $bio_query);

$smarty->display('us.tpl.html');

mysql_close();
?>