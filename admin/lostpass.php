<?php
$module=100;

include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].$admindir.'/includes/user.php');

if ($submit) {
	$feedback = user_lost_password($email,$user_name);
	header("Location: $siteroot$admindir/login.php?feedback=$feedback");
}


$smarty->display('./lostpass.tpl.html');

mysql_close();


?>
