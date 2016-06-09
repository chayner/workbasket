<?
$module=13;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "upload") {
	if ($source_file != NULL) {
		$merchandise_id = merchandise_upload($source_file, $merchandise_filename);
	} else {
		$merchandise_id = add_blank_merchandise();
	}
	header("Location: $siteroot$admindir/store/edit.php?id=$merchandise_id");

} elseif ($action == "edit") {
	//print_r($source_file);
		
	if ($source_file != NULL) {
		//echo "uploading file...";
		$merchandise_id = merchandise_upload($source_file, $merchandise_filename, $id);
	} elseif ($rem_curimg) {
		$merchandise_id = add_blank_merchandise($id);
	}

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	$feedback = merchandise_edit($id, $name, $subname, $description, $lprice, $sprice, $noship, $copyright, $sizes_p, $size_small, $size_medium, $size_large, $size_xlarge, $size_xxlarge, $size_xxxlarge, $category, $section_s);
	header("Location: $siteroot$admindir/store/index.php?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = merchandise_delete($id);
	header("Location: $siteroot$admindir/store/index.php?feedback=$feedback");
	
} elseif ($action == "settings") {
	$feedback = store_settings($paypalemail, $storeaddress, $shipfirst, $shipusa, $shipint);
	header("Location: $siteroot$admindir/store/index.php?feedback=$feedback");
}
?>