<?
$module=53;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	
	$feedback = permission_add($user_id,$section_id,$module_id);

} elseif ($action == "delete") {
	
	$feedback = permission_delete($user_id,$section_id,$module_id);

} elseif ($action == "sectdelete") {
	
	$feedback = sect_permission_delete($user_id,$section_id);

} elseif ($action == "userdelete") {
	
	$feedback = user_permission_delete($user_id);

} elseif ($action == "sectmoddelete") {
	
	$feedback = sectmod_permission_delete($user_id,$section_id);

} elseif ($action == "configmoddelete") {
	
	$feedback = configmod_permission_delete($user_id,$section_id);

}

header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");

?>