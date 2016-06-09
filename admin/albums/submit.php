<?
$module=14;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	if ($source_file != NULL) {
		$album_id = album_upload($source_file);
	} else {
		$album_id = add_blank_album();
	}
	header("Location: $siteroot$admindir/albums/edit.php?id=$album_id");

} elseif ($action == "edit") {
	if ($source_file != NULL) {
		//echo "uploading file...";
		$album_id = album_upload($source_file, $id);
	} elseif ($rem_curimg) {
		$album_id = add_blank_album($id);
	}
	
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = album_edit($id, $title, $artist, $release_date, $label, $comment, $copyright, $merch_id, $streetteam_p, $category, $section_s, $userid_c);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = album_delete($id, $filename, $fileuploaded);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "track_add") {

	if ($HTTP_POST_FILES['uploadfile']['size'] > 0) {
		$track_array = track_upload($HTTP_POST_FILES, $id, $fileuploaded, $old_filename);
		list($filename, $filesize, $filetype, $fileuploaded) = $track_array;
	}
	if (track_add($id)) {
		$feedback = track_edit($id, $title, $album, $track, $fileuploaded, $filetype, $filename, $filesize, $artist, $words, $music, $description, $lyrics, $copyright, $download_p, $userid_c);
		header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	}
} elseif ($action == "track_edit") {
	
	$feedback = track_edit($id, $title, $album, $track, $fileuploaded, $filetype, $filename, $filesize, $artist, $words, $music, $description, $lyrics, $copyright, $download_p, $userid_c);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "track_delete") {

	$feedback = track_delete($id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
}

	
?>