<?
$module=8;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add_cat") {

	$feedback = category_add($cat_name, $cat_desc, $cur_cat_mod, $section_s);

} elseif ($action == "edit_cat") {

	$feedback = category_edit($cat_id, $cat_name, $cat_desc, $cat_order, $parent, $cur_cat_mod, $section_s);

} elseif ($action == "del_cat") {

	$feedback = category_delete($id, $cur_cat_mod);
	
}

header("Location: $siteroot$admindir".$cur_module[0][path]."?cur_cat_mod=$cur_cat_mod&feedback=$feedback");

?>