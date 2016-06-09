<? // member Module

function member_upload($source_file, $member_id = "") {
	global $_SERVER['DOCUMENT_ROOT'], $img_resize_height, $img_resize_width, $img_thumb_resize_width, $img_thumb_resize_height;
	
	//-----------------------//
	// get member information //
	//-----------------------//
	
	// get width and height
	$size = GetImageSize ("$source_file");
	$width = $size[0];
	$height = $size[1];
	//echo "Width: $width, Height: $height";
	
	// get file type: only gif and jpg allowed.
	if ($size[2] == 1) {
	  $type = "gif";
	  $valid_member = 0;
	} elseif ($size[2] == 2) {
	  $type = "jpg";
	  $valid_member = 1;
	} else {
	  $valid_member = 0;
	}
	
	if ($valid_member == 1) {  // process member if it is a valid graphic file format
	
		if (!$member_id) {
			// set $new_member_id variable to the most recent id
			$new_member_id = get_new_member_id();
		} else {
			$new_member_id = $member_id;
		}
	
	  // Determine the large size of member desired
	
		 $shrink_width = $img_resize_width;
		 $shrink_height = $img_resize_height;
	 
		
		if ($width > $height) {
			if (getNewHeight($shrink_width,$width,$height) < $shrink_height && $height > $shrink_height) {
				$new_width = $shrink_width;
				$new_height = getNewHeight($shrink_width,$width,$height);	
			} elseif ($height < $shrink_height) {
				$new_width = $width;
				$new_height = $height;
			} else {
				$new_height = $shrink_height;
				$new_width = getNewWidth($shrink_height,$width,$height);
			}
		} else {
			if (getNewHeight($shrink_height,$width,$height) < $shrink_height && $width > $shrink_width) {
				$new_width = $shrink_width;
				$new_height = getNewHeight($shrink_width,$width,$height);	
			} elseif ($width < $shrink_width) {
				$new_width = $width;
				$new_height = $height;
			} else {
				$new_height = $shrink_height;
				$new_width = getNewWidth($shrink_height,$width,$height);
			}
		}
	 
		
			if ($img_thumb_resize_width) {
			// If you want to size your thumbs by width:
			 $thumb_width = $img_thumb_resize_width;
			 $thumb_height = round((($thumb_width * $height) / $width), 0);
			} elseif ($img_thumb_resize_height) {
			// If you want to size your thumbs by height:
			 $thumb_height = $img_thumb_resize_height;
			 $thumb_width = round((($thumb_height * $width) / $height), 0);
			}
			
			// Create Main JPEG with new dimensions
			$src_img = imagecreatefromjpeg($source_file);
			$dst_img = imagecreatetruecolor($new_width, $new_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/member_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "member_".$new_member_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
			Imagejpeg($dst_img, $newfile, 95);

			ImageDestroy($src_img);
			ImageDestroy($dst_img);


			// Create Thumbnail JPEG with new dimensions
			$src_img = imagecreatefromjpeg($source_file);
			$dst_img = imagecreatetruecolor($thumb_width, $thumb_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/member_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "member_".$new_member_id."_thumb.jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
			Imagejpeg($dst_img, $newfile, 95);
	
	
			//-----------------------------------//
			//      Load member to database       //
			//-----------------------------------//
	  
	  		// If this is a new member...
	  		if (!$member_id) {
	  			$doquery = db_query("INSERT INTO members (id, photo_p, created_on)
										 VALUES ('$new_member_id',
										 		 '1',
												 now())")
										  or die(mysql_error()."Couldn't insert data.");
		
				// clean up
				ImageDestroy($src_img);
				ImageDestroy($dst_img);
				
				if ($doquery == 1) {
					return $new_member_id;
				}
			} else {
				$update_new_image = db_query("update members set created_on=now(), photo_p='1'
														  where id=$member_id")
														 or die (mysql_error());
				return $new_member_id;
			}
			

		}
}

function get_new_member_id() {
 // get new member id
			  $member_id_query = db_query("update members_seq set id=LAST_INSERT_ID(id+1)")
					  or die (mysql_error());
			
			  $new_member_id_query = db_query("select LAST_INSERT_ID() from members_seq")
					  or die (mysql_error());
			
			  if ($new_member_id_array = db_fetch_array($new_member_id_query)) {
				// set $new_member_id variable to the most recent id
				$new_member_id = $new_member_id_array[0];
			  }
	return $new_member_id;
}


function add_blank_member($member_id = "") {
	global $_SERVER['DOCUMENT_ROOT'];

	if (!$member_id) {
			// set $new_member_id variable to the most recent id
			$new_member_id = get_new_member_id();
		} else {
			$new_member_id = $member_id;
		}
	
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/member_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "member_".$new_member_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
				
	// save thumb as a file
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/member_temp.jpg";
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
	$final_filename = "member_".$new_member_id."_thumb.jpg";
	$newfile = $uploaddir . "/" . $final_filename;
	if (!copy($tempfile, $newfile)) 
		{
			// if an error occurs the file could not
			// be written, read or possibly does not exist
			print "Error Uploading File.";
			exit();
		}
		
	
	if (!$member_id) {
		$doquery = db_query("INSERT INTO members (id, photo_p, created_on)
									 VALUES ('$new_member_id', 0, now())")
									  or die(mysql_error()."Couldn't insert data.");
	
	} else {
		$doquery = db_query("update members set photo_p = 0 where id = $member_id")
									  or die(mysql_error()."Couldn't update data.");
	}
	return $new_member_id;
}


function member_edit($id, $user_name, $password, $title, $fname, $lname, $suffix, $address1, $address2, $city, $state, $zip, $phone, $fax, $email, $url, $custom1, $custom2, $custom3, $custom4, $custom5, $custom6, $bio, $category, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}

		$birthday = date('Y-m-d',strtotime($birthday));
	
		
       // If valid, update user information according to user_id.
       $sql = "update members set title='$title',
	   							  fname='$fname',
	   				 			  lname='$lname',
								  suffix='$suffix',
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
							   custom1='$custom1',
							   custom2='$custom2',
							   custom3='$custom3',
							   custom4='$custom4',
							   custom5='$custom5',
							   custom6='$custom6',
							   bio='$bio',
							   owner='$owner',
							   category='$category',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("member modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function member_delete($id) {	
	global $cur_module;
    // Check and see if the member exists.
    if ($id != "") {
       $result = db_query("select id
                             from members
                            where id=$id")
                           or die("member check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete member from table.
       $sql = "DELETE FROM members
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("member delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

//----------------------------------------------------------//
// Member / Location Map 									//
//----------------------------------------------------------//

function get_locations_dropdown() {
	echo "<select name=location_id>
          <option value='' selected>Locations</option>";

    $sql="select id,
                 title
            from locations
           where deleted_p = 0
        order by title";
    $result = db_query($sql) or die("Location Drop Down Error: ". mysql_error());
    while(list($id, $title) = db_fetch_array($result)) {
         echo "<option value=$id>$title</option>";
    }
    echo "</select>";
}

function check_location($member_id, $location_id) {	
   $result = db_query("select id
   						 from member_location_map
						where member_id=$member_id
						  and location_id=$location_id")
					   or die("Member/Location map check error: ". mysql_error());
   if (db_numrows($result) > 0) {
	   return true;
   } 
}

function location_add($member_id,$location_id) {
    // Check and see if the location already exists.
    if ($member_id && $location_id) {

	   if (check_location($member_id, $location_id)) {
	   		return "Location already exist";
	   }

       // If not, add location into table.
		$sql = "INSERT INTO member_location_map (member_id,location_id) VALUES ($member_id,$location_id)";
		$result = db_query($sql) or die ("Location add error: ". mysql_error());
		if ($result == 1) {
			return "Location succesfully added.";
		}
    } else {
       return "You must select a member and a location.";
    }
}

function location_delete($member_id,$location_id) {
    // Check and see if the permission already exists.
    if ($member_id && $location_id) {
	   if (!check_location($member_id, $location_id)) {
	   		return "Location does not exist";
	   }

       // If not, delete permission from table.
       $sql = "DELETE FROM member_location_map
                     WHERE member_id=$member_id
                       AND location_id=$location_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Location delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Location succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a member and a location.";
    }
}

//----------------------------------------------------------//
// Member / Section Map 									//
//----------------------------------------------------------//

function get_sections_dropdown() {
	global $sect_mod;
	echo "<select name=section_id>
          <option value='' selected>".$sect_mod[0]['name']."</option>
		  <option value=''>-------------------------</option>";

    $sql="select id,
                 name
            from sections
           where deleted_p = 0
        order by name";
    $result = db_query($sql) or die($sect_mod[0]['item']." Drop Down Error: ". mysql_error());
    while(list($id, $name) = db_fetch_array($result)) {
         echo "<option value=$id>$name</option>";
    }
    echo "</select>";
}

function check_section($member_id, $section_id) {	
	  global $sect_mod;
	  $result = db_query("select id
   						 from member_section_map
						where member_id=$member_id
						  and section_id=$section_id")
					   or die("Member/".$sect_mod[0]['name']." map check error: ". mysql_error());
   if (db_numrows($result) > 0) {
	   return true;
   } 
}

function section_add($member_id,$section_id,$position) {
	global $sect_mod;
	// Check and see if the section already exists.
    if ($member_id && $section_id) {

	   if (check_section($member_id, $section_id)) {
	   		return $sect_mod[0]['item']." already exist";
	   }

       // If not, add section into table.
		$sql = "INSERT INTO member_section_map (member_id,section_id,position) VALUES ($member_id,$section_id,'$position')";
		$result = db_query($sql) or die ("section add error: ". mysql_error());
		if ($result == 1) {
			return "member info succesfully modified.";
		}
    } else {
       return "You must select a member and a ".$sect_mod[0]['item'];
    }
}

function section_delete($member_id,$section_id) {
	global $sect_mod;
	// Check and see if the permission already exists.
    if ($member_id && $section_id) {
	   if (!check_section($member_id, $section_id)) {
	   		return $sect_mod[0]['item']." does not exist";
	   }

       // If not, delete permission from table.
       $sql = "DELETE FROM member_section_map
                     WHERE member_id=$member_id
                       AND section_id=$section_id
                     LIMIT 1";
       $result = db_query($sql) or die ($sect_mod[0]['item']." delete error: ". mysql_error());
       if ($result == 1) {
           $result = "member info successfully modified";
       }
       return $result;
    } else {
       return "You must select a member and a ".$sect_mod[0]['item'];
    }
}
?>