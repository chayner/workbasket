<?
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");

if ($action == "addcoupon") {
	
	$order = $_SESSION["order"];

	$coupon = strtolower($coupon);
	$couponcheck = sql_query("select * from store_coupons where LCASE(code) = '$coupon' limit 1");
	
	if ($couponcheck) {
		if ($couponcheck[0][type] == "p") {
			$couponredux = round($order[0][subtotal] * ($couponcheck[0][amount] / 100),2);
			$newtotal = $order[0][subtotal] + $order[0][shipping_amt] - $couponredux;
			$feedback = "You saved ".$couponcheck[0][amount]."% with the ".$couponcheck[0][description]."!";
		} elseif ($couponcheck[0][type] == "d") {
			$couponredux = $couponcheck[0][amount];
			$newtotal = $order[0][subtotal] + $order[0][shipping_amt] - $couponredux;
			$feedback = "You saved $".$couponcheck[0][amount]." with the ".$couponcheck[0][description]."!";
		}
		$coupon_id = $couponcheck[0][id];
		$addcoupon = db_query("UPDATE store_order_temp SET coupon = $coupon_id, coupon_redux = '$couponredux', total_amt = '$newtotal' where order_id = $oid");

	} else {
		$feedback = "Sorry, that is not a valid coupon code.";
	}
	header("Location: $PHP_SELF?feedback=$feedback");
}
$smarty->assign('feedback', $feedback);

$smarty->display('../../templates/header.tpl.html');

echo "<h3>Order Payment</h3>";

show_order($_SESSION["oid"],0);





$smarty->assign('oid', $oid);
$smarty->display('payment.tpl.html');

$smarty->display('../../templates/footer.tpl.html');
?>

