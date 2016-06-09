<? // merchandise Module

function store_settings($paypalemail, $storeaddress, $shipfirst, $shipusa, $shipint) {

     	$sql = db_query("update config set 
								paypal_email='$paypalemail',
								store_address='$storeaddress',
								ship_first='$shipfirst',
								ship_usa='$shipusa',
								ship_int='$shipint'") or die ("Module modify error: ". mysql_error());
       if ($sql == 1) {
           $result = "Store settings successfully updated.";
       } else {
	   	$result = "there was some problem.";
		}
       return $result;
	   
}

function insert_custInformation($cust) {
	custInformation($cust[cust_id]);
}

function custInformation($cust_id) {
	global $smarty;
	$cust_info = sql_query("select * from customers where id = $cust_id");
	$smarty->assign('cust', $cust_info);
}
	
	
function insert_orderInformation($order) {
	orderInformation($order[order_id]);
}

function orderInformation($order_id) {
	global $smarty;
	$order_info = sql_query("select * from store_orders as o, merchandise as m where o.order_id = $order_id and o.item_id = m.id");
	$smarty->assign('order_info', $order_info);
}


function insert_couponInformation($order) {
	couponInformation($order[order_id]);
}

function couponInformation($order_id) {
	global $smarty;
	$coupon_info = sql_query("select * from store_coupons as c, store_orders as o where o.order_id = $order_id and o.coupon = c.id");
	$smarty->assign('coupon_info', $coupon_info);
}
	
function insert_merchandiseCategory($id) {
	return category_name($id[id], $modid[modid]);
}


function merchandise_upload($source_file, $source_filename, $merchandise_id = "") {
	global $_SERVER['DOCUMENT_ROOT'], $img_resize_height, $img_resize_width, $img_thumb_resize_width, $img_thumb_resize_height;
	
	//-----------------------//
	// get merchandise information //
	//-----------------------//
	
	// get width and height
	$size = GetImageSize ("$source_file");
	$width = $size[0];
	$height = $size[1];
	//echo "Width: $width, Height: $height";
	
	// get file type: only gif and jpg allowed.
	if ($size[2] == 1) {
	  $type = "gif";
	  $valid_merchandise = 0;
	} elseif ($size[2] == 2) {
	  $type = "jpg";
	  $valid_merchandise = 1;
	} else {
	  $valid_merchandise = 0;
	}
	
	if ($valid_merchandise == 1) {  // process merchandise if it is a valid graphic file format
	
		if (!$merchandise_id) {
			// set $new_merchandise_id variable to the most recent id
			$new_merchandise_id = get_new_merchandise_id();
		} else {
			$new_merchandise_id = $merchandise_id;
		}
	
	
	  // Determine the large size of merchandise desired
	
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
			$src_img = ImageCreateFromJPEG($source_file);
			$dst_img = imagecreatetruecolor($new_width, $new_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "merch_".$new_merchandise_id.".jpg";
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
			$src_img = ImageCreateFromJPEG($source_file);
			$dst_img = ImageCreateTrueColor($thumb_width, $thumb_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "merch_".$new_merchandise_id."_thumb.jpg";
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
			//      Load merchandise to database       //
			//-----------------------------------//
	  
	  		// If this is a new merchandise...
	  		if (!$merchandise_id) {
	  				
				//$source_merchandise = addslashes(fread(fopen("source.jpg", "r"), filesize("source.jpg")));
				//$thumb_merchandise = addslashes(fread(fopen("thumb.jpg", "r"), filesize("thumb.jpg")));
				$doquery = db_query("INSERT INTO merchandise (id,
												  filename,
												  filesize,
												  filetype,
												  width,
												  height,
												  category,
												  created_on)
										 VALUES ('$new_merchandise_id',
												 '$source_file_name',
												 '$source_file_size',
												 '$source_file_type',
												 '$new_width',
												 '$new_height',
												 '$category',
												 now())")
										  or die(mysql_error()."Couldn't insert data.");
		
				// clean up
				ImageDestroy($src_img);
				ImageDestroy($dst_img);
				
				if ($doquery == 1) {
					return $new_merchandise_id;
				}
			} else {
				$update_new_image = db_query("update merchandise set  filesize='$source_file_size',
																filetype='$source_file_type',
																filename='$source_file_name',
																width='$new_width',
																height='$new_height',
																category='$category',
																created_on=now()
														  where id=$merchandise_id")
														 or die (mysql_error());
			}
		}
}

function add_blank_merchandise($merchandise_id = "") {
	global $_SERVER['DOCUMENT_ROOT'];

	if (!$merchandise_id) {
			// set $new_merchandise_id variable to the most recent id
			$new_merchandise_id = get_new_merchandise_id();
		} else {
			$new_merchandise_id = $merchandise_id;
		}
	
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "merch_".$new_merchandise_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
				
	// save thumb as a file
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
	$final_filename = "merch_".$new_merchandise_id."_thumb.jpg";
	$newfile = $uploaddir . "/" . $final_filename;
	if (!copy($tempfile, $newfile)) 
		{
			// if an error occurs the file could not
			// be written, read or possibly does not exist
			print "Error Uploading File.";
			exit();
		}
		
	if (!$merchandise_id) {
	$doquery = db_query("INSERT INTO merchandise (id,
											  filename,
											  filesize,
											  filetype,
											  width,
											  height,
											  category,
											  created_on)
									 VALUES ('$new_merchandise_id',
											 '$source_file_name',
											 '$source_file_size',
											 '$source_file_type',
											 '$new_width',
											 '$new_height',
											 '$category',
											 now())")
									  or die(mysql_error()."Couldn't insert data.");
	
	}
	return $new_merchandise_id;
}

function merchandise_edit($id, $name, $subname, $description, $lprice, $sprice, $noship, $copyright, $sizes_p, $size_small, $size_medium, $size_large, $size_xlarge, $size_xxlarge, $size_xxxlarge, $category, $section_s) {
	global $cur_module;
	$insert_new_merchandise = db_query("update merchandise set name='$name', 
													subname='$subname',
													description='$description', 
													lprice='$lprice', 
													sprice='$sprice', 
													copyright='$copyright',
													owner='$owner',
													noship='$noship',
													sizes_p = '$sizes_p', 
													size_small = '$size_small', 
													size_medium = '$size_medium', 
													size_large = '$size_large', 
													size_xlarge = '$size_xlarge', 
													size_xxlarge = '$size_xxlarge', 
													size_xxxlarge = '$size_xxxlarge', 
													category='$category',
													created_on=now()
											  where id=$id")
											 or die (mysql_error());
	
	if ($insert_new_merchandise) {
		return $cur_module[0][item]." successfully edited.";
	} else {
		return "Error with image upload.";
	}
}

function get_new_merchandise_id() {
 // get new merchandise id
			  $merchandise_id_query = db_query("update merchandise_seq set id=LAST_INSERT_ID(id+1)")
					  or die (mysql_error());
			
			  $new_merchandise_id_query = db_query("select LAST_INSERT_ID() from merchandise_seq")
					  or die (mysql_error());
			
			  if ($new_merchandise_id_array = db_fetch_array($new_merchandise_id_query)) {
				// set $new_merchandise_id variable to the most recent id
				$new_merchandise_id = $new_merchandise_id_array[0];
			  }
	return $new_merchandise_id;
}

function show_merchandise($merchandise_id) {
    echo "<img src=/merchandise/".$merchandise_id.".jpg>";
}

function show_thumb($merchandise_id) {
    echo "<img src=/merchandise/".$merchandise_id."_thumb.jpg>";
}

function merchandise_size($merchandise_id) {
    $merchandise_size_query = db_query("select width,
                                         height
                                    from merchandise
                                   where id = $merchandise_id")
                                   or die (mysql_error());
   list($width,$height) = db_fetch_array($merchandise_size_query);
   return "($width x $height)";
}

function merchandise_caption($merchandise_id) {
    $merchandise_size_query = db_query("select description
                                    from merchandise
                                   where id = $merchandise_id")
                                   or die (mysql_error());
   list($caption) = db_fetch_array($merchandise_size_query);
   return $caption;
}

function merchandise_delete($merchandise_id) {
   global $_SERVER['DOCUMENT_ROOT'],$cur_module;
   
   // Check and see if the merchandise exists.
    if ($merchandise_id != "") {
       $result = db_query("select id
                             from merchandise
                            where id=$merchandise_id")
                           or die("merchandise check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

	   // Delete File from Server       
		$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
   		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
		$final_filename = "merch_".$merchandise_id."_thumb.jpg";
		$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}	   // Delete File from Server       
		$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/merch_temp.jpg";
   		$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
		$final_filename = "merch_".$merchandise_id.".jpg";
		$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}
	   // If not, delete merchandise from table.
	   $sql = "DELETE FROM merchandise
                     WHERE id=$merchandise_id
                     LIMIT 1";
       $result = db_query($sql) or die ("merchandise delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

?>