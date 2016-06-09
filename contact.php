<?
// index.php

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$contact_query = sql_query("select * from features where title='Contact'"); 
$smarty->assign('contact', $contact_query);

$smarty->display('contact.tpl.html');

mysql_close();
?>