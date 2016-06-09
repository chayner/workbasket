<?
$module=4;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	$photo_id = photo_upload($source_file, $photo_filename);
	if ($cur_cat) {
		$cur_cat['link'] = "&cat=$cat";
	}
	header("Location: $siteroot$admindir/photos/edit.php?id=$photo_id".$cur_cat['link']);

} elseif ($action == "edit") {
	//print_r($source_file);
		
	if ($source_file != "none") {
		//echo "uploading file...";
		$photo_id = photo_upload($source_file, $photo_filename, $id);
	}

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	$feedback = photo_edit($id, $copyright, $author, $caption, $category, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = photo_delete($id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delcat") {

	$photo_query = db_query("select id from photos where category = $cat") or die ("Photo Query error: ".mysql_error());
	
	while (list($id) = db_fetch_array($photo_query)) {
		$feedback = photo_delete($id);
	}	
	
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

} elseif ($action == "import") {

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$num_imported = photo_import($category, $section_s);
	$feedback = "$num_imported file(s) successfully imported.";
	echo "$feedback";
	//header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

}

?>