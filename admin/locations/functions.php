<? // location Module

function location_add($title, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $notes, $category, $owner) {
	global $cur_module;
    //Confirm that all required variables are present
    if (!$title && !$url) {
        return "You must enter information in Title and URL.";
    }

	if ($url && strpos($url,"http") === false) {
		$url = "http://".$url;
	}
		
    $sql = "INSERT INTO locations (title,
                                  address1,
                                  address2,
								  city,
								  state,
								  zip,
								  phone,
								  fax,
								  email,
								  url,
								  notes,
								  category,
								  owner,
								  created_on)
                          VALUES ('$title',
                                  '$address1',
                                  '$address2',
								  '$city',
								  '$state',
								  '$zip',
								  '$phone',
								  '$fax',
								  '$email',
                                  '$url',
								  '$notes',
								  '$category',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("location Item add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function location_edit($id, $title, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $notes, $category, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}
		
       // If valid, update user information according to user_id.
       $sql = "update locations set title='$title',
                               address1='$address1',
							   address2='$address2',
							   city='$city',
							   state='$state',
							   zip='$zip',
							   phone='$phone',
							   fax='$fax',
							   email='$email',
                               url='$url',
							   notes='$notes',
							   owner='$owner',
							   category='$category',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("location modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function location_delete($id) {	
	global $cur_module;
    // Check and see if the location exists.
    if ($id != "") {
       $result = db_query("select id
                             from locations
                            where id=$id")
                           or die("location check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete location from table.
       $sql = "DELETE FROM locations
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("location delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}
?>