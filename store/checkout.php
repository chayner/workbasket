<?
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	include('functions.php');


//show_order(0);
$smarty->assign('page', "store");

$smarty->display('checkout.tpl.html');

?>



