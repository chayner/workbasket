<?
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");

$smarty->display('../../templates/header.tpl.html');

echo "<h3>Verify My Order</h3>";

show_order($oid,0);

$smarty->assign('pt', $pt);
$smarty->display('verify.tpl.html');

$smarty->display('../../templates/footer.tpl.html');


?>