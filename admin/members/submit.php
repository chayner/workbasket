<?
$module=11;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	if ($source_file != NULL) {
		$member_id = member_upload($source_file);
	} else {
		$member_id = add_blank_member();
	}
	header("Location: $siteroot$admindir/members/edit.php?id=$member_id");

} elseif ($action == "edit") {
	if ($source_file != NULL) {
		//echo "uploading file...";
		$member_id = member_upload($source_file, $id);
	} elseif ($rem_curimg) {
		$member_id = add_blank_member($id);
	}
	
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	if ($password) {
		$password_enc = md5($password);
	}
	$feedback = member_edit($id, $user_name, $password_enc, $member_title, $fname, $lname, $suffix, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $custom1, $custom2, $custom3, $custom4, $custom5, $custom6, $bio, $category, $section_s);
	header("Location: $siteroot$admindir/members/index.php?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = member_delete($id);
	header("location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "locadd") {
	
	$feedback = location_add($member_id, $location_id);

} elseif ($action == "locdel") {
	
	$feedback = location_delete($member_id, $location_id);

} elseif ($action == "secadd") {
	
	$feedback = section_add($member_id, $section_id, $position);

} elseif ($action == "secdel") {
	
	$feedback = section_delete($member_id, $section_id);

} 

if ($action == "locadd" || $action == "locdel") {
	header("location: $siteroot$admindir/members/locations.php?member_id=$member_id&feedback=$feedback");
} elseif ($action == "secadd" || $action == "secdel") {
	header("location: $siteroot$admindir/members/sections.php?member_id=$member_id&feedback=$feedback");
}



?>