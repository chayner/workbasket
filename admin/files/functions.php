<? // files Module
function get_new_id() {
	  // get new files id
	  $files_id_query = db_query("update files_seq set id=LAST_INSERT_ID(id+1)")
			  or die (mysql_error());
	
	  $new_files_id_query = db_query("select LAST_INSERT_ID() from files_seq")
			  or die (mysql_error());
	
	  if ($new_files_id_array = db_fetch_array($new_files_id_query)) {
		// set $new_files_id variable to the most recent id
		return $new_files_id_array[0];
	  }
}

function files_upload($HTTP_POST_FILES, $files_id = "", $fileuploaded="0", $old_filename="") {
	
	global $_SERVER['DOCUMENT_ROOT'], $HTTP_POST_FILES;
	
	//-----------------------//
	// get files information //
	//-----------------------//
	
	// get information about the file
	$fileinfo = $HTTP_POST_FILES['uploadfile'];
	$filesize = $fileinfo['size'];
	$filename = $fileinfo['name'];
	$filetype = $fileinfo['type'];
	$filetemp = $fileinfo['tmp_name'];
	

	// Find if item already has a files_id assigned to it.
	if (!$files_id) {
		$new_files_id = get_new_id();
	} else {
		$new_files_id = $files_id;
	}

	if ($filesize > 0) {  // process files if it is a valid file
	
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files/";

		if (file_exists("$uploaddir$filename")) {
			$dot_pos = strrpos($filename, '.');
			$filename = substr($filename,0,$dot_pos)."(2)".strrchr($filename,'.');
		}
		
		// Copy file to correct directory
		if (move_uploaded_file($filetemp, $uploaddir . stripslashes($filename))) {
				 chmod("$uploaddir$filename", 0644);
				 $filename = stripslashes($filename);
 		 
		 }

		$filename = addslashes($filename);
		$filetype = addslashes($filetype);
						
		//-----------------------------------//
		//      Load files to database       //
		//-----------------------------------//
		  
		// If this is a new files...
		if (!$files_id) {
						
			$doquery = db_query("INSERT INTO files (id,
											  filename,
											  filesize,
											  filetype,
											  fileuploaded,
											  created_on)
									 VALUES ('$new_files_id',
											 '$filename',
											 '$filesize',
											 '$filetype',
											 '1',
											 now())")
									  or die(mysql_error()."Couldn't insert data.");
		
			if ($doquery == 1) {
				return $new_files_id;
			}
		} else {
			if ($fileuploaded == "1" && $old_filename != $filename) {
				// Delete Old files File from Server       
				$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files";
				$oldfile = $uploaddir . "/" . $old_filename;
				if (file_exists("$oldfile")) { 
					if (!unlink("$oldfile")) {
						// if an error occurs the file could not
						// be written, read or possibly does not exist
						print "Error Deleting File.";
						exit();
					}
				}
			}
/*						
			$update_new_files = db_query("update files set filename='$filename',
															filesize='$filesize',
															created_on=now()
													  where id=$files_id")
													 or die (mysql_error());
*/
			return array($filename, $filesize, $filetype, '1');
		}
	}
}

function files_insertnewrow($id) {
	$doquery = db_query("INSERT INTO files (id,
								  created_on)
					 VALUES ('$id',
							 now())")
					  or die(mysql_error()."Couldn't insert data.");
}

function files_edit($id, $title, $filename, $filetype, $filesize, $fileuploaded, $image_id, $caption, $copyright, $description, $category, $owner) {
	global $_SERVER['DOCUMENT_ROOT'], $cur_module;
	
	if ($filename) {
		$fileuploaded = 1;
		$file_loc = $_SERVER['DOCUMENT_ROOT']."/files/$filename";
		$filetype = mime_content_type($file_loc);
		$filesize = filesize($file_loc);
	}

	$insert_new_files = db_query("update files set title='$title',
													filename='$filename',
													filetype='$filetype',
													filesize='$filesize',
													fileuploaded='$fileuploaded',
													image_id='$image_id',
													caption='$caption',
													copyright='$copyright',
  												    description='$description',
													category='$category',
													owner='$owner',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_files) {
		return $cur_module[0][item]." successfully edited.";
	} else {
		return "Error with files upload.";
	}
}

function files_caption($files_id) {
    $files_size_query = db_query("select caption
                                    from files
                                   where id = $files_id")
                                   or die (mysql_error());
   list($caption) = db_fetch_array($files_size_query);
   return $caption;
}

function files_delete($files_id, $filename, $fileuploaded, $del_file) {
   global $_SERVER['DOCUMENT_ROOT'], $cur_module;
   
   // Check and see if the files exists.
    if ($files_id != "") {
       $result = db_query("select id, filename filetype
                             from files
                            where id=$files_id")
                           or die("files check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       } else {
	   	list($id, $filename, $filetype) = db_fetch_array($result);
	   }


		if ($fileuploaded == "1" && $del_file) {
	
		   // Delete files File from Server       
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/files";
			$newfile = $uploaddir . "/" . $filename;
			//print_r($filename);
			if (file_exists("$newfile")) { 
				if (!unlink("$newfile")) {
						// if an error occurs the file could not
						// be written, read or possibly does not exist
						print "Error Deleting File.";
						exit();
				}
			}
		}
	   // If not, delete files from table.
	   $sql = "DELETE FROM files
                     WHERE id=$files_id
                     LIMIT 1";
       $result = db_query($sql) or die ("files delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

function insert_get_files($vars) {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$dirloc = $_SERVER['DOCUMENT_ROOT']."/files/";
	$directory = opendir($dirloc);
	// ------------------------------------------------------------------------------------//
	// Make array of all files in /pages directory
	$filelist = array();
	echo "<select name=filename id=filename>";
    if ($vars['cur_file']) {
		echo "<option value=\"".$vars['cur_file']."\">".$vars['cur_file']."</option>";
	} else {
		echo "<option value=\"\"> </option>";
	}
	        
	echo "<option value=\"\">---------------</option>";
			
	while (false !== ($file = readdir($directory))) {
		$file_ext = substr($file,strpos($file,".")+1);
		if ($file_ext != "" && $file_ext != ".") {
			array_push($filelist, $file);
			$i++;
		}
	}
	sort($filelist);
	foreach($filelist as $file) {
		echo "<option value=\"$file\">$file</option>\n";	
	}
	echo "</select>";
}
?>