<?
$module=50;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");

if ($action == "add") {
	
	$feedback = user_add($user_name,$email,$real_name,$password);

} elseif ($action == "edit") {
	
	$feedback = user_edit($id,$user_name,$email,$real_name,$password);

} elseif ($action == "delete") {
	
	$feedback = user_delete($id);

}

header("Location: $siteroot$admindir/users/index.php?feedback=$feedback");

?>