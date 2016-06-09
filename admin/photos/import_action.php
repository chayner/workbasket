<?
$module=4;

include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");
$smarty->display('../../templates/header.tpl.html');

if ($action == "import") {

	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$num_imported = photo_import($category, $section_s, $caption_p);
	$feedback = "$num_imported file(s) successfully imported.";
	echo "$feedback";
	
	echo "<p><a href=index.php><strong>Return to photo admin</strong></a></p>";

}

$smarty->display('../../templates/footer.tpl.html');
?>
