<? include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");
include($_SERVER['DOCUMENT_ROOT']."/includes/maillist_functions.php");

if ($action == "subscribe") {
	// Add user to database
	$feedback = useradd($fname, $lname, $email, $zip, $maillist_id);
	if ($feedback == 1) {
		// Send user confirmation email
		//$sendmail = maillist_sendconfirm($maillist_id, $fname, $lname, $email);
		//Send thank you page
		header("Location: $thispage?page=thanks_sub&email=$email");
	} else {
		header("Location: $thispage?page=error&feedback=$feedback");
	}
	
} elseif ($action == "unsubscribe") {
	$feedback = userdel($email, $maillist_id);
	if ($feedback == 1) {
		//Send thank you page
		header("Location: $thispage?page=thanks_unsub&email=$email");
	} else {
		header("Location: $thispage?page=error&feedback=$feedback");
	}
}	

$maillist_dropdown = sql_query("select id, title, email as listemail from maillists");
$smarty->assign('dropdown', $maillist_dropdown);

if ($page == 'error') {
	$smarty->assign('feedback', $feedback);
	$smarty->display('maillist.tpl.html');
} elseif ($page == 'thanks_unsub') {
	$smarty->assign('feedback', "$email successfully unsubscribed.");
	$smarty->display('maillist.tpl.html');
} elseif ($page == 'thanks_sub') {
	$smarty->assign('feedback', "$email successfully subscribed!");
	$smarty->display('maillist.tpl.html');
} else {
	$smarty->display('maillist.tpl.html');
}	

?>