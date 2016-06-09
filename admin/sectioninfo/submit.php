<?
$module=16;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "edit") {
	if ($source_file != NULL) {
		//echo "uploading file...";
		$section_id = section_upload($source_file, $id);
	} elseif ($rem_curimg) {
		$section_id = add_blank_section($id);
	}
	
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}

	if ($director_id > 0) {
		$director_query = sql_query("select * from members where id=$director_id");
			
		$director = $director_query[0][fname]." ".$director_query[0][lname];
		$director_email = $director_query[0][email];
		$director_phone = $director_query[0][phone];
	}

	$feedback = section_edit($id, $name, $description, $link, $director_id, $director, $director_phone, $director_email, $category);
	header("Location: $siteroot$admindir/sectioninfo/index.php?feedback=$feedback");
	
} 

?>