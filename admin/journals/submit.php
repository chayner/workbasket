<?
$module=3;
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
	$feedback = journal_add($title, $author, $date, $body, $category, $section_s);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}
	
	$feedback = journal_edit($id, $title, $author, $date, $body, $image_id, $caption, $category, $section_s);

} elseif ($action == "delete") {
	
	$feedback = journal_delete($id);

}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>