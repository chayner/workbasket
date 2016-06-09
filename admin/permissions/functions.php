<? // permissions permission

function get_user_dropdown() {
    global $userid_c;
	
	if ($userid_c != 1) {
		$admin_filter = "and id != 1";
	}
	echo "<select name=user_id>
          <option value='' selected>users</option>
		  <option value=''>--------------------------</option>";

    $sql="select id,
                 real_name
            from admin_users
           where deleted_p = 0
		   $admin_filter
        order by real_name";
    $result = db_query($sql) or die("User Drop Down Error: ". mysql_error());
    while(list($id, $real_name) = db_fetch_array($result)) {
         echo "<option value=$id>$real_name</option>";
    }
    echo "</select>";
}

function get_section_dropdown() {
	global $section_name, $multisection;
		echo "<select name=section_id>";
	
	if ($multisection) {

		echo "<option value='' selected>$section_name</option>
			  <option value=''>--------------------------</option>";
	} 
		$sql="select id,
					 name
				from sections
			   where deleted_p = 0
			order by name";
		$result = db_query($sql) or die("Section Drop Down Error: ". mysql_error());
		while(list($id, $name) = db_fetch_array($result)) {
			 if (strlen($name) > 25) {
			 	$name = substr($name, 0, 25)."...";
			 }
			 echo "<option value=$id>$name</option>";
		}

		echo "</select>";
}

function get_module_dropdown() {
	global $section_item,$userid_c;
    echo "<select name=module_id>
          <option value='' selected>modules</option>
          <option value=''>--------------------------</option>
		  <option value=0>$section_item norms</option>
		  <option value=''>--------------------------</option>";

    $sql="select id,
                 name
            from modules
           where deleted_p = 0 and id < 50
		   	 and public = 1
        order by name";
    $result = db_query($sql) or die("Module Drop Down Error: ". mysql_error());
    while(list($id, $name) = db_fetch_array($result)) {
         echo "<option value=$id>$name</option>";
    }
    if ($userid_c == "1") {
		echo "<option value=''>--------------------------</option>
			  <option value=100>config norms</option>
			  <option value=''>--------------------------</option>";
	
		$sql="select id,
					 name
				from modules
			   where deleted_p = 0 and id > 49 and id < 100
				 and public = 1
			order by name";
			
		$result = db_query($sql) or die("Module Drop Down Error: ". mysql_error());
		while(list($id, $name) = db_fetch_array($result)) {
			 echo "<option value=$id>$name</option>";
		}
	}
	echo "</select>";
}


function check_permissions($user_id,$section_id,$module_id) {	
   $result = db_query("select user_id
						 from permissions
						where user_id=$user_id
						  and module=$module_id
						  and section=$section_id")
					   or die("permission check error: ". mysql_error());
   if (db_numrows($result) > 0) {
	   return true;
   } 
}
	   
	   
function permission_add($user_id,$section_id,$module_id) {
    // Check and see if the permission already exists.
    if ($user_id != "" && $module_id != "" && $section_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

	   if (check_permissions($user_id,$section_id,$module_id)) {
	   		return "Permissions already exist";
	   }

       // If not, add permission into table.
	   // If module_id = 0 then add all the normal ministry modules (5,7,8,9)
	   if ($module_id == 0) {
	   		$snorm_query = sql_query("select s_norms from config limit 1");
			$snorms = unserialize($snorm_query[0][s_norms]);
			$i = 0;
			while ($i < count($snorms)) { 
				if (!check_permissions($user_id,$section_id,$snorms[$i])) {
				$add_permissions = db_query("INSERT INTO permissions (user_id,module,section) VALUES ($user_id,$snorms[$i],$section_id)");
				}
				$i++;
			}

			if ($i == 20 && $add_permissions == 1) {
			   return "Permissions succesfully added.";
		   	}
	   } elseif ($module_id == 100) {
	   		$i = 50;
			while ($i <= 54) { 
				if (!check_permissions($user_id,$section_id,$i)) {
				$add_permissions = db_query("INSERT INTO permissions (user_id,module,section) VALUES ($user_id,$i,$section_id)");
				}
				$i++;
			}
			
			if ($i == 55 && $add_permissions == 1) {
			   return "Permissions succesfully added.";
		   	}
       } else {		 
		   	$sql = "INSERT INTO permissions (user_id,module,section) VALUES ($user_id,$module_id,$section_id)";
		   	$result = db_query($sql) or die ("Permission add error: ". mysql_error());
		   	if ($result == 1) {
			   	return "Permission succesfully added.";
		   	}
       }
    } else {
       return "You must select a User, Section and Module when adding a permission.";
    }
}
                             
function permission_delete($user_id,$section_id,$module_id) {
    // Check and see if the permission already exists.
    if ($user_id != "" && $module_id != "" && $section_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

       $result = db_query("select user_id
                             from permissions
                            where user_id=$user_id
                              and module=$module_id
                              and section=$section_id")
                           or die("permission check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Permission does not exists.";
       }

       // If not, delete permission from table.
       $sql = "DELETE FROM permissions
                     WHERE user_id=$user_id
                       AND module=$module_id
                       AND section=$section_id
                     LIMIT 1";
       $result = db_query($sql) or die ("Permission delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Permission succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a User, Section and Module when deleting a permission.";
    }
}

function sect_permission_delete($user_id,$section_id) {
    // Check and see if the permission already exists.
    if ($user_id != "" && $section_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

       $result = db_query("select user_id
                             from permissions
                            where user_id=$user_id
                              and section=$section_id")
                           or die("permission check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Permission does not exists.";
       }

       // If not, delete permission from table.
       $sql = "DELETE FROM permissions
                     WHERE user_id=$user_id
                       AND section=$section_id";
       $result = db_query($sql) or die ("Permission delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Permission succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a User and Section when deleting a permission.";
    }
}

function user_permission_delete($user_id) {
    // Check and see if the permission already exists.
    if ($user_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

       $result = db_query("select user_id
                             from permissions
                            where user_id=$user_id")
                           or die("permission check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Permission does not exists.";
       }

       // If not, delete permission from table.
       $sql = "DELETE FROM permissions
                     WHERE user_id=$user_id";
       $result = db_query($sql) or die ("Permission delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Permission succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a User when deleting a permission.";
    }
}

function sectmod_permission_delete($user_id,$section_id) {
    // Check and see if the permission already exists.
    if ($user_id != "" && $section_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

       $result = db_query("select user_id
                             from permissions
                            where user_id=$user_id
                              and section=$section_id")
                           or die("permission check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Permission does not exists.";
       }

       // If not, delete permission from table.
       $sql = "DELETE FROM permissions
                     WHERE user_id=$user_id
                       AND section=$section_id
					   AND module < 50";
       $result = db_query($sql) or die ("Permission delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Permission succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a User and Section when deleting a permission.";
    }
}

function configmod_permission_delete($user_id,$section_id) {
    // Check and see if the permission already exists.
    if ($user_id != "" && $section_id != "") {
       //echo "user_id: $user_id<p>ministry_id: $ministry_id<p>module_id: $module_id";

       $result = db_query("select user_id
                             from permissions
                            where user_id=$user_id
                              and section=$section_id")
                           or die("permission check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Permission does not exists.";
       }

       // If not, delete permission from table.
       $sql = "DELETE FROM permissions
                     WHERE user_id=$user_id
                       AND section=$section_id
					   AND module > 49";
       $result = db_query($sql) or die ("Permission delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Permission succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select a User and Section when deleting a permission.";
    }
}
?>