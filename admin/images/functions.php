<? // image Module


function image_edit($id, $copyright, $author, $caption, $category, $owner) {
	global $cur_module;
	$insert_new_image = db_query("update images set copyright='$copyright',
  												    author='$author',		
													caption='$caption',
													category='$category',
													owner='$owner',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_image) {
		return $cur_module[0][item]." successfully edited.";
	} else {
		return "Error with image upload.";
	}
}

function show_image($image_id) {
    echo "<img src=/images/".$image_id.".jpg>";
}

function show_thumb($image_id) {
    echo "<img src=/images/".$image_id."_thumb.jpg>";
}

function image_size($image_id) {
    $image_size_query = db_query("select width,
                                         height
                                    from images
                                   where id = $image_id")
                                   or die (mysql_error());
   list($width,$height) = db_fetch_array($image_size_query);
   return "($width x $height)";
}

function image_caption($image_id) {
    $image_size_query = db_query("select caption
                                    from images
                                   where id = $image_id")
                                   or die (mysql_error());
   list($caption) = db_fetch_array($image_size_query);
   return $caption;
}

function image_delete($image_id) {
   global $_SERVER['DOCUMENT_ROOT'],$cur_module;
   
   // Check and see if the image exists.
    if ($image_id != "") {
       $result = db_query("select id
                             from images
                            where id=$image_id")
                           or die("image check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

	   // Delete File from Server       
		$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
   		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
		$final_filename = "image_".$image_id."_thumb.jpg";
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
		$final_filename = "image_".$image_id.".jpg";
		$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}

	   // If not, delete image from table.
	   $sql = "DELETE FROM images
                     WHERE id=$image_id
                     LIMIT 1";
       $result = db_query($sql) or die ("image delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

?>