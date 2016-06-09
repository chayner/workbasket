<? // Photo Module

function create_thumb($source_file, $new_photo_id) {
			global $_SERVER['DOCUMENT_ROOT'], $photo_thumb_resize;
			
			$size = getimagesize($source_file);
			if ($size) {
				$width = $size[0];
				$height = $size[1];
			} else {
				exit;
			}
			if ($width > $height) {
				$size = $height;
			} else {
				$size = $width;
			}
			$x = ($width - $size) / 2;
			$y = ($height - $size) / 2;
			
			// Create Thumbnail JPEG with new dimensions
			$src_img = imagecreatefromjpeg($source_file);
			$dst_img = imagecreatetruecolor($photo_thumb_resize, $photo_thumb_resize);
			imagecopyresampled($dst_img, $src_img, 0, 0, round($x,0), round($y,0), $photo_thumb_resize, $photo_thumb_resize, $size, $size);

			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/thumbs";
			$final_filename = $new_photo_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!imagejpeg($dst_img, $newfile, 95)) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
			} else {
				imagedestroy($src_img);
				imagedestroy($dst_img);
				return true;
			}			
}

function photo_upload($source_file, $source_filename, $photo_id = "", $category = "", $caption = "", $owner = "") {
	global $_SERVER['DOCUMENT_ROOT'], $photo_resize_height, $photo_resize_width, $photo_thumb_resize;
	
	//-----------------------//
	// get photo information //
	//-----------------------//
	
	// get width and height
	if ($source_file)
	{
	  $size = GetImageSize ("$source_file");
  	$width = $size[0];
  	$height = $size[1]; 
  	//echo "Width: $width, Height: $height";
	
  	// get file type: only gif and jpg allowed.
  	if ($size[2] == 1) {
  	  $type = "gif";
  	  $valid_photo = 0;
  	} elseif ($size[2] == 2) {
  	  $type = "jpg";
  	  $valid_photo = 1;
  	} else {
  	  $valid_photo = 0;
  	}
	}
		
	if ($valid_photo == 1) {  // process photo if it is a valid graphic file format
	
		if (!$photo_id) {
			  // get new photo id
			  $photo_id_query = db_query("update photos_seq set id=LAST_INSERT_ID(id+1)")
					  or die ("Photo ID: ".mysql_error());
			
			  $new_photo_id_query = db_query("select LAST_INSERT_ID() from photos_seq")
					  or die ("Photo ID: ".mysql_error());
			
			  if ($new_photo_id_array = db_fetch_array($new_photo_id_query)) {
				// set $new_photo_id variable to the most recent id
				$new_photo_id = $new_photo_id_array[0];
			  }
		} else {
			$new_photo_id = $photo_id;
		}
	
	
	  // Determine the large size of photo desired
	
		 $shrink_width = $photo_resize_width;
		 $shrink_height = $photo_resize_height;
	 
		if ($width > $height) {
			if (getNewHeight($shrink_width,$width,$height) < $shrink_height && $width >= $shrink_width) {
				//echo "1";
				$new_width = $shrink_width;
				$new_height = getNewHeight($shrink_width,$width,$height);	
			} elseif ($height <= $shrink_height) {
				//echo "2";			
				$new_width = $width;
				$new_height = $height;
			} else {
				//echo "3";			
				$new_height = $shrink_height;
				$new_width = getNewWidth($shrink_height,$width,$height);
			}
		} else {
			if (getNewWidth($shrink_height,$width,$height) < $shrink_width && $height >= $shrink_height) {
				$new_height = $shrink_height;
				$new_width = getNewWidth($shrink_height,$width,$height);	
			} elseif ($height <= $shrink_height) {
				$new_width = $width;
				$new_height = $height;
			} else {
				$new_width = $shrink_width;
				$new_height = getNewHeight($shrink_width,$width,$height);
			}
		}
	 
			// Create Main JPEG with new dimensions
			$src_img = ImageCreateFromJPEG($source_file);
			$dst_img = imagecreatetruecolor($new_width, $new_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = $new_photo_id.".jpg";
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
	
			$create_thumb = create_thumb($source_file, $new_photo_id);
	
	
			//-----------------------------------//
			//      Load photo to database       //
			//-----------------------------------//
	  
	  		// If this is a new photo...
	  		if (!$photo_id) {
				$source_filename = addslashes($source_filename);
	  			$caption = addslashes($caption);
				//$source_photo = addslashes(fread(fopen("source.jpg", "r"), filesize("source.jpg")));
				//$thumb_photo = addslashes(fread(fopen("thumb.jpg", "r"), filesize("thumb.jpg")));
				$doquery = db_query("INSERT INTO photos (id,
												  filename,
												  filesize,
												  filetype,
												  width,
												  height,
												  caption,
												  category,
												  owner,
												  created_on)
										 VALUES ('$new_photo_id',
												 '$source_filename',
												 '$size',
												 '$type',
												 '$new_width',
												 '$new_height',
												 '$caption',
												 '$category',
												 '$owner',
												 now())")
										  or die("Photo Insert: ".mysql_error()."Couldn't insert data.");
		
				if ($doquery == 1) {
					return $new_photo_id;
				}
			} else {
				$update_new_image = db_query("update photos set  filesize='$size',
																filetype='$type',
																filename='$source_filename',
																caption='$caption',
																width='$new_width',
																height='$new_height',
																category='$category',
																created_on=now()
														  where id=$photo_id")
														 or die ("Photo Insert: ".mysql_error());
			}
		}
}

function photo_edit($id, $copyright, $author, $caption, $category, $owner) {
	global $cur_module;
	$insert_new_photo = db_query("update photos set copyright='$copyright',
  												    author='$author',		
													caption='$caption',
													category='$category',
													owner='$owner',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_photo) {
		return $cur_module[0][item]." successfully edited.";
	} else {
		return "Error with image upload.";
	}
}

function show_photo($photo_id) {
    echo "<img src=/photos/".$photo_id.".jpg>";
}

function show_thumb($photo_id) {
    echo "<img src=/photos/".$photo_id."_thumb.jpg>";
}

function photo_size($photo_id) {
    $photo_size_query = db_query("select width,
                                         height
                                    from photos
                                   where id = $photo_id")
                                   or die (mysql_error());
   list($width,$height) = db_fetch_array($photo_size_query);
   return "($width x $height)";
}

function photo_caption($photo_id) {
    $photo_size_query = db_query("select caption
                                    from photos
                                   where id = $photo_id")
                                   or die (mysql_error());
   list($caption) = db_fetch_array($photo_size_query);
   return $caption;
}

function photo_delete($photo_id) {
   global $_SERVER['DOCUMENT_ROOT'],$cur_module;
   
   // Check and see if the photo exists.
    if ($photo_id != "") {
       $result = db_query("select id
                             from photos
                            where id=$photo_id")
                           or die("Photo check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

	   // Delete File from Server       
		$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
   		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
		$final_filename = $photo_id."_thumb.jpg";
		$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}
	   // Delete File from Server       
		$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
   		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
		$final_filename = $photo_id.".jpg";
		$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}
	   // If not, delete photo from table.
	   $sql = "DELETE FROM photos
                     WHERE id=$photo_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Photo delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

function photo_import($category, $owner, $caption_p) {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$dirloc = $_SERVER['DOCUMENT_ROOT']."/toimport/";
	$directory = opendir($dirloc);
	if ($directory) echo "<p>Opening $dirloc</p>";
	
	$i = 0;
	/* This is the correct way to loop over the directory. */
	while (false !== ($file = readdir($directory))) { 
	   if ($file{0} != ".") {
			$fullfile = $dirloc.$file;
			echo "<p>Processing \"$file\"...  ";
			
			if ($caption_p) {
				$caption = substr($file,0,strrpos($file,"."));
			}
			
			$upload = photo_upload($fullfile, $file, "", $category, $caption, $owner);
			if ($upload > 0) {
				echo "Completed.<br>";
				if (unlink($fullfile)) {
					$my_data = "$file is deleted from temp directory.";
				} else {
					$my_data = "$file cannot be deleted from temp directory, contact the system administrator.";
				}
			echo "$my_data</p>";
			$i++;	
			}
		}

	}
	return $i;
}

function photo_change_order($id, $direction) {
	#work on this.


}

?>