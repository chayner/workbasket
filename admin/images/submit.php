<?
$module=15;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	$image_id = image_upload($source_file, $image_filename);
	header("Location: $siteroot$admindir/images/edit.php?id=$image_id");

} elseif ($action == "edit") {
	//print_r($source_file);
		
	if ($source_file != "none") {
		//echo "uploading file...";
		$image_id = image_upload($source_file, $image_filename, $caption, $id);
	}

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	$feedback = image_edit($id, $copyright, $author, $caption, $category, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = image_delete($id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delcat") {

	$image_query = db_query("select id from images where category = $cat") or die ("image Query error: ".mysql_error());
	
	while (list($id) = db_fetch_array($image_query)) {
		$feedback = image_delete($id);
	}	
	
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
}

?>