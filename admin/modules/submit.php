<?
$module=51;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "add") {
	
	$feedback = module_add($name, $description, $item, $path, $dbtable, $global_mod, $add_del, $public, $cat_p, $cat_name);

} elseif ($action == "edit") {
	
	$feedback = module_edit($id, $name, $description, $item, $path, $dbtable, $global_mod, $add_del, $public, $cat_p, $cat_name);

} elseif ($action == "delete") {
	
	$feedback = module_delete($id);

}

header("Location: $siteroot$admindir/modules/index.php?feedback=$feedback");

?>