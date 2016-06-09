<? // streetteam Module
function no_member_id($email, $zip) {
	$check_for_id = sql_query("select id from streetteam where email='$email' and zip='$zip'");
	if (!$check_for_id) {
		$new_member_id = sql_query("select id from streetteam order by id desc limit 1");
		return $new_member_id[0]['id'] + 1;
	} else {
		return $check_for_id[0]['id'];
	}
}

function streetteam_edit($id, $user_name, $password, $fname, $lname, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $school, $bio, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
 	if (!$id) {
		$id = no_member_id($email, $zip);
		$new_entry = db_query("INSERT INTO streetteam (id) VALUES ($id)") or die ("New ID error: ".mysql_error()); 
	}	
	if ($id) {

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}

		$birthday = date('Y-m-d',strtotime($birthday));
	
		
       // If valid, update user information according to user_id.
       $sql = "update streetteam  set fname='$fname',
	   				 			 	  lname='$lname',
								 	  address1='$address1',
							   	 	  address2='$address2',
									  city='$city',
									  state='$state',
									  zip='$zip',
									  phone='$phone',
									  fax='$fax',
									  email='$email',
									  url='$url',
									  user_name='$user_name',
									  password='$password',
									  school='$school',
									  bio='$bio',
									  owner='$owner',
									  created_on=now()
                         		where id=$id";
       $result = db_query($sql) or die ("street team streetteam modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function streetteam_delete($id) {	
	global $cur_module;
    // Check and see if the streetteam exists.
    if ($id != "") {
       $result = db_query("select id
                             from streetteam
                            where id=$id")
                           or die("streetteam check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }
	   // Delete from map tables
	   $sql = "delete from streetteam_album_map 
	   				 where member_id = $id";
       $result = db_query($sql) or die ("streetteam album map delete error: ". mysql_error());
	   
	   $sql = "delete from streetteam_event_map 
	   				 where member_id = $id";
       $result = db_query($sql) or die ("streetteam event map delete error: ". mysql_error());

	   
       // If not, delete streetteam from table.
       $sql = "DELETE FROM streetteam
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("streetteam delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

//----------------------------------------------------------//
// Street Team Maps		 									//
//----------------------------------------------------------//

function add_comment ($map_id, $mod, $comments) {
$sql = "update streetteam_".$mod."_map
					set comments='$comments'
					where id=$map_id";
					
       $result = db_query($sql) or die ("street team comment modify error: ". mysql_error());
       if ($result == 1) {
           $result = "comment successfully added.";
       }
       return $result;
}

function check_map($member_id, $module, $mod_id) {	
	 
	  $result = db_query("select id
   						 from streetteam_".$module."_map
						where member_id=$member_id
						  and ".$module."_id=$mod_id")
					   or die("street team map check error: ". mysql_error());
   if (db_numrows($result) > 0) {
   		return true;
   } 
}

function map_delete($member_id, $module, $mod_id) {
	 // Check and see if the permission already exists.
    if ($member_id && $module && $mod_id) {
	   if (!check_map($member_id, $module, $mod_id)) {
	   		return "member map does not exist";
	   }

       // If not, delete permission from table.
       $sql = "DELETE FROM streetteam_".$module."_map
                     WHERE member_id=$member_id
                       AND ".$module."_id=$mod_id
                     LIMIT 1";
       $result = db_query($sql) or die ($event_mod[0]['item']." delete error: ". mysql_error());
       if ($result == 1) {
           $result = "street team member successfully removed.";
       }
       return $result;
    } else {
       return "You must select a streetteam and a $module.";
    }
}

?>