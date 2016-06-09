<?php
global $date_array;
$date_array = getdate(mktime(-11));
$smarty->assign('current_date',$date_array);

//include ('mimelist.php');

//--------------------------------------------------------------------------------//
// User Login
//--------------------------------------------------------------------------------//

include($_SERVER['DOCUMENT_ROOT']."$admindir/includes/user.php");
if (user_isloggedin()) {
	$realname = user_getrealname();
	global $userid_c, $section_s;
	$smarty->assign('userid_c', $userid_c);
	$smarty->assign('fullname', $realname);
} else {
	$feedback = "USER IS NOT LOGGED IN";
	header("Location: $siteroot$admindir/login.php?feedback=$feedback");
}	


//--------------------------------------------------------------------------------//
//  Current Module Information
//--------------------------------------------------------------------------------//


$cur_module = sql_query("select * from modules where id = $module");
global $cur_mod;
$cur_mod = $cur_module[0];

$smarty->assign('cur_mod', $cur_mod);

//--------------------------------------------------------------------------------//
//  Define "Section" Variables
//--------------------------------------------------------------------------------//

$section_query = sql_query("select * from modules where id = 52");
global $section_name, $section_item;
$section_name = $section_query[0][name];
$section_item = $section_query[0][item];

$smarty->assign('section_name', $section_name);
$smarty->assign('section_item', $section_item);


//--------------------------------------------------------------------------------//
// Set Session: Section Information
//--------------------------------------------------------------------------------//
		
if (!$HTTP_SESSION_VARS['section_s']) {
	$section_s = '0';
	session_register('section_s');
}

if ($HTTP_GET_VARS['section']) {
	if ($HTTP_SESSION_VARS['section_s'] != $HTTP_GET_VARS['section']) {
		$section_s = $HTTP_GET_VARS['section'];
		if (!$HTTP_SESSION_VARS['section_s']) {
		   session_register('section_s');
		}
	}
}

if ($multisection && $section_s && !$cur_module[0]['global_mod']) {
	$section_filter = "and owner = $section_s";
	$sect_photo_filter = "and p.owner = $section_s";
	$sect_mod_filter = "and p.section = $section_s";
	
	$cur_section_query = sql_query("select name from sections where id=$section_s");
	$cur_section_name = $cur_section_query[0][name];
	$smarty->assign('cur_section_name',$cur_section_name);
	
} elseif ($multisection && !$section_s) {
	
	$section_filter = "";
	$section_s = 0;
	$sect_photo_filter = "";
	$sect_mod_filter = "and p.section = $section_s";
	
} else {

	$section_s = 1;
	$smarty->assign('cur_section_name',$sitename);
	$section_filter = "";
}
		
//--------------------------------------------------------------------------------//
// Checking Permissions...
//--------------------------------------------------------------------------------//
		

if (!user_permissions($HTTP_SESSION_VARS['section_s'],$module)) {
  $feedback = "You are not allowed to use that module.";
  header("Location: $siteroot$admindir/index.php?feedback=$feedback");
} else {
  $section_s = $HTTP_SESSION_VARS['section_s'];
  $smarty->assign('section_s',$section_s);
}
	

//--------------------------------------------------------------------------------//
// Category filters
//--------------------------------------------------------------------------------//
global $cur_cat;

function find_cat_kids($parent, $num_levels=0, $with_parent=0, $cur_level=0, $started=0) {
	global $cur_mod;
	
	if ($with_parent && $cur_level == 0) {
		$child_list = "$parent";
		$started = 1;
	}

	$cur_kids = db_query("select id as child
							from categories
							where parent = $parent");

	if (db_affected_rows($cur_kids)) $cur_level++;
	
	while(list($child) = db_fetch_array($cur_kids)) {
		if ($started == 0) {
			$child_list .= "$child";
			$started = 1;
		} else {
			$child_list .=  ",$child";
		}
		
		if ($num_levels == 0){
			$child_list .= find_cat_kids($child, 0, $with_parent, $cur_level, 1);
		} elseif ($num_levels > $cur_level) {
			$child_list .= find_cat_kids($child, $num_levels, $with_parent, $cur_level, 1);
		}
	}
	return $child_list;
}

function get_cat_info($category) {
	$cat_info = sql_query("select * from categories where id = $category");
	$cur_cat = $cat_info[0];
	$cur_cat_link = "&c=$category";
	$cur_cat['id'] = $category;	
	$cur_cat['kids'] = find_cat_kids($category, 1);
	$cur_cat['allkids'] = find_cat_kids($category);		
	if ($category == -1) {
		$cur_cat['name'] = "Choose a Category"; 
		$cur_cat['filter'] = "";
	} elseif ($category == '0') {
		$cur_cat['name'] = "Uncategorized";
		$cur_cat['filter'] = "and category = $category";
	} else {
		$cur_cat['filter'] = "and category = $category";
	}
	return $cur_cat;
}

if ($c) {
	$cur_cat = get_cat_info($c);
} elseif ($c === '0') {
	$cur_cat = get_cat_info(0);
} else {
	$cur_cat = get_cat_info(-1);
}
$smarty->assign('cur_cat', $cur_cat);


//--------------------------------------------------------------------------------//
// Section & Module Permission List
//--------------------------------------------------------------------------------//

$section_list = sql_query("select distinct s.* from sections as s, permissions as p where p.section = s.id and p.user_id = $userid_c order by s.id");
$smarty->assign('section_list', $section_list);

$config_list = sql_query("select distinct m.* from modules as m, permissions as p where m.deleted_p = 0 and m.public = 1 and p.module = m.id and p.user_id = $userid_c and m.id > 49 order by name"); 
$smarty->assign('config_list', $config_list);

$global_mods = sql_query("select distinct m.* from modules as m, permissions as p where m.deleted_p = 0 and m.public = 1 and p.module = m.id and p.user_id = $userid_c and m.global_mod = 1 and m.id < 50 order by name");
$smarty->assign('global_mods', $global_mods);

$modules = sql_query("select distinct m.* from modules as m, permissions as p where m.deleted_p = 0 and m.public = 1 and p.module = m.id and p.user_id = $userid_c and m.global_mod = 0 $sect_mod_filter and m.id < 50 order by name");
$smarty->assign('modules', $modules);

if (!$module) {
	//echo "No Module Selected.";
	$module = 0;
}
$smarty->assign('module', $module);

//--------------------------------------------------------------------------------//
// Admin Functions
//--------------------------------------------------------------------------------//

function validate_email($address) {
	return (ereg('^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', $address));
}

function category_dropdown($current_category, $module, $owner) {
global $admindir, $PHP_SELF, $cur_cat, $section_filter, $cur_module;
	echo "<select name=category onChange=\"MM_jumpMenu('parent',this,0)\">
					<option value=".$cur_cat['id'].">".$cur_cat['name']."</option>
					<option value=".$PHP_SELF.">-------------------------</option>
					<option value=".$PHP_SELF.">Show All</option>
					<option value=".$PHP_SELF."?c=0>Show Uncategorized</option>
					<option value=".$PHP_SELF.">-------------------------</option>";
			
			list_children_dropdown(0, $module, 0, $owner, "$PHP_SELF?c=");

	echo "	<option value=$PHP_SELF>-------------------------</option>
			  <option value=\"$admindir/categories/index.php?cur_cat_mod=$module\">modify ".$cur_module[0][cat_name]." list</option>
		  </select><br>
			<a href=\"$admindir/categories/index.php?cur_cat_mod=$module\"><font size=1 color=white>modify ".$cur_module[0][cat_name]." list</font></a>";
}

function list_children_dropdown($parent, $cur_cat_mod, $depth, $owner, $addedurl="", $notavail="") {
         if ($cur_cat_mod < 50) { 
		 	global $section_filter;
		 }
		 $this_category = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }
		
		if ($notavail) {
			$child_filter = "and id not in ($notavail)";
		}
		
		$category_query = "select name,
		 						   id
                             from  categories 
                            where  module = '$cur_cat_mod' and
                                   parent = '$this_category' and
                                   deleted_p = 0 and
                                   id <> 0 
								   $section_filter
								   $child_filter
                          order by name";
		//echo "<p>".$category_query;
          $children_results = db_query($category_query)
                or die(mysql_error());
          while(list($name, $id, $description) = mysql_fetch_array($children_results)) {
			  	$name_len = strlen($name);
				if ($name_len > 25) {
					$name_loc = strpos($name, " ", 25);
					if ($name_loc) $name = substr($name,0,$name_loc)."...";
				}
		  
			 print "<option value=$addedurl$id>$spacer$name</option>";

             $depth = $depth + 1;
             list_children_dropdown($id, $cur_cat_mod, $depth, $owner, $addedurl, $notavail);
             $depth = $depth - 1;
          }
}

function category_select($current_category, $module, $owner) {
	global $section_filter, $cur_module;
	
	echo "<font size=1>Select an existing ".$cur_module[0][cat_name].": </font><select name=category>";

	if ($current_category <> 0) {
		$cur_name = category_name($current_category, 1);
		echo "<option value=$current_category>$cur_name</option>";
	} else {
		echo "<option value=0>No ".$cur_module[0][cat_name]." selected</option>";
	}

	echo "<option value=0>---------------</option>
		  <option value=0>None</option>";

	list_children_dropdown(0, $module, 0, $owner);
	echo "</select>";
	
	echo "<hr><font size=1>Or add a new ".$cur_module[0][cat_name].": <input name=new_cat_name type=text>
			<br>As a sub ".$cur_module[0][cat_name]." of </font>";
	
	echo "<select name=new_cat_parent><option value=0>Top Level</option>";
			
		list_children_dropdown(0, $module, 0, $owner);

	echo "</select>";

}			

function add_new_category($name, $parent, $module, $owner) {
		$insert_cat = db_query("INSERT INTO categories (name, module, parent, owner, created_on)
                          VALUES ('$name', '$module', '$parent', '$owner', now())");

		$new_cat_id = db_query("select id as cat_id from categories order by id desc limit 1");
		list($cat_id) = db_fetch_array($new_cat_id); 
	   $lineage = get_lineage($cat_id);
	  
	   //$sql = "update categories set lineage=$lineage where id=$cat_id";
       //$result = db_query($sql) or die ("Category modify error: ". mysql_error());
						  
		if ($insert_cat) {
			$new_id_query = db_query("select id from categories order by id desc limit 1");
			list($id) = db_fetch_array($new_id_query);
			return $id;
		}
}

function category_name($cat_id, $justname = "") {
	
	if ($justname == 1) {
		$findcat_array = db_query("select name as cat_name from categories where id=$cat_id limit 1");
		list($cat_name) = db_fetch_array($findcat_array);
		$html = $cat_name;
	} else {
		$tree = parent_tree($cat_id);
		$gens = count($tree);
		
		for ($i = $gens; $i >0; $i--) {
			$cur_cat = array_pop($tree);
			$html = "$html$spacer$cur_cat<br>";
			$spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
		}
	}
	return $html;
}

function parent_tree ($cat_id) {
	$tree = array();
	while ($cat_id != 0) {
		$findparent_array = db_query("select name as cat_name, parent as parent_id from categories where id=$cat_id limit 1");
		list($cat_name, $parent_id) = db_fetch_array($findparent_array);
		array_push($tree, $cat_name);
		$cat_id = $parent_id;
	}
	return $tree;
}

function top_parent ($cat_id) {
	$tree = parent_tree($cat_id);
	$top_parent = array_pop($tree);
	return $top_parent;
}


function get_lineage($cat_id) {
	$tree = parent_tree($cat_id);
	$cur_cat = array_pop($tree);
	$lineage = $lineage." $cur_cat";
		
	while (count($tree) > 0) {
		$cur_cat = array_pop($tree);
		$lineage = $lineage." - $cur_cat";
	}
	//echo "$lineage";
	return $lineage;
}

function insert_category_name($id) {
	return category_name($id[id]);
}

function insert_category_dropdown($vars) {
	global $section_s;
	return category_dropdown($vars[cur_cat], $vars[module], $section_s);
}

function insert_category_select($vars) {
	global $section_s;
	return category_select($vars[cur_cat], $vars[module], $section_s);
}


function image_select($current_img, $module, $owner) {
	
		global $section_filter, $cur_module;
	

	echo "<font size=1>Select an existing image: </font><select name=image onChange=showimage()>";

	if ($current_img <> 0) {
		echo "<option value={$current_img}>$current_img";
		$cur_image = sql_query("select * from images where id=$current_img");
		$cur_caption = $cur_image[0][caption];
		if ($cur_caption) {
				$cap_len = strlen($cur_caption);
				if ($cap_len > 25) {
					$cap_loc = strpos($cur_caption, " ", 25);
					if ($cap_loc) $cur_caption = substr($cur_caption,0,$cap_loc)."...";
				}
			echo " - $cur_caption";
		}
		echo "</option>";
	} else {
		echo "<option value=0>No image selected</option>";
	}

	echo "<option value=0>---------------</option>
		  <option value=0>None</option>";

		$image_list = db_query("select id, caption from images");
		while(list($id, $caption) = mysql_fetch_array($image_list)) {
			echo "<option value=$id>$id";
			if ($caption) {
				$cap_len = strlen($caption);
				if ($cap_len > 25) {
					$cap_loc = strpos($caption, " ", 25);
					if ($cap_loc) $caption = substr($caption,0,$cap_loc)."...";
				}
				echo " - $caption";
			}
			echo "</option>";
		}
	
	echo "</select>";
	
	echo "<br><font size=1>OR add a new image: <input type=file name=source_file>
		          <INPUT TYPE=hidden name=MAX_FILE_SIZE value=20000000>
				 <hr>Caption: <input type=text name=caption size=40>";

}

function getNewHeight($new_width,$width,$height) {
	return round((($new_width * $height) / $width), 0);
}

function getNewWidth($new_height,$width,$height) {
	return round((($new_height * $width) / $height), 0);
}

function image_upload($source_file, $source_filename, $caption = "", $image_id = "") {
	global $_SERVER['DOCUMENT_ROOT'], $section_s, $img_resize_height, $img_resize_width, $img_thumb_resize_width, $img_thumb_resize_height;
	
	//-----------------------//
	// get image information //
	//-----------------------//
	
	// get width and height
	$size = GetImageSize ("$source_file");
	$width = $size[0];
	$height = $size[1];
	//echo "Width: $width, Height: $height";
	
	// get file type: only gif and jpg allowed.
	if ($size[2] == 1) {
	  $type = "gif";
	  $valid_image = 0;
	} elseif ($size[2] == 2) {
	  $type = "jpg";
	  $valid_image = 1;
	} else {
	  $valid_image = 0;
	}
	
	if ($valid_image == 1) {  // process image if it is a valid graphic file format
	
		if (!$image_id) {
			  // get new image id
			  $image_id_query = db_query("update images_seq set id=LAST_INSERT_ID(id+1)")
					  or die ("Image_seq Query Error: ".mysql_error());
			
			  $new_image_id_query = db_query("select LAST_INSERT_ID() from images_seq")
					  or die ("Image_seq Update Error: ".mysql_error());
			
			  if ($new_image_id_array = db_fetch_array($new_image_id_query)) {
				// set $new_image_id variable to the most recent id
				$new_image_id = $new_image_id_array[0];
			  }
		} else {
			$new_image_id = $image_id;
		}
	
	
		$shrink_width = $img_resize_width;
		$shrink_height = $img_resize_height;
	 
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
	  // Determine the large size of image desired
	
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
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "image_".$new_image_id.".jpg";
			$newfile = $uploaddir . "/" . $final_filename;
			if (file_exists("$newfile")) {
				if (!unlink("$newfile")) {
					// if an error occurs the file could not
					// be written, read or possibly does not exist
					print "Error Deleting File.";
					exit();
				}
			}
			
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
			$src_img = ImageCreateFromJPEG($source_file);
			$dst_img = ImageCreateTrueColor($thumb_width, $thumb_height);
			ImageCopyResampled($dst_img, $src_img, 0, 0, 0, 0, $thumb_width, $thumb_height, $width, $height);
	
			// save it as a file
			$tempfile = $_SERVER['DOCUMENT_ROOT']."/photos/temp.jpg";
			$uploaddir = $_SERVER['DOCUMENT_ROOT']."/photos";
			$final_filename = "image_".$new_image_id."_thumb.jpg";
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
			//      Load image to database       //
			//-----------------------------------//
	  
	  		// If this is a new image...
	  		if (!$image_id) {
	  				
				//$source_image = addslashes(fread(fopen("source.jpg", "r"), filesize("source.jpg")));
				//$thumb_image = addslashes(fread(fopen("thumb.jpg", "r"), filesize("thumb.jpg")));
				$doquery = db_query("INSERT INTO images (id,
												  filename,
												  filesize,
												  filetype,
												  width,
												  height,
												  caption,
												  category,
												  owner,
												  created_on)
										 VALUES ('$new_image_id',
												 '$source_file_name',
												 '$source_file_size',
												 '$source_file_type',
												 '$new_width',
												 '$new_height',
												 '$caption',
												 '$category',
												 $section_s,
												 now())")
										  or die(mysql_error()."Couldn't insert data.");
		
				// clean up
				ImageDestroy($src_img);
				ImageDestroy($dst_img);
				
				if ($doquery == 1) {
					return $new_image_id;
				}
			} else {
				$update_new_image = db_query("update images set filesize='$source_file_size',
																filetype='$source_file_type',
																filename='$source_file_name',
																caption='$caption',
																width='$new_width',
																height='$new_height',
																category='$category',
																owner='$section_s',
																created_on=now()
														  where id=$image_id")
														 or die (mysql_error());
			}
		}
}



function insert_image_select($vars) {
	global $section_s;
	return image_select($vars[cur_img], $vars[module], $section_s);
}

?>