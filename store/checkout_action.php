<?
//print_r($HTTP_POST_VARS);
	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	include('functions.php');

// Step 1a: Check and see if user exists
$cust_query = db_query("select * from customers where email='$email' and zip='$zip'") or die(mysql_error());
$cust_exists = db_numrows($cust_query);
if ($cust_exists == 1) {
	$cust_array = db_fetch_array($cust_query);
	$new_cust_id = $cust_array[id];
} else {


	// Step 1b: Is user does not exist, get New Customer ID...
	  $cust_id_query = db_query("update customers_seq set id=LAST_INSERT_ID(id+1)")
    	      or die (mysql_error());

	  $new_cust_id_query = db_query("select LAST_INSERT_ID() from customers_seq")
    	      or die (mysql_error());
	
	  if ($new_cust_id_array = db_fetch_array($new_cust_id_query)) {
    	// set $new_cust_id variable to the most recent id
	    $new_cust_id = $new_cust_id_array[0];
	  }

	
	// Step 1c: ...then insert Customer Information into customers database

	$new_customer = db_query("insert into customers (id, 
													 fname, 
													 lname,
													 address1,
													 address2,
													 city,
													 state,
													 zip,
													 country,
													 phone,
													 email,
													 date_created)
											  VALUES ('$new_cust_id',
											  		  '$fname',
													  '$lname',
													  '$address1',
													  '$address2',
													  '$city',
													  '$state',
													  '$zip',
													  '$country',
													  '$phone',
													  '$email',
													  date_format(date_add(now(), interval -1 hour), '%Y-%m-%d %T'))")
											or die(mysql_error()."Couldn't insert customer data.");

}

// Set a Customer ID cookie
//setcookie("cust_id", "$new_cust_id", time() + ((3600 * 24) * 30));
$_SESSION["cust_id"] = $new_cust_id;


// Step 2: Get New Order ID

  $order_id_query = db_query("update store_order_seq set id=LAST_INSERT_ID(id+1)")
          or die (mysql_error());

  $new_order_id_query = db_query("select LAST_INSERT_ID() from store_order_seq")
          or die (mysql_error());

  if ($new_order_id_array = db_fetch_array($new_order_id_query)) {
    // set $new_order_id variable to the most recent id
    $new_order_id = $new_order_id_array[0];
  }

// Step 3:  Enter Order information into orders database

// Get information from Shopping Cart
$shopping_cart = db_query("select * from  store_cart 
								inner join merchandise on store_cart.itemId = merchandise.id 
								where store_cart.cookieId = '" . GetCartId() . "'
							 order by merchandise.name asc")
				 or die(mysql_error()."Couldn't retrieve shopping cart data.");


$first_item = true;
while($row = db_fetch_array($shopping_cart)) {

 	$cust_info = customer_info($_SESSION["cust_id"]);
	$totalCost += ($row["quantity"] * $row["sprice"]);
	if ($cust_info[0][country] == "USA") {
		$shipping_amt = $ship_usa;
		$shipusa = 1;
	} else {
		$shipping_amt = $ship_int;
		$shipusa = 0;
	}
	
	if ($row["noship"] == 0) {
		if ($first_item) {
			$totalShipping = $ship_first + (($row["quantity"] - 1) * $shipping_amt) ;
			$first_item = false;
		} else {
			$totalShipping += ($row["quantity"] * $shipping_amt);	
		}
	}
		
	$insert_order_db = db_query("INSERT INTO store_order_temp (cust_id,
                                          		 order_id,
                                          		 item_id,
                                          		 quantity,
												 date_ordered,
												 shipusa,
												 order_status)
		                                VALUES ('$new_cust_id',
                                         		'$new_order_id',
												'$row[id]',
												'$row[quantity]',
												'$shipusa',
												date_format(date_add(now(), interval -13 hour), '%Y-%m-%d %T'),
												'1')")
								or die("Couldn't insert order data: ".mysql_error());
}

$totalPayment = $totalShipping + $totalCost;
$update_total = db_query("update store_order_temp set subtotal='$totalCost', total_amt='$totalPayment', shipping_amt='$totalShipping' where order_id = $new_order_id") or die("Update Total Amt error: ".mysql_error());

// Step 4: Display payment menthod
$_SESSION["oid"] = $new_order_id;

header("Location: $siteroot/store/payment.php?oid=$new_order_id");
?>
