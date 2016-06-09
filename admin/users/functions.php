<? // users user

function user_add($user_name,$email,$real_name,$password) {
	global $feedback,$userid_c,$hidden_hash_var;
	//all vars present and passwords match?
	if ($user_name && $email && validate_email($email)) {
		//password and name are valid?
		if (account_namevalid($user_name)) {
			$user_name=strtolower($user_name);

			//does the name exist in the database?
			$sql="SELECT * FROM admin_users WHERE user_name='$user_name'";
			$result=db_query($sql);
			if ($result && db_numrows($result) > 0) {
				$feedback .=  ' ERROR - USER NAME EXISTS ';
				return $feedback;
			} else {
				//create a new hash to insert into the db and the confirmation email
				//$hash=md5($email.$hidden_hash_var);
				$sql="INSERT INTO admin_users (user_name,real_name,email,password,remote_addr,confirm_hash,is_confirmed,created_by) ".
					"VALUES ('$user_name','$real_name','$email','". md5($password). "','$GLOBALS[REMOTE_ADDR]','$hash','1','$userid_c')";
				$result=db_query($sql);
				
				if (!$result) {
					$feedback .= ' ERROR - '.db_error();
					return $feedback;
				} else {
					//send the confirm email
					//user_create_password($email,$user_name,$password);
					$feedback .= "Successfully added $user_name";
             return $feedback;
				}
			}
		} else {
			$feedback .=  ' Account Name or Password Invalid ';
			return $feedback;
		}
	} else {
		$feedback .=  ' ERROR - Must Fill In User Name, And Provide Valid Email Address ';
		return $feedback;
	}
}

function user_edit($id,$user_name,$email,$real_name,$password) {
	global $userid_c;
    // Check to make sure all variables have been passed.
    if ($user_name && $email && validate_email($email)) {
       // If valid, update user information according to user_id.
       //echo "$real_name, $user_name, $email, $user_id";
       $sql = "update admin_users set real_name='$real_name',
                                      user_name='$user_name',
                                      email='$email',
									  password='". md5($password). "',
									  created_by = '$userid_c'
                                where id=$id";
       $result = db_query($sql) or die ("User modify error: ". mysql_error());
       if ($result == 1) {
           $result = "User information successfully modified.";
       }
       return $result;

    } else {
       return "ERROR - Must Fill In Real Name, User Name, and Valid Email Address.";
    }
}

function user_delete($id) {
    //See if user still exists.
    $result = db_query("select id from admin_users where id=$id") or die("user query error: ". mysql_error());
    if (db_numrows($result) > 0) {
       $sql = "delete from admin_users where id=$id";
       $result = db_query($sql) or die ("User delete error: ". mysql_error());
       if ($result == 1) {
           $result = "User deleted successfully.";
       }
       return $result;
   } else {
       return "Error!  User does not exist.";
   }
}
?>