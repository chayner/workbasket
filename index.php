<?

// index.php
$module = "links";

include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/functions.php");

$blurb = sql_query("select * from features where id = 4");
$smarty->assign("blurb", $blurb);

$smarty->display('index.tpl.html');


mysql_close();
?>