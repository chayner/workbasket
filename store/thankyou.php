<?
/*
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");
*/

//////////////////////////////////////////////////// 
// Written by: Marcus Cicero on a coffee break :) // 
//////////////////////////////////////////////////// 



// The worlds smallest php IPN function??? 
// Returns 1 for VERIFIED or 0 for INVALID 

function ipnVerify() 
{ 
    $ipnstr = 'cmd=_notify-validate'; 
    
	foreach($_POST as $ipnkey => $ipnval)  { 
		$ipnstr.= "&".$ipnkey."=".urlencode($ipnval); 
	} 
     
	echo "<p>$ipnstr";
	 
	$ipnget = file('http://paypal.com/?'.$ipnstr); 
    
	print_r($ipnget);
	if (strlen($ipnget[0]) == 8) { 
        return 1; 
	} else { 
		return 0;
	} 
} 



// Easy LOCAL to IPN variable comparison 
// Returns 1 for match or 0 for mismatch 

function ipnCompare($v,$c) 
{ 	
	echo "<pre>";
	echo "<p>V: $v C: $c";
	echo "</pre>";
    if (!strcasecmp($_POST[$v], $c)) {
		return 1; 
	} else { 
		return 0; 
	} 
} 


// USAGE EXAMPLE 

if (ipnVerify() && 
    ipnCompare('mc_gross','0.01') && 
    ipnCompare('receiver_email','chip@chiphayner.com') && 
    ipnCompare('payment_status','Pending')) 
	
{ 
	echo "Everything is fine and dandy!"; 
} else {
	echo "What is WRONG!!!"; 
} 


// Test it with this code: http://www.paypaldev.org/topic.asp?TOPIC_ID=1658 

////////////////////////// 
// Coffee break over... // 
////////////////////////// 

 

/*
if ($oid != "") {
		// Delete Cart information
		$cartId = GetCartId();
		$delete_from_cart = db_query("delete from store_cart where cookieId='$cartId'") or die(mysql_error());
		
		// Get Order Information
		$shopping_cart = db_query("select * from store_order_temp
										inner join merchandise on store_order_temp.item_id = merchandise.id 
										where store_order_temp.order_id = $oid
									 order by merchandise.name asc")
						 or die(mysql_error()."Couldn't retrieve shopping cart data.");
		
		if ($pt == 'c') {
			$paytype = 'check';
		} elseif ($pt == 'pp') {
			$paytype = 'paypal';
		}
			
		
		while($row = db_fetch_array($shopping_cart)) {
			global $cust_id;
			$cust_id = $row["cust_id"];
					
		// Insert into orders database
		$db_update = db_query("INSERT INTO store_orders (cust_id,
												   order_id,
												   item_id,
												   quantity,
												   subtotal,
												   coupon,
												   coupon_redux,
												   shipping_amt,
												   total_amt,
												   date_ordered,
												   order_status,
												   shipusa,
												   payment)
										  VALUES ('$cust_id',
												  '$oid',
												  '$row[item_id]',
												  '$row[quantity]',
												  '$row[subtotal]',
												  '$row[coupon]',
												  '$row[coupon_redux]',
												  '$row[shipping_amt]',
												  '$row[total_amt]',
												   date_format(date_add(now(), interval -13 hour), '%Y-%m-%d %T'),
												   '2',
												   '$row[shipusa]',
												   '$paytype')")
												   or die("Order problem: ".mysql_error());
		}
		
		// Remove from order_temp
		$delete_from_temp = db_query("delete from store_order_temp where order_id='$oid'") or die(mysql_error());
		
		// Send Email to Customer
		$cust_info = customer_info($cust_id);
		$email = $cust_info[0][email];
		$message = "Thank you for ordering with $sitename! We wanted to confirm that we recieved your order (#$oid)."
				  ."\n\nWe will send further emails updating you on the status of your order."
				  ."\n\nIf you have any questions, please do not hesitate to email us at customerservice@$fromaddress."
				  ."\n\nThanks again for ordering with $sitename."
				  ."\n\nSincerely,"
				  ."\nCustomer Service"
				  ."\n$sitename";
		mail("$email", "Order #$oid Confirmation from $sitename", "$message", "From: customerservice@$fromaddress");

		$noticeemail = $paypal_email;
		$noticemessage = "This message is to notify you that there is a new order in your online store."
						."\n\nPlease check your store administration for information about this order.";
						
		mail("$noticeemail", "Order placed at the $sitename store!", "$noticemessage", "From: orderalert@$fromaddress"); 
		
		$oid = "";
	
		header("Location: $siteroot/store/thankyou.php?pt=$pt");
		

}


$smarty->display('../../templates/header.tpl.html');

$smarty->display('thankyou.tpl.html');

$smarty->display('../../templates/footer.tpl.html');

*/
?>
