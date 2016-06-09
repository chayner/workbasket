<? // albums Module

function get_new_id() {
	  // get new track id
	  $track_id_query = db_query("update album_tracks_seq set id=LAST_INSERT_ID(id+1)")
			  or die (mysql_error());
	
	  $new_track_id_query = db_query("select LAST_INSERT_ID() from album_tracks_seq")
			  or die (mysql_error());
	
	  if ($new_track_id_array = db_fetch_array($new_track_id_query)) {
		// set $new_track_id variable to the most recent id
		return $new_track_id_array[0];
	  }
}

function album_upload($source_file, $album_id = "") {
	global $_SERVER['DOCUMENT_ROOT'], $img_resize_height, $img_resize_width, $img_thumb_resize_width, $img_thumb_resize_height;
	
	//-----------------------//
	// get album information //
	//-----------------------//
	
	// get width and height
	$size = GetImageSize ("$source_file");
	$width = $size[0];
	$height = $size[1];
	//echo "Width: $width, Height: $height";
	
	// get file type: only gif and jpg allowed.
	if ($size[2] == 1) {
	  $type = "gif";
	  $valid_album = 0;
	} elseif ($size[2] == 2) {
	  $type = "jpg";
	  $valid_album = 1;
	} else {
	  $valid_album = 0;
	}
	
	if ($valid_album == 1) {  // process album if it is a valid graphic file format
	
		if (!$album_id) {
			// set $new_album_id variable to the most recent id
			$new_album_id = get_new_album_id();
		} else {
			$new_album_id = $album_id;
		}
	
	  // Determine the large size of album desired
	
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
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/album_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "album_".$new_album_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
			Imagejpeg($dst_img, $newfile, 95);
	
			// Create Thumbnail JPEG with new dimensions
			$src_img = imagecreatefromjpeg($source_file);
			$dst_img = imagecreatetruecolor($thumb_width, $thumb_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/album_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "album_".$new_album_id."_thumb.jpg";
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
			//      Load album to database       //
			//-----------------------------------//
	  
	  		// If this is a new album...
	  		if (!$album_id) {
	  				
				$doquery = db_query("INSERT INTO albums (id,
												  created_on)
										 VALUES ('$new_album_id',
												 now())")
										  or die(mysql_error()."Couldn't insert data.");
		
				// clean up
				ImageDestroy($src_img);
				ImageDestroy($dst_img);
				
				if ($doquery == 1) {
					return $new_album_id;
				}
			} else {
				$update_new_image = db_query("update albums set created_on=now()
														  where id=$album_id")
														 or die (mysql_error());
				return $new_album_id;
			}
			

		}
}

function get_new_album_id() {
 // get new album id
			  $album_id_query = db_query("update albums_seq set id=LAST_INSERT_ID(id+1)")
					  or die (mysql_error());
			
			  $new_album_id_query = db_query("select LAST_INSERT_ID() from albums_seq")
					  or die (mysql_error());
			
			  if ($new_album_id_array = db_fetch_array($new_album_id_query)) {
				// set $new_album_id variable to the most recent id
				$new_album_id = $new_album_id_array[0];
			  }
	return $new_album_id;
}


function add_blank_album($album_id = "") {
	global $_SERVER['DOCUMENT_ROOT'];

	if (!$album_id) {
			// set $new_album_id variable to the most recent id
			$new_album_id = get_new_album_id();
		} else {
			$new_album_id = $album_id;
		}
	
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/album_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "album_".$new_album_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
				
	// save thumb as a file
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/album_temp.jpg";
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
	$final_filename = "album_".$new_album_id."_thumb.jpg";
	$newfile = $uploaddir . "/" . $final_filename;
	if (!copy($tempfile, $newfile)) 
		{
			// if an error occurs the file could not
			// be written, read or possibly does not exist
			print "Error Uploading File.";
			exit();
		}
		
	if (!$album_id) {
	$doquery = db_query("INSERT INTO albums (id, created_on)
									 VALUES ('$new_album_id', now())")
									  or die(mysql_error()."Couldn't insert data.");
	
	}
	return $new_album_id;
}

function album_edit($id, $title, $artist, $release_date, $label, $comment, $copyright, $merch_id, $streetteam_p, $category, $owner, $author) {
 	global $cur_module;
   // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
		
       $sql = "update albums set title='$title',
                               artist='$artist',
							   release_date='$release_date',
							   label='$label',
							   comment='$comment',
							   copyright='$copyright',
							   category='$category',
							   merch_id='$merch_id',
							   streetteam_p='$streetteam_p',
							   owner='$owner',
							   created_on=now(),
							   created_by=$author
                         where id=$id";
       $result = db_query($sql) or die ("album modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function album_delete($id) {
 	global $cur_module;
   // Check and see if the album item exists.
    if ($id != "") {
       $result = db_query("select id
                             from albums
                            where id=$id")
                           or die("album check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete album item from table.
       $sql = "DELETE FROM albums
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("album delete error: ". mysql_error());
       
	   // Delete tracks associated with the album.
	   $rem_tracks = db_query("delete from album_tracks where album = $id") or die ("album tracks delete error: ". mysql_error());
	   if ($result == 1 && $rem_tracks == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}


function track_upload($HTTP_POST_FILES, $track_id = "", $fileuploaded="0", $old_filename="") {
	
	global $_SERVER['DOCUMENT_ROOT'], $HTTP_POST_FILES;
	
	//-----------------------//
	// get track information //
	//-----------------------//
	
	// get information about the file
	$fileinfo = $HTTP_POST_FILES['uploadfile'];
	$filesize = $fileinfo['size'];
	$filename = $fileinfo['name'];
	$filetype = $fileinfo['type'];
	$filetemp = $fileinfo['tmp_name'];
	

	// Find if item already has a track_id assigned to it.
	if (!$track_id) {
		$new_track_id = get_new_id();
	} else {
		$new_track_id = $track_id;
	}

	if ($filesize > 0) {  // process track if it is a valid file
	
		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/tracks/";

		// Copy file to correct directory
		if (move_uploaded_file($filetemp, $uploaddir . stripslashes($filename))) {
				 $filename = stripslashes($filename);
			// If file is an MP3, create a playlist
			 if ($filetype == "audio/mpeg") {
				 $tempplaylist = $_SERVER['DOCUMENT_ROOT']."/tracks/temp.m3u";
				 $final_filename = $new_track_id.".m3u";
				 $newplaylist = $uploaddir . $final_filename;
				 if (!copy($tempplaylist, $newplaylist)) {
					 print ("Failed to copy $new_file...<br>\n");
				 }
				 $somecontent = "#EXTM3U\r\n#EXTINF:$filename\r\n$siteroot/tracks/$filename";
		
				 $handle = fopen($newplaylist, 'a'); 
				 fwrite($handle, $somecontent); 
				 fclose($handle);
			} elseif ($filetype == "application/vnd.rn-realtrack") {
				 $tempplaylist = $_SERVER['DOCUMENT_ROOT']."/tracks/temp.m3u";
				 $final_filename = $new_track_id.".ram";
				 $newplaylist = $uploaddir . $final_filename;
				 if (!copy($tempplaylist, $newplaylist)) {
					 print ("Failed to copy $new_file...<br>\n");
				 }
				 $somecontent = "$uploaddir$filename";
		
				 $handle = fopen($newplaylist, 'a'); 
				 fwrite($handle, $somecontent); 
				 fclose($handle);
			}		 
   		 }

		$filename = addslashes($filename);
		$filetype = addslashes($filetype);
						
		//-----------------------------------//
		//      Load track to database       //
		//-----------------------------------//
		  
		// If this is a new track...
		if ($fileuploaded == "1" && $old_filename != $filename) {
				// Delete Old track File from Server       
				$uploaddir = $_SERVER['DOCUMENT_ROOT']."/tracks";
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

			return array($filename, $filesize, $filetype, '1');
	}
}

function track_add($id) {
	$insert_new_track = db_query("insert into album_tracks (id) VALUES ($id)");
	return $insert_new_track;
}

function track_edit($id, $title, $album, $track, $fileuploaded, $filetype, $filename, $filesize, $artist, $words, $music, $description, $lyrics, $copyright, $download_p, $owner) {
	global $_SERVER['DOCUMENT_ROOT'], $cur_module;
	
	if ($filename) {
		$fileuploaded = 1;
		$file_loc = $_SERVER['DOCUMENT_ROOT']."/tracks/$filename";
		$filetype = mime_content_type($file_loc);
		$filesize = filesize($file_loc);
	}
	$insert_new_track = db_query("update album_tracks set title='$title',
													filename='$filename',
													filetype='$filetype',
													album='$album',
													track='$track',
													filesize='$filesize',
													fileuploaded='$fileuploaded',
													artist='$artist',
													words='$words',
													music='$music',		
													description='$description',
													lyrics='$lyrics',
													copyright='$copyright',
													download_p='$download_p',
													owner='$owner',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_track) {
		return "track successfully edited.";
	} else {
		return "Error with track upload.";
	}
}

function track_delete($id) {
 	global $cur_module;
   // Check and see if the album item exists.
    if ($id != "") {
       $result = db_query("select id
                             from album_tracks
                            where id=$id")
                           or die("track check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "track does not exists.";
       }

       // If not, delete album item from table.
       $sql = "DELETE FROM album_tracks
	                 WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("track delete error: ". mysql_error());
       
	   if ($result == 1) {
           $result = "track succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing track.";
    }
}

function insert_get_tracks($vars) {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$dirloc = $_SERVER['DOCUMENT_ROOT']."/tracks/";
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