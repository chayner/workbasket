<?
$module=17;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = faq_add($question, $answer, $priority, $category, $section_s);

} elseif ($action == "edit") {
	if ($new_cat_name) {
		$category = add_new_category($new_cat_name, $new_cat_parent, $module, $section_s);
	}
	
	$feedback = faq_edit($id, $question, $answer, $priority, $category, $section_s);

} elseif ($action == "delete") {
	
	$feedback = faq_delete($id);

}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>