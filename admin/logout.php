<?php


include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/admin/includes/user.php');


if (user_isloggedin()) {
	user_logout();
	$user_name='';
    //session_unregister("feedback");
    session_unregister("ministry_s");
	session_destroy();
}



$smarty->display('logout.tpl.html');

mysql_close();
?>
