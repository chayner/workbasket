<? // permissions permission

function config_submit($sitename, $fromaddress, $s_norms, $eventseries_p, $photo_width, $photo_height, $photo_thumb, $img_width, $img_height, $img_thumb_width, $img_thumb_height, $multisection_p, $paypal_email, $store_address, $ship_first, $ship_usa, $ship_int, $memberloc, $memberpass, $member_cust1, $member_cust2, $member_cust3, $member_cust4, $member_cust5, $member_cust6, $member_cust7) {
   
     	$sql = db_query("update config set 
								paypal_email='$paypal_email',
								store_address='$store_address',
								ship_first='$ship_first',
								ship_usa='$ship_usa',
								ship_int='$ship_int',
								sitename='$sitename',
								fromaddress='$fromaddress',
								s_norms='$s_norms',
								eventseries='$eventseries_p',
								photo_resize_width='$photo_width',
								photo_resize_height='$photo_height',								
								photo_thumb_resize='$photo_thumb',
								img_resize_width='$img_width',
								img_resize_height='$img_height',
								img_thumb_resize_width='$img_thumb_width',
								img_thumb_resize_height='$img_thumb_height',
								multisection='$multisection_p',
								memberloc='$memberloc',
								memberpass='$memberpass',
								member_cust1='$member_cust1',
								member_cust2='$member_cust2',
								member_cust3='$member_cust3',
								member_cust4='$member_cust4',
								member_cust5='$member_cust5',
								member_cust6='$member_cust6',
								member_cust7='$member_cust7'") or die ("Module modify error: ". mysql_error());
       if ($sql == 1) {
           $result = "Config successfully updated.";
       } else {
	   	$result = "there was some problem.";
		}
       return $result;
}

?>