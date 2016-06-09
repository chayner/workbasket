<?
$module=12;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	if ($uploadfile) {
		$files_id = files_upload($HTTP_POST_FILES);
	} else {
		$files_id = get_new_id();
		files_insertnewrow($files_id);
	}
	header("Location: $siteroot$admindir/files/edit.php?id=$files_id");

} elseif ($action == "edit") {
	$name = $HTTP_POST_FILES['uploadfile']['name'];
	if ($name) {
		$files_array = files_upload($HTTP_POST_FILES, $id, $fileuploaded, $old_filename);
		list($filename, $filesize, $filetype, $fileuploaded) = $files_array;
	}

	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}


	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = files_edit($id, $title, $filename, $filetype, $filesize, $fileuploaded, $image_id, $caption, $copyright, $description, $category, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = files_delete($id, $filename, $fileuploaded, $del_file);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
}
?>