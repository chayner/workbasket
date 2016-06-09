<? // media Module
function get_new_id() {
	  // get new media id
	  $media_id_query = db_query("update media_seq set id=LAST_INSERT_ID(id+1)")
			  or die (mysql_error());
	
	  $new_media_id_query = db_query("select LAST_INSERT_ID() from media_seq")
			  or die (mysql_error());
	
	  if ($new_media_id_array = db_fetch_array($new_media_id_query)) {
		// set $new_media_id variable to the most recent id
		return $new_media_id_array[0];
	  }
}

function media_exists($filename) {
	$filename = stripslashes($filename);
	$file_query = sql_query("select * from media where filename = '$filename'");
	
	if ($file_query) {
		return $file_query[0].id;
	} else {
		return false;
	}
}

function media_upload($HTTP_POST_FILES, $media_id = "", $fileuploaded="0", $old_filename="") {
	
	global $_SERVER['DOCUMENT_ROOT'], $HTTP_POST_FILES, $siteroot, $getID3;
	
	//-----------------------//
	// get media information //
	//-----------------------//
	
	// get information about the file
	$fileinfo = $HTTP_POST_FILES['uploadfile'];
	$filesize = $fileinfo['size'];
	$filename = $fileinfo['name'];
	$filetype = $fileinfo['type'];
	$filetemp = $fileinfo['tmp_name'];
	
	// Find if item already has a media_id assigned to it.
	if (!$media_id) {
		$new_media_id = get_new_id();
	} else {
		$new_media_id = $media_id;
	}

	if ($filesize > 0) {  // process media if it is a valid file
		$filename = stripslashes($filename);
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/media/";

		if (file_exists("$uploaddir$filename") && $new_media_id != media_exists($filename)) {
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
		//      Load media to database       //
		//-----------------------------------//
		  
		// If this is a new media...
		if (!$media_id) {
			
			if ($filetype == ("audio/x-mpeg" || "audio/mpeg")) {
				$filepath = "$uploaddir$filename";
			
				$id3info = $getID3->analyze($filepath);
				
				$author = $id3info['id3v1']['artist'];
				$title = $id3info['id3v1']['title'];
				$copyright = $id3info['id3v1']['year'];
			}
			
			$doquery = db_query("INSERT INTO media (id,
											  author,
											  title,
											  copyright,
											  filename,
											  filesize,
											  filetype,
											  fileuploaded,
											  created_on)
									 VALUES ('$new_media_id',
									 		  '$author',
											  '$title',
											  '$copyright',
											 '$filename',
											 '$filesize',
											 '$filetype',
											 '1',
											 now())")
									  or die(mysql_error()."Couldn't insert data.");
		
			if ($doquery == 1) {
				return $new_media_id;
			}
		} else {
			
			if ($fileuploaded == "1" && $old_filename != $filename) {
				// Delete Old Media File from Server       
				$uploaddir = $_SERVER['DOCUMENT_ROOT']."/media";
				$oldfile = $uploaddir . "/" . $old_filename;
				//print_r($filename);
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
			$update_new_media = db_query("update media set filename='$filename',
															filesize='$filesize',
															created_on=now()
													  where id=$media_id")
													 or die (mysql_error());
*/
			return array($filename, $filesize, $filetype, '1');
		}
	}
}

function media_insertnewrow($id) {
	$doquery = db_query("INSERT INTO media (id,
								  created_on)
					 VALUES ('$id',
							 now())")
					  or die(mysql_error()."Couldn't insert data.");
}

function media_edit($id, $author, $title, $filename, $filetype, $fileuploaded, $image_id, $caption, $copyright, $description, $category, $owner) {
	global $_SERVER['DOCUMENT_ROOT'], $getID3, $cur_module;
	
	if ($filename) {
		$filepath = $_SERVER['DOCUMENT_ROOT']."/media/".$filename;
		
		$fileinfo = $getID3->analyze($filepath);
		$filetype = $fileinfo['mime_type'];
		$filesize = $fileinfo['filesize'];
		$width = $fileinfo['video']['resolution_x'];
		$height = $fileinfo['video']['resolution_y'];
		$length = $fileinfo['playtime_string'];
		$bitrate = $fileinfo['bitrate'];
		
		/*
		echo "<pre>";
		print_r($fileinfo);
		echo "</pre>";
		*/
		
		$fileuploaded = 1;
	}
	
	$insert_new_media = db_query("update media set author='$author',
													title='$title',
													filename='$filename',
													filetype='$filetype',
													filesize='$filesize',
													width='$width',
													height='$height',
													length='$length',
													bitrate='$bitrate',
													fileuploaded='$fileuploaded',
													copyright='$copyright',
  												    description='$description',
													image_id='$image_id',
													caption='$caption',
													category='$category',
													owner='$owner',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_media) {
		return $cur_module[0][item]." successfully edited.";
	} else {
		return "Error with media upload.";
	}
}

function media_caption($media_id) {
    $media_size_query = db_query("select caption
                                    from media
                                   where id = $media_id")
                                   or die (mysql_error());
   list($caption) = db_fetch_array($media_size_query);
   return $caption;
}

function media_delete($media_id, $filename, $fileuploaded) {
   global $_SERVER['DOCUMENT_ROOT'], $cur_module;
   
   // Check and see if the media exists.
    if ($media_id != "") {
       $result = db_query("select id, filename filetype
                             from media
                            where id=$media_id")
                           or die("media check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       } else {
	   	list($id, $filename, $filetype) = db_fetch_array($result);
	   }


		if ($fileuploaded == "1") {
		   // Delete Playlist from Server if File is an MP3
			if ($filetype == "audio/mpeg") {      
				$tempfile = $_SERVER['DOCUMENT_ROOT']."/media/temp.m3u";
				$uploaddir = $_SERVER['DOCUMENT_ROOT']."/media";
				$final_filename = $media_id.".m3u";
				$newfile = $uploaddir . "/" . $final_filename;
				if (file_exists("$newfile")) {
					if (!unlink("$newfile")) {
							// if an error occurs the file could not
							// be written, read or possibly does not exist
							print "Error Deleting File.";
							exit();
					}
				}
			}
						
		   // Delete Media File from Server       
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/media";
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
	   // If not, delete media from table.
	   $sql = "DELETE FROM media
                     WHERE id=$media_id
                     LIMIT 1";
       $result = db_query($sql) or die ("media delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

function insert_get_media($vars) {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$dirloc = $_SERVER['DOCUMENT_ROOT']."/media/";
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