<?
$module=9;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = location_add($title, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $notes, $category, $section_s);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = location_edit($id, $title, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $notes, $category, $section_s);

} elseif ($action == "delete") {
	
	$feedback = location_delete($id);

}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>