<?
$module=1;
header("Cache-control: private");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


$smarty->assign('news', $post_temp);

$smarty->assign('root', $_SERVER['DOCUMENT_ROOT']);
$smarty->assign('action', "add");
$smarty->display('form.tpl.html');



mysql_close();
?>