<?php

$hidden_hash_var='madtown53';

$LOGGED_IN=false;
//clear it out in case someone sets it in the URL or something
unset($LOGGED_IN);

function user_isloggedin() {
   global $userid_c,$id_hash,$hidden_hash_var,$LOGGED_IN;
	//have we already run the hash checks? 
	//If so, return the pre-set var
	if (isset($LOGGED_IN)) {
		return $LOGGED_IN;
	}
	if ($userid_c && $id_hash) {
		$hash=md5($userid_c.$hidden_hash_var);
		if ($hash == $id_hash) {
            header ("Cache-Control: no-cache, must-revalidate");  // don't cache this page
            $LOGGED_IN=true;
            return true;
		} else {
			$LOGGED_IN=false;
            return false;
		}
	} else {
		$LOGGED_IN=false;
        return false;
	}
}

function user_login($user_name,$password) {
	global $feedback;
    //echo "User_login Function Top: $user_name<p>";
	if (!$user_name || !$password) {
		$feedback = "ERROR - You did not enter in both a user name and password.";
        return false;
	} else {
        //echo "User_login username and password exist: $user_name<p>";
        $user_name=strtolower($user_name);
        $password=strtolower($password);
		$sql="SELECT * FROM admin_users WHERE user_name='$user_name' AND password='". md5($password) ."'";
		//$sql="SELECT * FROM admin_users WHERE user_name='$user_name' AND password='$password'";
		
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1){
			$feedback .=  ' ERROR - User not found or password incorrect ';
			return false;
		} else {
			if (db_result($result,0,'is_confirmed') == '1') {
                $userid_c = db_result($result,0,'id');
                //echo "Userid: $userid_c<p>Username: $user_name<p>";
                session_start();
				$section_s = 0;	
				session_register('section_s');
				$section_s = 0;	
				// Update last login in database
				$last_login = db_query("update admin_users
										   set last_login=now()
										 where id=$userid_c") or die ("Login Error: ".mysql_error());						
				if (user_set_tokens($userid_c)) {
                    $feedback .=  ' SUCCESS - You Are Now Logged In ';
				    return true;
                } else {
                    return false;
                }
			} else {
				$feedback .=  ' ERROR - You haven\'t Confirmed Your Account Yet ';
				return false;
			}
		}
	}
}

function user_logout() {
    setcookie('userid_c','',time(),'/');
    setcookie('id_hash','',time(),'/');
//    setcookie('userid_c','',(time()+100000),'/');
//    setcookie('id_hash','',(time()+100000),'/');
}

function session_clear() {
  // if session exists, unregister all variables that exist and destroy session
  $exists = "no";
  $session_array = explode(";",session_encode());
  for ($x = 0; $x < count($session_array); $x++) {
    $name  = substr($session_array[$x], 0, strpos($session_array[$x],"|")); 
	if (session_is_registered($name)) {
	  session_unregister($name);
	  $exists = "yes";
	}
  }
  if ($exists != "no") {
     session_destroy();
  }
}

function user_set_tokens($userid_c_in) {
	global $hidden_hash_var,$user_name,$id_hash;
	if (!$userid_c_in && !$user_name_in) {
		$feedback .=  ' ERROR - User Name Missing When Setting Tokens ';
		return false;
	}
    $user_name=strtolower($user_name_in);
    $id_hash= md5($userid_c_in.$hidden_hash_var);
    setcookie('userid_c',$userid_c_in,time()+3600,'/');
   setcookie('id_hash',$id_hash,time()+3600,'/');
//    setcookie('userid_c',$userid_c_in,(time()+100000),'/');
//    setcookie('id_hash',$id_hash,(time()+100000),'/');
    return true;
}

function user_change_password ($new_password1,$new_password2,$change_user_name,$old_password) {
	global $feedback;
	//new passwords present and match?
	if ($new_password1 && ($new_password1==$new_password2)) {
		//is this password long enough?
		if (account_pwvalid($new_password1)) {
			//all vars are present?
			if ($change_user_name && $old_password) {
				//lower case everything
				$change_user_name=strtolower($change_user_name);
				$old_password=strtolower($old_password);
				$new_password1=strtolower($new_password1);
				$sql="SELECT * FROM admin_users WHERE user_name='$change_user_name' AND password='". md5($old_password) ."'";
				$result=db_query($sql);
				if (!$result || db_numrows($result) < 1) {
					return "User not found or bad password ".db_error();
				} else {
					$sql="UPDATE admin_users SET password='". md5($new_password1). "' ".
						"WHERE user_name='$change_user_name' AND password='". md5($old_password). "'";
					$result=db_query($sql);
					if (!$result || db_affected_rows($result) < 1) {
						return "NOTHING Changed ".db_error();
					} else {
						return "Password Changed";
					}
				}
			} else {
				return "Must Provide User Name And Old Password";
			}
		} else {
			return "New Passwords Doesn't Meet Criteria<br>Password must be at least 6 characters.";
		}
	} else {
		return "New Passwords Must Match";
	}
}

function user_lost_password ($email,$user_name) {
	global $feedback,$hidden_hash_var, $sitename, $fromaddress;
	if ($email && $user_name) {
		$user_name=strtolower($user_name);
		$sql="SELECT * FROM admin_users WHERE user_name='$user_name' AND email='$email'";
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1) {
			//no matching user found
			$feedback .= ' ERROR - Incorrect User Name Or Email Address ';
			return $feedback;
		} else {
			//create a secure, new password
			$new_pass=strtolower(substr(md5(time().$user_name.$hidden_hash_var),1,14));

			//update the database to include the new password
			$sql="UPDATE admin_users SET password='". md5($new_pass) ."' WHERE user_name='$user_name'";
			$result=db_query($sql);

			//send a simple email with the new password
			mail ($email,'$sitename Password','Your Password has been set to: '.$new_pass,'From: webmaster@$fromaddress');
			$feedback .= ' Your new password has been emailed to you. ';
			return $feedback;
		}
	} else {
		$feedback .= ' ERROR - User Name and Email Address Are Required ';
		return $feedback;
	}
}

function user_change_email ($password1,$new_email,$user_name) {
	global $feedback,$hidden_hash_var;
	if (validate_email($new_email)) {
		$hash=md5($new_email.$hidden_hash_var);
		//change the confirm hash in the db but not the email - 
		//send out a new confirm email with a new hash
		$user_name=strtolower($user_name);
		$password1=strtolower($password1);
		$sql="UPDATE admin_users SET confirm_hash='$hash' WHERE user_name='$user_name' AND password='". md5($password1) ."'";
		$result=db_query($sql);
		if (!$result || db_affected_rows($result) < 1) {
			$feedback .= ' ERROR - Incorrect User Name Or Password ';
			return false;
		} else {
			$feedback .= ' Confirmation Sent ';
			user_send_confirm_email($new_email,$hash);
			return true;
		}
	} else {
		$feedback .= ' New Email Address Appears Invalid ';
		return false;
	}
}


function user_create_password ($email,$user_name) {
	global $feedback,$hidden_hash_var, $fromaddress, $sitename, $siteroot, $admindir;
	if ($email && $user_name) {
		$user_name=strtolower($user_name);
		$sql="SELECT * FROM admin_users WHERE user_name='$user_name' AND email='$email'";
		$result=db_query($sql);
		if (!$result || db_numrows($result) < 1) {
			//no matching user found
			$feedback .= ' ERROR - Incorrect User Name Or Email Address ';
			return false;
		} else {
			//create a secure, new password
			$new_pass=strtolower(substr(md5(time().$user_name.$hidden_hash_var),1,14));

			//update the database to include the new password
			$sql="UPDATE admin_users SET password='". md5($new_pass) ."' WHERE user_name='$user_name'";
			$result=db_query($sql);

			//send a simple email with the new password
            $email_subject = "Welcome to $sitename admin!";
            $email_body =  "Welcome to $sitename admin!\n";
            $email_body .= "Use the following link to access the admin pages:  $siteroot$admindir\n\n";
            $email_body .= "Your username is: $user_name\n";
            $email_body .= "Your password has been set to: $new_pass\n\n";
            $email_body .= "When you first log in, click the \"change password\" button to change your password.\n\n";
            $email_body .= "Any questions?  E-mail webmaster@".$fromaddress.".";
			$email_from .= "From: webmaster@".$fromaddress;
            mail ($email,$email_subject,$email_body,$email_from);
			return true;
		}
	} else {
		$feedback .= ' ERROR - User Name and Email Address Are Required ';
		return false;
	}
}

function user_getid() {
    global $userid_c;
    //echo "User_GetID - User_id: $user_id, userid_c: $userid_c";
    if (user_isloggedin()) {
        if ($id == $userid_c) {
        return $id;
        } else {
        return $userid_c;
        }
	} else {
		//look up the user some day when we need it
		return ' ERROR - Not Logged In ';
	}
}

function user_getrealname($id = '0') {
	global $G_USER_RESULT, $userid_c;
    //echo "User_ID = $user_id";
    if ($id == '0') {
        $id = $userid_c;
    }
    //see if we have already fetched this user from the db, if not, fetch it
	if ($user_result=db_query("SELECT * FROM admin_users WHERE id='" . user_getid($id) . "'")) {
        return db_result($user_result,0,'real_name');
	} else {
		return false;
	}
}

function user_getemail() {
	global $G_USER_RESULT;
	//see if we have already fetched this user from the db, if not, fetch it
	if (!$G_USER_RESULT) {
		$G_USER_RESULT=db_query("SELECT * FROM admin_users WHERE id='" . user_getid() . "'");
	}
	if ($G_USER_RESULT && db_numrows($G_USER_RESULT) > 0) {
		return db_result($G_USER_RESULT,0,'email');
	} else {
		return false;
	}
}

function user_getname() {
	global $G_USER_RESULT;
	//see if we have already fetched this user from the db, if not, fetch it
	if (!$G_USER_RESULT) {
		$G_USER_RESULT=db_query("SELECT * FROM admin_users WHERE id='" . user_getid() . "'");
	}
	if ($G_USER_RESULT && db_numrows($G_USER_RESULT) > 0) {
		return db_result($G_USER_RESULT,0,'user_name');
	} else {
		return false;
	}
}

function account_pwvalid($pw) {
	global $feedback;
	if (strlen($pw) < 6) {
		$feedback .= " Password must be at least 6 characters.<br> ";
		return false;
	}
	return true;
}

function account_namevalid($name) {
	global $feedback;
	// no spaces
	if (strrpos($name,' ') > 0) {
		$feedback .= " There cannot be any spaces in the login name.<br> ";
		return false;
	}

	// must have at least one character
	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ") == 0) {
		$feedback .= "There must be at least one character.<br>";
		return false;
	}

	// must contain all legal characters
	if (strspn($name,"abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789-_")
		!= strlen($name)) {
		$feedback .= " Illegal character in name.<br> ";
		return false;
	}

	// min and max length
	if (strlen($name) < 2) {
		$feedback .= " Name is too short. It must be at least 3 characters.<br> ";
		return false;
	}
	if (strlen($name) > 15) {
		$feedback .= "Name is too long. It must be less than 15 characters.<br>";
		return false;
	}

	// illegal names
	if (eregi("^((root)|(bin)|(daemon)|(adm)|(lp)|(sync)|(shutdown)|(halt)|(mail)|(news)"
		. "|(uucp)|(operator)|(games)|(mysql)|(httpd)|(nobody)|(dummy)"
		. "|(www)|(cvs)|(shell)|(ftp)|(irc)|(debian)|(ns)|(download))$",$name)) {
		$feedback .= "Name is reserved.";
		return 0;
	}
	if (eregi("^(anoncvs_)",$name)) {
		$feedback .= "Name is reserved for CVS.";
		return false;
	}

	return true;
}


function user_permissions($section, $module) {
    global $userid_c, $multisection;
    if ($section && $multisection && $module < 50){
		
        $section_add = "AND section=$section";
    }
	
	if ($module == 100 || $module == 0) {
       return true;
    } else {
       $sql="SELECT *
               FROM permissions
              WHERE user_id=$userid_c
                AND module=$module
                $section_add";
                
       $result=db_query($sql) or die("Permission Error: ". mysql_error());
       if ($result && db_numrows($result) > 0) {
           return true;
       } else {
           return false;
       }
    }
}
?>
