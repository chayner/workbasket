<?php
$module=100;

include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/admin/includes/functions.php');

if ($submit) {

	$feedback = user_change_password ($new_password1,$new_password2,$change_user_name,$old_password);
    header("Location: $siteroot$admindir/index.php?feedback=$feedback");

}


$user_name = user_getname();
$smarty->assign('user_name',$user_name);

$smarty->display('./changepass.tpl.html');

mysql_close();


?>
