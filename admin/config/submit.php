<?
$module=54;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "submit") {
	$feedback = config_submit($site_name, $from_address, serialize($s_norms), $eventseries_p, $photo_width, $photo_height, $photo_thumb, $img_width, $img_height, $img_thumb_width, $img_thumb_height, $multisection_p, $paypalemail, $storeaddress, $shipfirst, $shipusa, $shipint, $memberloc_p, $memberpass_p, $member_cust1, $member_cust2, $member_cust3, $member_cust4, $member_cust5, $member_cust6, $member_cust7);

} 

 


header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>