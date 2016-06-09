<?php

function category_add($cat_name,$cat_desc,$module, $owner) {
	global $cur_module,$userid_c;
    // Check and see if the permission already exists.
    if ($cat_name != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

	   function check_category($cat_name, $module, $owner) {	
		   $result = db_query("select name
								 from categories where module='$module' and owner='$owner'")
							   or die("category check error: ". mysql_error());
		   if (db_numrows($result) > 0) {
			   return true;
		   } 
	   }
	   check_category($cat_name, $module, $owner);

       // If not, add category into table.
	  $sql = "INSERT INTO categories (name, description, module, owner, created_by) VALUES ('$cat_name','$cat_desc', '$module','$owner','$userid_c')";
   	  $result = db_query($sql) or die ("category add error: ". mysql_error());
	  	if ($result == 1) {
		   	$result = $cur_module[0][item]." succesfully added.";
		}
      return $result;
    } else {
       return "You must enter a Category Name when adding a category.";
    }
}
               
function category_edit($cat_id,$cat_name,$cat_desc,$cat_order,$parent,$module,$owner) {
	global $cur_module,$userid_c;
    // Check to make sure all variables have been passed.
    if ($cat_id && $cat_name) {
      
	   // If valid, update user information according to user_id.
       $sql = "update categories set name='$cat_name', description='$cat_desc',ordervar='$cat_order', parent='$parent', module='$module', owner='$owner', created_by='$userid_c'
                            where id=$cat_id";
       $result = db_query($sql) or die ("Category modify error: ". mysql_error());
       
	   $lineage = get_lineage($cat_id);
	  
	   $lineage = addslashes($lineage);
	   $sql = "update categories set lineage='$lineage' where id=$cat_id";
       $result = db_query($sql) or die ("Category modify error: ". mysql_error());
       
	   if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
       return "ERROR - Must Fill In Name.";
    }
}
			                 
function category_delete($cat_id, $module) {
	global $cur_module;
    // Check and see if the category already exists.
    if ($cat_id != "") {
       $result = db_query("select parent
                             from categories
                            where id=$cat_id")
                           or die("Category check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

		// find if the category has any children
		$children_query = db_query("select id from categories where parent=$cat_id") or die("children error: ".mysql_error());
		$num_children = db_numrows($children_query);
		if ($num_children > 0) {
			list($parent) = db_fetch_array($result);
			$move_children = db_query("update categories set parent='$parent' where parent=$cat_id") or die("Children Move error:  ".mysql_error());;
		}
		
       // If so, delete category from table.
       $sql = "DELETE FROM categories
                     WHERE id=$cat_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Category delete error: ". mysql_error());


	   // Find what module has that category
	   $mod_dbtable = sql_query("select dbtable from modules where id=$module");
	   if ($mod_dbtable[0][dbtable]) {
		   $sql = "update ".$mod_dbtable[0][dbtable]." set category = 0 where category = $cat_id";
		   $result2 = db_query($sql) or die ("Category delete error: ". mysql_error());
       }

	   if ($result == 1 && $result2 == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
   
	  
	   return $result;
    } else {
       return "You must select a valid ".$cur_module[0][item]." to delete.";
    }
}

function insert_avail_parent_cats($cat_id) {
	return available_parent_categories($cat_id[module], $cat_id[id], $cat_id[p_id], $cat_id[owner]);
}

function available_parent_categories($cur_cat_mod, $category_id, $curr_parent, $owner) {
	print "<select name=parent>\n";
	  // set default value to curr_parent or root(0)...
	  if($curr_parent != 0) {
			$find_current_query = db_query("select id,
													  name
												 from categories
												where id = $curr_parent and
													  module = '$cur_cat_mod' and
													  id <> $category_id 
													  $section_filter													  
											 order by name") or die("find current: ".mysql_error());
		
			 if(list($id, $name) = db_fetch_array($find_current_query)) {
			   print "\t<option value=\"$id\">$name</option>\n
					  \t<option value=\"0\">None</option>\n";
			 }
	  }
	  else {
		print "\t<option value=0>None</option>\n";
	  }
	  
	  $notavail = csv_list_children($category_id, $cur_cat_mod);
	  $notavail = $notavail." $category_id"; 
	  list_children_dropdown(0, $cur_cat_mod, 0, $owner, 0, $notavail);
	  echo "</select>";
}


function csv_list_children($category_id, $cur_cat_mod) {
  $get_the_kids_query = db_query("select id as child,
                                            name
                                       from categories
                                      where module = '$cur_cat_mod' and
                                            parent = $category_id and
                                            id <> 0 
                                   order by name")
       or die(mysql_error());
  while(list($child, $name) = db_fetch_array($get_the_kids_query)) {
     $csv_list .= "$child, ";
     $csv_list .= csv_list_children($child, $cur_cat_mod);
  }
  return $csv_list;
}


// list_children
// parent_id: lists all children for this category id.
// link: link to the database connection
// depth: integer used for spacing, to give a visual of how deep a category is.
function list_children($parent, $cur_cat_mod, $depth, $owner) {
         global $section_filter;
		 $this_category = $parent;
         $spacer = "";
         for($i = 1; $i <= $depth; $i++) {
           $spacer = $spacer."&nbsp;&nbsp;&nbsp;|--&nbsp;&nbsp;";
         }

         $category_query = "select name,
		 						   ordervar,
		 						   id
                             from  categories 
                            where  module = '$cur_cat_mod' and
                                   parent = '$this_category' and
                                   deleted_p = 0 and
                                   id <> 0 
								   $section_filter
                          order by ordervar";


          $children_results = db_query($category_query)
                or die(mysql_error());
          while(list($name, $ordervar, $id, $description) = mysql_fetch_array($children_results)) {
             print "<tr>
			 			<td width=25><font size=1><a href=\"edit.php?id=$id&cur_cat_mod=$cur_cat_mod\">edit</a></font></td>
						<td width=30><font size=1><a href=submit.php?id=$id&cur_cat_mod=$cur_cat_mod&action=del_cat onClick=\"return confirmSubmit()\">delete</a></font></td>
						<td>$spacer<a href=\"edit.php?id=$id&cur_cat_mod=$cur_cat_mod\"><font size=1>$name</font></a></td>
						<td><font size=1>$ordervar&nbsp;</font></td>
					</tr>";


             $depth = $depth + 1;
             list_children($id, $cur_cat_mod, $depth, $owner);
             $depth = $depth - 1;
          }
}

?>
