<?
$module=7;
include("functions.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/functions.php");


if ($action == "add") {
	
	$feedback = maillist_add($title, $summary, $email, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "edit") {
	
	$feedback = maillist_edit($id, $title, $summary, $email, $section_s);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "delete") {
	
	$feedback = maillist_delete($id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "user_add") {

	$feedback = maillist_adduser($list_id, $fname, $lname, $email, $zip);
	$action = "";
	header("Location: $siteroot$admindir/maillists/users.php?list_id=$list_id&feedback=$feedback");

} elseif ($action == "user_del") {

	$feedback = maillist_removeuser($list_id, $user_id);
	header("Location: $siteroot$admindir/maillists/users.php?list_id=$list_id&feedback=$feedback");
	
} elseif ($action == "send") {

	$feedback = maillist_send($list_id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
	
} elseif ($action == "cancel") {
	$feedback = maillist_cancelsend($list_id);
	header("Location: $siteroot$admindir".$cur_module[0][path]."?feedback=$feedback");
}

?>