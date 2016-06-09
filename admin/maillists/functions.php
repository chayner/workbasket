<? // maillist Module

function maillist_add($title, $summary, $email, $owner) {
	global $cur_module;
    //Confirm that all required variables are present
    if (!$title && !$email) {
        return "You must enter information in Title and Email.";
    }

    $sql = "INSERT INTO maillists (title,
                                  summary,
                                  email,
								  owner,
								  created_on)
                          VALUES ('$title',
                                  '$summary',
                                  '$email',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("Mail list add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function maillist_edit($id, $title, $summary, $email, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
       $sql = "update maillists set title='$title',
                               summary='$summary',
                               email='$email',
							   owner='$owner',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("Mail list modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function maillist_delete($id) {
	global $cur_module;
    // Check and see if the maillist exists.
    if ($id != "") {
       $result = db_query("select id
                             from maillists
                            where id=$id")
                           or die("Mail list check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete maillist from table.
       $sql = "DELETE FROM maillists
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("Mail list delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

function maillist_adduser($list_id, $fname, $lname, $email, $zip) {
	global $cur_module;
    //Confirm that all required variables are present
    if (!$fname && !$lname && !$email) {
        return "You must enter information in first and last names and email.";
    }

    $sql = "INSERT INTO maillist_users (fname,
                                  lname,
                                  email,
								  zip,
								  maillist_id)
                          VALUES ('$fname',
                                  '$lname',
                                  '$email',
								  '$zip',
                                  '$list_id')";
    $result = db_query($sql) or die ("Mail list add error: ". mysql_error());
    if ($result == 1) {
         $result = "User succesfully added.";
    }
    return $result;
}

function maillist_removeuser($list_id, $user_id) {
	global $cur_module;
    // Check and see if the maillist exists.
    if ($user_id != "") {
       $result = db_query("select *
                             from maillist_users
                            where maillist_id=$list_id
							  and id=$user_id")
                           or die("User check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "User does not subscribe to this ".$cur_module[0][item].".";
       }

       // If not, delete maillist from table.
       $sql = "DELETE FROM maillist_users
                     WHERE maillist_id=$list_id
					   AND id=$user_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Mail list delete error: ". mysql_error());
       if ($result == 1) {
           $result = "User succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing user.";
    }
}

function maillist_preview($list_id, $subject, $message, $from) {
	global $cur_module;
	/* recipients */
	$user_results = db_query("select email, fname, lname 
								from maillist_users
							   where maillist_id = $list_id") or die("Mail user error: ".mysql_error());

	$to = "";
    while ($user_array = mysql_fetch_array($user_results)) {
        if(list($email, $fname, $lname,) = $user_array) {	
			$to .= "$fname $lname <$email>" . ", " ;
		}
	}

	/* headers */
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: $from <$from>\n";
	$headers .= "Bcc: ".$to."\n";
	$raw_message = $message;
	
	$message=ereg_replace(10,"\n",$message);
	$message=stripslashes($message);
	$subject=stripslashes($subject);
	$finalmessage = "<html>
						<head>
						 <title>$subject</title>
						</head>
					 <body>$message</body></html>";

	$preview['headers'] = $headers;
	$preview['list_id'] = $list_id;
	$preview['raw_message'] = $raw_message;
	$preview['from'] = $from;
	$preview['subject'] = $subject;
	$preview['final'] = $finalmessage;
	
	return $preview;
}

function maillist_send($list_id) {
	global $cur_module, $cur_email;
	$current_email = $cur_email[$list_id];
	
	$subject = $current_email['subject'];
	$message = $current_email['raw_message'];
	$from = $current_email['from'];
	
	/* recipients */
	$user_results = db_query("select email, fname, lname 
								from maillist_users
							   where maillist_id = $list_id") or die("Mail user error: ".mysql_error());

	$to = "";
    while ($user_array = mysql_fetch_array($user_results)) {
        if(list($email, $fname, $lname,) = $user_array) {	
			$to .= "$fname $lname <$email>" . ", " ;
		}
	}

	/* headers */
	$headers  = "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
	$headers .= "From: $from <$from>\n";
	$headers .= "Bcc: ".$to."\n";
	
	$message=ereg_replace(10,"\n",$message);
	$message=stripslashes($message);
	$subject=stripslashes($subject);
	$finalmessage = "<html>
						<head>
						 <title>$subject</title>
						</head>
					 <body>$message</body></html>";


	if (mail("$from", "$subject", "$finalmessage", "$headers")) {
		
		if (session_is_registered('cur_email')) {
			unset($cur_email[$list_id]);
		}
		$feedback = "Message successfully sent.";
		
	} else {
		$feedback = "There was an error with your message.";
	}
	
	return $feedback;
}

function maillist_cancelsend($list_id) {
	global $cur_email;
	
	if (session_is_registered('cur_email')) {
		unset($cur_email[$list_id]);
	}
	$feedback = "Email Canceled.";
	return $feedback;
}
?>