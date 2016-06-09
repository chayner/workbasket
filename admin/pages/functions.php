<?php

function page_add($filename, $title, $description, $body, $parent, $display_p, $owner, $id="") {
	global $cur_mod;
	
	if ($filename && $title) {
       function check_page($filename, $parent, $owner) {	
		   $result = db_query("select title
								 from pages where filename='$filename' and parent='$parent' and owner='$owner'")
							   or die("page check error: ". mysql_error());
		   if (db_numrows($result) > 0) {
			   list($title) = mysql_fetch_array($result);
			   return $title;
		   } 
	   }
	   $page_found = check_page($filename, $parent, $owner);
	   if (!$page_found) {

		  $order_check = sql_query("select ordervar from pages where parent='$parent' and owner='$owner' order by ordervar desc limit 1");
		  $ordervar = $order_check[0]['ordervar'] + 1;

		   // If not, add page into table.
		  $sql = "INSERT INTO pages (id,
		  							 filename, 
		  							 title, 
									 description, 
									 body,
									 parent, 
									 display_p,
									 ordervar,
									 owner)
							 VALUES ('$id',
							 		 '$filename',
									 '$title',
									 '$description',
									 '$body',
									 '$parent',
									 '$display_p',
									 '$ordervar',
									 '$owner')";
		  $result = db_query($sql) or die ("page add error: ". mysql_error());
		  
		  
			if ($result == 1) {
				$result = $cur_mod['item']." succesfully added.";
			}
		  return $result;
		 } else {
		 	$feedback = "Page already exists with title \"$page_found\".  Please edit that page instead.";
		 	return urlencode($feedback);
		}
    } else {
       return "You must enter a page name when adding a page.";
    }
}

function page_import($id, $filename, $title, $description, $body, $parent, $display_p, $owner) {
	global $cur_mod;
	
	if ($filename && $title) {
       function check_page($filename, $parent, $owner) {	
		   $result = db_query("select title
								 from pages where filename='$filename' and parent='$parent' and owner='$owner'")
							   or die("page check error: ". mysql_error());
		   if (db_numrows($result) > 0) {
			   list($title) = mysql_fetch_array($result);
			   return $title;
		   } 
	   }
	   $page_found = check_page($filename, $parent, $owner);
	   if (!$page_found) {

		  $order_check = sql_query("select ordervar from pages where parent='$parent' and owner='$owner' order by ordervar desc limit 1");
		  $ordervar = $order_check[0]['ordervar'] + 1;

		   // If not, add page into table.
		  $sql = "INSERT INTO pages (id,
		  							 filename, 
		  							 title, 
									 description, 
									 body,
									 parent, 
									 display_p,
									 ordervar,
									 owner)
							 VALUES ('$id',
							 		 '$filename',
									 '$title',
									 '$description',
									 '$body',
									 '$parent',
									 '$display_p',
									 '$ordervar',
									 '$owner')";
		  $result = db_query($sql) or die ("page add error: ". mysql_error());
		  
		  
			if ($result == 1) {
				$result = $cur_mod['item']." succesfully added.";
			}
		  return $result;
		 } else {
		 	$feedback = "Page already exists with title \"$page_found\".  Please edit that page instead.";
		 	return urlencode($feedback);
		}
    } else {
       return "You must enter a page name when adding a page.";
    }
}
               
function page_edit($id,$filename,$title,$description,$body,$parent,$display_p,$owner) {
	global $cur_mod;
    // Check to make sure all variables have been passed.
    if ($filename && $title) {
       
	   $parent_change = sql_query("select parent, ordervar from pages where id=$id");
	   if ($parent_change[0]['parent'] != $parent) {
		   $order_check = sql_query("select ordervar from pages where parent='$parent' and owner='$owner' order by ordervar desc limit 1");
		   $ordervar = $order_check[0]['ordervar'] + 1;
		} else {
			$ordervar = $parent_change[0]['ordervar'];
		}
	   // If valid, update user information according to user_id.
       $sql = "update pages set filename='$filename',
	   							title='$title',
								description='$description',
								body='$body',
								parent='$parent',
								display_p='$display_p',
								ordervar = '$ordervar',
								owner='$owner'
                            where id=$id";
       $result = db_query($sql) or die ("page modify error: ". mysql_error());
       
	   /* Change the title in the  */
	   $create_page = page_create($id);
	   
	   if ($result == 1) {
           $result = $cur_mod['item']." successfully modified.";
       }
       return $result;

    } else {
       return "ERROR - Must Fill In Name.";
    }
}
			                 
function page_delete($id, $delete_file) {
	global $_SERVER['DOCUMENT_ROOT'], $cur_mod;
	// Check and see if the page exists.
    if ($id) {
       $result = db_query("select parent, filename
                             from pages
                            where id=$id")
                           or die("page check error: ". mysql_error());
       
	   if (db_numrows($result) == 0) {
           return $cur_mod['item']." does not exists.";
       }

		list($parent, $filename) = db_fetch_array($result);
		
				if ($delete_file) {
			
			$filepath = $_SERVER['DOCUMENT_ROOT']."/pages/".$filename;
			
			if (file_exists($filepath)) {
				unlink($filepath);
			}
						
		}
		
		// find if the page has any children
		$children_query = db_query("select id from pages where parent=$id") or die("children error: ".mysql_error());
		$num_children = db_numrows($children_query);
		if ($num_children > 0) {
			$move_children = db_query("update pages set parent='$parent' where parent=$id") or die("Children Move error:  ".mysql_error());;
		}
		
       // If so, delete page from table.
       $sql = "DELETE FROM pages
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("page delete error: ". mysql_error());



	   if ($result == 1) {
	   		$feedback = $cur_mod['item']." succesfully deleted.";
       }
   
	  
	   return $feedback;
    } else {
       return "You must select a valid ".$cur_mod['item']." to delete.";
    }
}


function page_create($id, $title="", $body="") {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$fileinfo = sql_query("select * from pages where id=$id limit 1");
	
	$page_content = "<title>".$fileinfo[0]['title']."</title>\n\n";
	
	if ($fileinfo[0]['body']) {
		$page_content .= "<body>\n\n".$fileinfo[0]['body']."\n\n</body>";
	} else {
		$page_content .= "<body>\n\n".$fileinfo[0]['description']."\n\n</body>";
	}
	
	
	$temppath = $_SERVER['DOCUMENT_ROOT']."/pages/temp.html";
	$filepath = $_SERVER['DOCUMENT_ROOT']."/pages/".$fileinfo[0]['filename'];
	
	if (file_exists($filepath)) {
		unlink($filepath);
	}
				
	
	//file_write($filepath, $page_content);
	
	if (!$handle = fopen($filepath, 'a')) {
			 echo "Cannot open file ($filepath)"; // or handle your error
			 exit; 
	}
	// now write content to our opened file.
	if (fwrite($handle,$page_content) === FALSE) {
		   echo "Cannot write to file ($filename)";// or handle your error
		   exit;
	} 
	//echo "Success, wrote ($textline) to file ($filename)";
	fclose($handle); 
	
	return "File successfully created.";


}


function page_file_edit($id, $title="", $body="") {
	global $_SERVER['DOCUMENT_ROOT'];
	
	$fileinfo = sql_query("select * from pages where id=$id limit 1");
	
	$page_content = "<title>".$fileinfo[0]['title']."</title>\n\n";
	
	if ($fileinfo[0]['body']) {
		$page_content .= "<body>\n\n".$fileinfo[0]['body']."\n\n</body>";
	} else {
		$page_content .= "<body>\n\n".$fileinfo[0]['description']."\n\n</body>";
	}
	
	$temppath = $_SERVER['DOCUMENT_ROOT']."/pages/temp.html";
	$filepath = $_SERVER['DOCUMENT_ROOT']."/pages/".$fileinfo[0]['filename'];
				
	
	//file_write($filepath, $page_content);
	
	if (!$handle = fopen($filepath, 'a')) {
			 echo "Cannot open file ($filepath)"; // or handle your error
			 exit; 
	}
	// now write content to our opened file.
	if (fwrite($handle,$page_content) === FALSE) {
		   echo "Cannot write to file ($filename)";// or handle your error
		   exit;
	} 
	//echo "Success, wrote ($textline) to file ($filename)";
	fclose($handle); 
	
	return "File successfully created.";


}

// --------------------------------------------------------------------------------//
// Recursion Functions															   //
// --------------------------------------------------------------------------------//


function insert_listChildren($parent) {
	list_page_children($parent[parent_id], $parent[depth], $parent[owner]); 
}




// list_children
// parent_id: lists all children for this page id.
// link: link to the database connection
// depth: integer used for spacing, to give a visual of how deep a page is.
function list_page_children($parent, $depth, $owner) {
         global $orphan_db_files, $section_filter, $expand;
		 
		 $this_page = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }

         $page_query = "select title,
		 					   filename,
		 						   ordervar,
		 						   id,
								   display_p
                             from  pages 
                            where  parent = '$this_page' and
                                   deleted_p = 0 and
                                   id <> 0 
								   $section_filter
                          order by display_p desc, ordervar asc, title desc";


          $children_results = db_query($page_query)
                or die(mysql_error());
          while(list($title, $filename, $ordervar, $id, $display_p) = mysql_fetch_array($children_results)) {
			if ($display_p) {
				$show_fill = "style=\"font-weight:bold\"";
			} else {
				$show_fill = "style=\"background-color:#333333\"";
			}
			
			 print "<tr>
			 			<td width=25 $show_fill><font size=1><a href=\"edit.php?id=$id\">edit</a></font></td>
						<td width=30  $show_fill><font size=1><a href=\"delete.php?id=$id\">delete</a></font></td>
						<td $show_fill align=center><font size=1><a href=\"$PHP_SELF?id=$id&p=up\">U</a></font></td>
 						<td $show_fill align=center><font size=1><a href=\"$PHP_SELF?id=$id&p=down\">D</a></font></td>";
						
				if (csv_list_page_children($id)) {
					if ($expand[$id] == 0) {
						$expand_fill = "[<a href=$PHP_SELF?id=$id&e=1>+</a>]";
					} else {
						$expand_fill = "[<a href=$PHP_SELF?id=$id&e=0>-</a>]";
					}
				} else {
					$expand_fill = "";
				}
				
			echo 	"	<td  $show_fill>$spacer<font size=1><a href=\"edit.php?id=$id\">$title</a> $expand_fill</font></td>";
						
             if (in_array($filename, $orphan_db_files)) {
				echo   "<td  $show_fill><font size=1><font color=\"#FFCC00\"><strong>$filename *</strong></font> (<a href=\"create.php?id=$id\">create file</a>)</font></td>";			 	
			 } else {
				echo   "<td $show_fill><font size=1><a href=\"/pages/$filename\" target=\"_blank\">$filename</a></font></td>";
			 }
			 
			 if ($display_p) {
			 	echo "<td align=center $show_fill><font size=1><a href=\"{$PHP_SELF}?id=$id&show=0\">shown</a></font></td></tr>";
			 } else {
				 echo "<td align=center $show_fill><font size=1><a href=\"{$PHP_SELF}?id=$id&show=1\">hidden</a></font></td></tr>";
			 }
			 
			 if ($expand[$id] == 1) {
				 $depth = $depth + 1;
				 list_page_children($id, $depth, $owner);
				 $depth = $depth - 1;
			 }
          }
}

function insert_avail_parent_pages($vars) {
	return available_parent_pages($vars[id], $vars[p_id], $vars[owner]);
}


function available_parent_pages($page_id, $curr_parent, $owner) {
	print "<select name=parent>\n";
	  // set default value to curr_parent or root(0)...
	  if($curr_parent != 0) {
			$find_current_query = db_query("select id,
													  title
												 from pages
												where id = $curr_parent and
													  id <> $page_id 
													  $section_filter													  
											 order by title") or die("find current: ".mysql_error());
		
			 if(list($id, $name) = db_fetch_array($find_current_query)) {
			   print "\t<option value=\"$id\">$name</option>\n
					  \t<option value=\"0\">None</option>\n";
			 }
	  }
	  else {
		print "\t<option value=0>None</option>\n";
	  }
	  
	  $notavail = csv_list_page_children($page_id);
	  $notavail = $notavail." $page_id"; 
	  list_page_children_dropdown(0, 0, $owner, 0, $notavail);
	  echo "</select>";
}

function csv_list_page_children($page_id) {

  $get_the_kids_query = db_query("select id as child,
                                            filename, title
                                       from pages
                                      where parent = $page_id and
                                            id <> 0 
                                   order by title")
       or die(mysql_error());
  while(list($child, $filename, $title) = db_fetch_array($get_the_kids_query)) {
     $csv_list .= "$child, ";
     $csv_list .= csv_list_page_children($child);
  }
  return $csv_list;
}

function list_page_children_dropdown($parent, $depth, $owner, $addedurl="", $notavail="") {
        
		 $this_page = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }
		
		if ($notavail) {
			$child_filter = "and id not in ($notavail)";
		}
		$page_query = "select filename, title,
		 						   id
                             from  pages 
                            where  parent = '$this_page' and
                                   deleted_p = 0 and
                                   id <> 0 
								   $section_filter
								   $child_filter
                          order by title";
		//echo "<p>".$page_query;
          $children_results = db_query($page_query)
                or die(mysql_error());
          while(list($filename, $title, $id) = mysql_fetch_array($children_results)) {
			  	$name_len = strlen($name);
				if ($name_len > 25) {
					$name_loc = strpos($name, " ", 25);
					if ($name_loc) $name = substr($name,0,$name_loc)."...";
				}
		  
			 print "<option value=$id>$spacer$title</option>";

             $depth = $depth + 1;
             list_page_children_dropdown($id, $depth, $owner, $addedurl, $notavail);
             $depth = $depth - 1;
          }
}


?>
