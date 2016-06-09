<?php

include($_SERVER['DOCUMENT_ROOT'].'/includes/initiate.php');
session_start();
include($_SERVER['DOCUMENT_ROOT'].'/admin/includes/user.php');




if (isset($user_name) && isset($password)) {
   //echo "$user_name, $password";
   if (user_login($user_name,$password)) {
       //echo "<p>After login function: $feedback";
       $feedback = "You're logged in!";
       header("Location: index.php?".sid);
   } 
}


if (user_isloggedin()) {
        user_logout();
        $user_name='';
        session_destroy();

}

if ($feedback) {
    if ($feedback == 1) {
       $feedback = "You are not logged in. Please log in below.";
    }
	$smarty->assign('feedback', $feedback);
}


$smarty->display('login.tpl.html');

mysql_close();


?>
