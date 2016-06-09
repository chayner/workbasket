<? // guestbook Module

function guestbook_add($name, $email, $location, $body, $category, $owner) {
	global $cur_module;
    //Confirm that all required variables are present
    
    $sql = "INSERT INTO guestbook (name,
								  email,
								  location,
								  body,
								  category,
								  owner,
								  date)
                          VALUES ('$name',
                                  '$email',
								  '$location',
								  '$body',
                                  '$category',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("guestbook add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function guestbook_edit($id, $name, $email, $location, $body, $category, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

	   // If valid, update user information according to user_id.
       $sql = "update guestbook set name='$name',
                               email='$email',
							   location='$location',
							   body='$body',
                               owner='$owner',
							   category='$category'
                         where id=$id";
       $result = db_query($sql) or die ("guestbook modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function guestbook_delete($id) {	
	global $cur_module;
    // Check and see if the guestbook exists.
    if ($id != "") {
       $result = db_query("select id
                             from guestbook
                            where id=$id")
                           or die("guestbook check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete guestbook from table.
       $sql = "DELETE FROM guestbook
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("guestbook delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}


function guestbook_approve($id) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

	   // If valid, update user information according to user_id.
       $sql = "update guestbook set approved = 1
                         where id=$id";
       $result = db_query($sql) or die ("guestbook approval error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully approved.";
       }
       return $result;

    } else {
        return "Error with approval.  Please try again.";
    }
}

function guestbook_unapprove($id) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

	   // If valid, update user information according to user_id.
       $sql = "update guestbook set approved = 0
                         where id=$id";
       $result = db_query($sql) or die ("guestbook unapproval error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully unapproved.";
       }
       return $result;

    } else {
        return "Error with unapproval.  Please try again.";
    }
}
?>