<?
$module=19;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {

	$feedback = page_add($filename, $title, $description, $body, $parent, $display_p, $section_s);

} elseif ($action == "import") {

	$feedback = page_import($id, $filename, $title, $description, $body, $parent, $display_p, $section_s);

} elseif ($action == "edit") {

	$feedback = page_edit($id, $filename, $title, $description, $body, $parent, $display_p, $section_s);

} elseif ($action == "delete") {

	$feedback = page_delete($id, $delete_file);
	
}

header("Location: $siteroot$admindir".$cur_mod['path']."?feedback=$feedback");

?>