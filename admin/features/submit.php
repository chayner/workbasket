<?
$module=10;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "add") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}

	$feedback = features_add($title, $date, $body, $image_id, $priority, $caption, $category, $section_s, $userid_c);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}


	$feedback = features_edit($id, $title, $date, $body, $image_id, $priority, $caption, $category, $section_s, $userid_c);

} elseif ($action == "delete") {
	
	$feedback = features_delete($id);

}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>