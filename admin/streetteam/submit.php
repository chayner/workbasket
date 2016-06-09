<?
$module=20;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "edit") {
	
	if ($password) {
		$password_enc = md5($password);
	}
	
	$feedback = streetteam_edit($id, $user_name, $password_enc, $fname, $lname, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $school, $bio, $section_s);
	header("Location: $siteroot$admindir/streetteam/list.php?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = streetteam_delete($id);
	header("location: $siteroot$admindir/streetteam/list.php?feedback=$feedback");
	
} elseif ($action == "comment") {
	
	$feedback = add_comment($id, $mod, $comments);
	header("location: $siteroot$admindir/streetteam/index.php?mod=$mod&feedback=$feedback");
}

if ($action == "locadd" || $action == "locdel") {
	header("location: $siteroot$admindir/members/locations.php?member_id=$member_id&feedback=$feedback");
} elseif ($action == "secadd" || $action == "secdel") {
	header("location: $siteroot$admindir/members/sections.php?member_id=$member_id&feedback=$feedback");
} elseif ($action == "eventadd" || $action == "eventdel") {
	header("location: $siteroot$admindir/members/streetteam.php?member_id=$member_id&feedback=$feedback");
}



?>