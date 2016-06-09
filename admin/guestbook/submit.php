<?
$module=18;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = guestbook_add($name, $email, $location, $body, $category, $section_s);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = guestbook_edit($id, $name, $email, $location, $body, $category, $section_s);

} elseif ($action == "delete") {
	
	$feedback = guestbook_delete($id);

} elseif ($action == "approve") {

	$feedback = guestbook_approve($id);

} elseif ($action == "unapprove") {

	$feedback = guestbook_unapprove($id);
	
}



header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>