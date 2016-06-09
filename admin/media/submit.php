<?
$module=5;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	if ($uploadfile) {
		$media_id = media_upload($HTTP_POST_FILES);
	} else {
		$media_id = get_new_id();
		media_insertnewrow($media_id);
	}

	header("Location: $siteroot$admindir/media/edit.php?id=$media_id");

} elseif ($action == "edit") {

	if ($HTTP_POST_FILES['uploadfile']['size'] > 0) {
		$media_array = media_upload($HTTP_POST_FILES, $id, $fileuploaded, $old_filename);
		list($filename, $filesize, $filetype, $fileuploaded) = $media_array;
	}
	
	if ($source_file) {
		$image_id = image_upload($source_file, $source_filename, $caption);
	} else {
		$image_id = $image;
	}

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	$feedback = media_edit($id, $author, $title, $filename, $filetype, $fileuploaded, $image_id, $caption, $copyright, $description, $category, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = media_delete($id, $filename, $fileuploaded);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
}
?>