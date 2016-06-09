<?
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");



if ($action == "full") {
	$delete_from_orders = db_query("delete from store_order_temp where order_id=$oid") or die(mysql_error());
	$cartId = GetCartId();
	$delete_from_cart = db_query("delete from store_cart where cookieId='$cartId'") or die(mysql_error());
	$oid = "";
	unset($_SESSION["oid"]);
	header("Location: $siteroot/store/index.php");
} else if ($action == "temp") {
	$delete_from_orders = db_query("delete from store_order_temp where order_id=$oid") or die(mysql_error());
	$oid = "";
	unset($_SESSION["oid"]);
	header("Location: $siteroot/store/index.php");
}

$smarty->display('../../templates/header.tpl.html');


echo "<h3>Cancel My Order</h3>";

show_order($oid,0);

echo "<p><b>Are you sure you want to cancel this order?</b>";

echo "<p><a href=payment.php?oid=$oid>I would like to select a different method of payment.</a>";

echo "<p><a href=$PHP_SELF?action=temp&oid=$oid>Cancel my order for now, but keep the items in my shopping cart</a></p>
<p><a href=$PHP_SELF?action=full&oid=$oid>Cancel my order completely and remove items from my cart</a></p>";

$smarty->display('../../templates/footer.tpl.html');
?>