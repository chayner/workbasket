<? // section Module

function section_upload($source_file, $section_id = "") {
	global $_SERVER['DOCUMENT_ROOT'], $img_resize_height, $img_resize_width, $img_thumb_resize_width, $img_thumb_resize_height;
	
	//-----------------------//
	// get section information //
	//-----------------------//
	
	// get width and height
	$size = GetImageSize ("$source_file");
	$width = $size[0];
	$height = $size[1];
	//echo "Width: $width, Height: $height";
	
	// get file type: only gif and jpg allowed.
	if ($size[2] == 1) {
	  $type = "gif";
	  $valid_section = 0;
	} elseif ($size[2] == 2) {
	  $type = "jpg";
	  $valid_section = 1;
	} else {
	  $valid_section = 0;
	}
	
	if ($valid_section == 1) {  // process section if it is a valid graphic file format
	
		if (!$section_id) {
			// set $new_section_id variable to the most recent id
			$new_section_id = get_new_section_id();
		} else {
			$new_section_id = $section_id;
		}
	
	  // Determine the large size of section desired
	
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
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/section_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "section_".$new_section_id.".jpg";
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
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/section_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "section_".$new_section_id."_thumb.jpg";
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
			//      Load section to database       //
			//-----------------------------------//
	  
	  		// If this is a new section...
	  		if (!$section_id) {
	  			$doquery = db_query("INSERT INTO sections (id,
												  created_on)
										 VALUES ('$new_section_id',
												 now())")
										  or die(mysql_error()."Couldn't insert data.");
		
				// clean up
				ImageDestroy($src_img);
				ImageDestroy($dst_img);
				
				if ($doquery == 1) {
					return $new_section_id;
				}
			} else {
				$update_new_image = db_query("update sections set created_on=now()
														  where id=$section_id")
														 or die (mysql_error());
				return $new_section_id;
			}
			

		}
}

function get_new_section_id() {
 // get new section id
			  $section_id_query = db_query("update sections_seq set id=LAST_INSERT_ID(id+1)")
					  or die (mysql_error());
			
			  $new_section_id_query = db_query("select LAST_INSERT_ID() from sections_seq")
					  or die (mysql_error());
			
			  if ($new_section_id_array = db_fetch_array($new_section_id_query)) {
				// set $new_section_id variable to the most recent id
				$new_section_id = $new_section_id_array[0];
			  }
	return $new_section_id;
}


function add_blank_section($section_id = "") {
	global $_SERVER['DOCUMENT_ROOT'];

	if (!$section_id) {
			// set $new_section_id variable to the most recent id
			$new_section_id = get_new_section_id();
		} else {
			$new_section_id = $section_id;
		}
	
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/section_temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "section_".$new_section_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (!copy($tempfile, $newfile)) 
				{
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Uploading File.";
					exit();
				}
				
	// save thumb as a file
	$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/section_temp.jpg";
	$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
	$final_filename = "section_".$new_section_id."_thumb.jpg";
	$newfile = $uploaddir . "/" . $final_filename;
	if (!copy($tempfile, $newfile)) 
		{
			// if an error occurs the file could not
			// be written, read or possibly does not exist
			print "Error Uploading File.";
			exit();
		}
		
	if (!$section_id) {
	$doquery = db_query("INSERT INTO sections (id, created_on)
									 VALUES ('$new_section_id', now())")
									  or die(mysql_error()."Couldn't insert data.");
	
	}
	return $new_section_id;
}

function section_edit($id, $name, $description, $link, $director_id, $director, $director_phone, $director_email, $parent, $category) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}

		$birthday = date('Y-m-d',strtotime($birthday));
	
		
       // If valid, update user information according to user_id.
       $sql = "update sections set name='$name',
	   							  description='$description',
	   				 			  link='$link',
								  director_id='$director_id',
								  director='$director',
							      director_phone='$director_phone',
							      director_email='$director_email',
								  parent='$parent',
							      category='$category',
							      created_on=now()
                            where id=$id";
       $result = db_query($sql) or die ("section modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function section_delete($id) {	
	global $cur_module;
    // Check and see if the section exists.
    if ($id != "") {
       $result = db_query("select id
                             from sections
                            where id=$id")
                           or die("section check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete section from table.
       $sql = "DELETE FROM sections
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("section delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}


// --------------------------------------------------------------------------------//
// Recursion Functions															   //
// --------------------------------------------------------------------------------//


function insert_listChildren($parent) {
	list_sect_children($parent[parent_id], $parent[depth], $parent[owner]); 
}




// list_children
// parent_id: lists all children for this sect id.
// link: link to the database connection
// depth: integer used for spacing, to give a visual of how deep a sect is.
function list_sect_children($parent, $depth, $owner) {
         global $orphan_db_files, $section_filter, $expand, $smarty;
		 
		 $this_sect = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }

         $sect_query = "select id
                             from  sections 
                            where  parent = '$this_sect' and
                                   deleted_p = 0 and
                                   id <> 0 
                          order by ordervar, name desc";


          $children_results = db_query($sect_query)
                or die(mysql_error());
          while(list($id) = mysql_fetch_array($children_results)) {
			
			if (csv_list_sect_children($id)) {
					if ($expand[$id] == 0) {
						$expand_fill = "[<a href=$PHP_SELF?id=$id&e=1>+</a>]";
					} else {
						$expand_fill = "[<a href=$PHP_SELF?id=$id&e=0>-</a>]";
					}
				} else {
					$expand_fill = "";
				}
					
					$smarty->assign('expand_fill', $expand_fill);
				
			if ($depth > 0) {
				echo "<tr>
					  <td width=5%>&nbsp;</td>
					  <td>";
			}
					  
			echo "<table width=100% border=0 cellspacing=0 cellpadding=0>
        <tr>
          <td colspan=2>";
		  
          $sect_info = sql_query("select * from  sections where id = $id and deleted_p = 0 and id <> 0 order by ordervar, name desc");
		  $smarty->assign('sections', $sect_info);				  
		  $smarty->display('./table.tpl.html');
			
		echo "</td>
        </tr>";
		 
			 if ($expand[$id] == 1) {
				 $depth = $depth + 1;
				 list_sect_children($id, $depth, $owner);
				 $depth = $depth - 1;
			 }
			 
			 echo "</table>";
			 

          }
}

function insert_avail_parent_sections($vars) {
	return available_parent_sections($vars[id], $vars[s_id]);
}


function available_parent_sections($sect_id, $curr_parent) {
	print "<select name=parent>\n";
	  // set default value to curr_parent or root(0)...
	  if($curr_parent != 0) {
			$find_current_query = db_query("select id,
													  name
												 from sections
												where id = $curr_parent and
													  id <> $sect_id 									  
											 order by name") or die("find current: ".mysql_error());
		
			 if(list($id, $name) = db_fetch_array($find_current_query)) {
			   print "\t<option value=\"$id\">$name</option>\n
					  \t<option value=\"0\">None</option>\n";
			 }
	  }
	  else {
		print "\t<option value=0>None</option>\n";
	  }
	  
	  $notavail = csv_list_sect_children($sect_id);
	  $notavail = $notavail." $sect_id"; 
	  list_sect_children_dropdown(0, 0, 0, $notavail);
	  echo "</select>";
}

function csv_list_sect_children($sect_id) {

  $get_the_kids_query = db_query("select id as child, name
                                       from sections
                                      where parent = $sect_id
									    and id <> 0 
                                   order by name")
       or die("CSV Error:".mysql_error());
  while(list($child, $filename, $title) = db_fetch_array($get_the_kids_query)) {
     $csv_list .= "$child, ";
     $csv_list .= csv_list_sect_children($child);
  }
  return $csv_list;
}

function list_sect_children_dropdown($parent, $depth, $addedurl="", $notavail="") {
        
		 $this_sect = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }
		
		if ($notavail) {
			$child_filter = "and id not in ($notavail)";
		}
		$sect_query = "select name,
		 						   id
                             from  sections 
                            where  parent = '$this_sect' and
                                   deleted_p = 0 and
                                   id <> 0 
								   $child_filter
                          order by name";
		//echo "<p>".$sect_query;
          $children_results = db_query($sect_query)
                or die(mysql_error());
          while(list($name, $id) = mysql_fetch_array($children_results)) {
			  	$name_len = strlen($name);
				if ($name_len > 25) {
					$name_loc = strpos($name, " ", 25);
					if ($name_loc) $name = substr($name,0,$name_loc)."...";
				}
		  
			 print "<option value=$id>$spacer$name</option>";

             $depth = $depth + 1;
             list_sect_children_dropdown($id, $depth, $addedurl, $notavail);
             $depth = $depth - 1;
          }
}

function section_name($sect_id, $justname = "") {
	
	if ($justname == 1) {
		$findsect_array = db_query("select name as sect_name from sections where id=$sect_id limit 1") or die(mysql_error());
		list($sect_name) = db_fetch_array($findsect_array);
		$html = $sect_name;
	} else {
		$tree = sect_parent_tree($sect_id);
		$gens = count($tree);
		
		for ($i = $gens; $i >0; $i--) {
			$cur_sect = array_pop($tree);
			$html = "$html$spacer$cur_sect<br>";
			$spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
		}
	}
	return $html;
}

function sect_parent_tree ($sect_id) {
	$tree = array();
	while ($sect_id != 0) {
		$findparent_array = db_query("select name as sect_name, parent as parent_id from sections where id=$sect_id limit 1") or die(mysql_error());
		list($sect_name, $parent_id) = db_fetch_array($findparent_array);
		array_push($tree, $sect_name);
		$sect_id = $parent_id;
	}
	return $tree;
}

function insert_section_name($id) {
	return section_name($id[id]);
}

?>