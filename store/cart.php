<?php

	include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
	include('functions.php');
	include($_SERVER['DOCUMENT_ROOT'].'/includes/functions.php');
	$smarty->assign('page', "store");

$smarty->display('../../templates/header.tpl.html');
		
	switch($_GET["action"])
	{
		case "add_item":
		{
			AddItem($_GET["id"], $_GET["quantity"]);
			ShowCart();
			break;
		}
		case "update_item":
		{
			UpdateItem($_GET["id"], $_GET["quantity"]);
			ShowCart();
			break;
		}
		case "remove_item":
		{
			RemoveItem($_GET["id"]);
			ShowCart();
			break;
		}
		default:
		{
			ShowCart();
		}
	}

	function AddItem($itemId, $quantity)
	{
		// Will check whether or not this item
		// already exists in the cart table.
		// If it does, the UpdateItem function
		// will be called instead
		
		// Check if this item already exists in the users cart table
		$result = db_query("select count(*) from store_cart where cookieId = '" . GetCartId() . "' and itemId = $itemId");
		$row = db_fetch_array($result);
		$numRows = $row[0];
		
		if($numRows == 0)
		{
			// This item doesn't exist in the users cart,
			// we will add it with an insert query

			db_query("insert into store_cart (cookieId, itemId, quantity) values('" . GetCartId() . "', $itemId, $quantity)");
		}
		else
		{
			// This item already exists in the users cart,
			// we will update it instead
			
			UpdateItem($itemId, $quantity);
		}
	}
	
	function UpdateItem($itemId, $quantity)
	{
		// Updates the quantity of an item in the users cart.
		// If the qutnaity is zero, then RemoveItem will be
		// called instead
		
		if($quantity == 0)
		{
			// Remove the item from the users cart
			RemoveItem($itemId);
		}
		else
		{
			db_query("update store_cart set quantity = $quantity where cookieId = '" . GetCartId() . "' and itemId = $itemId");
		}
	}
	
	function RemoveItem($itemId)
	{
		// Uses an SQL delete statement to remove an item from
		// the users cart

		db_query("delete from store_cart where cookieId = '" . GetCartId() . "' and itemId = $itemId");
	}
	
	function ShowCart()
	{
		// Gets each item from the cart table and display them in
		// a tabulated format, as well as a final total for the cart
		
		//include('header.php');
		
		show_order($oid,1);
		
		echo "<table width=100%>
				<tr>
					<td>
						<a href=/store/><img src=/images/contshop.gif border=0></a>
					</td>
					<td align=right>
						<a href=checkout.php><img src=/images/checkout.gif border=0></a>
					</td>
				</tr>
			</table>";

	}

$smarty->display('../../templates/footer.tpl.html');
?>