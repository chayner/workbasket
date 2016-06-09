<?

function user_exists($email, $maillist_id) {
	$sql = db_query("select * from maillist_users where email = '$email' and maillist_id = $maillist_id") or die("User Error: ".mysql_error());
	if (db_numrows($sql) > 0) {
		return 1;
	} else {
		return 0;
	}
}

function useradd($fname, $lname, $email, $zip, $maillist_id) {

    if (!$fname && !$lname && !$email) {
		return "Please enter a valid name and address.";
    } elseif (user_exists($email, $maillist_id)) {
		return "$email is already subscribed to this list.";
	} else {
		$sql = "INSERT INTO maillist_users (fname,
									  lname,
									  email,
									  zip,
									  maillist_id)
							  VALUES ('$fname',
									  '$lname',
									  '$email',
									  '$zip',
									  '$maillist_id')";
		$result = db_query($sql) or die ("Mail list add error: ". mysql_error());
		return "1";
	}
}

function userdel($email, $maillist_id) {
    if (!$email) {
		return "Please enter a valid name and address.";
    } elseif (!user_exists($email, $maillist_id)) {
		return "$email is not subscribed to this list.";
	} else {
		$sql = "delete from maillist_users where email='$email' and maillist_id = $maillist_id";
		$result = db_query($sql) or die ("Mail list remove error: ". mysql_error());
		return "1";
	}
}

function maillist_sendconfirm($maillist_id, $fname, $lname, $email) {
	/* recipients */
	$to = "$fname $lname <$email>";

	$maillist_list_results = db_query("select distinct id as maillist_id,
                                                title as maillist_title,
                                                summary as maillist_summary,
												email as maillist_email
                                           from maillists
                                          where deleted_p = 0
                                            and id = $maillist_id")
                                         or die ("maillist access error: ". mysql_error());

    $maillist_list_array = mysql_fetch_array($maillist_list_results);
    list($maillist_id, $maillist_title, $maillist_summary, $maillist_email) = $maillist_list_array;
	
	/* headers */
	$headers  = "From: ".$maillist_email."\r\n";
	$subject = "Thanks for joining $maillist_title!!";
	$message = "Welcome to $maillist_title!  Stay tuned for further emails regarding site updates, tour dates, and other exciting news!";

	if (mail("$to", "$subject", "$message", "$headers")) {
		$feedback = "Message successfully sent.";
	} else {
		$feedback = "There was an error with your message.";
	}
	
	return $feedback;
}

function get_maillist_info($maillist_id) {
    $maillist_list_results = db_query("select distinct id as maillist_id,
                                                title as maillist_title,
                                                summary as maillist_summary,
												email as maillist_email
                                           from maillists
                                          where deleted_p = 0
                                            and id = $maillist_id")
                                         or die ("maillist access error: ". mysql_error());

    $maillist_list_array = mysql_fetch_array($maillist_list_results);
	return $maillist_list_array;
}

?>