<? // modules Module

function module_add($name, $description, $item, $path, $dbtable, $global_mod, $add_del, $public, $cat_p, $cat_name) {
    //Confirm that all required variables are present
    if (!$name) {
        return "You must enter in a name.";
    }

	$sql = "INSERT INTO modules (name,
                                  description,
								  item,
								  path, 
								  dbtable,
								  global_mod,
								  add_del,
								  public,
								  cat_p,
								  cat_name,
								  created_on)
                          VALUES ('$name',
                                  '$description',
								  '$item',
                                  '$path',
								  '$dbtable',
								  '$global_mod',
								  '$add_del',
								  '$public',
								  '$cat_p',
								  '$cat_name',
								  now())";
    $result = db_query($sql) or die ("Module add error: ". mysql_error());
    if ($result == 1) {
         $result = "Modules succesfully added.";
    }
    return $result;
}

function module_edit($id, $name, $description, $item, $path, $dbtable, $global_mod, $add_del, $public, $cat_p, $cat_name) {
    // Check to make sure all variables have been passed.
    if ($id) {
      	$sql = "update modules set name='$name',
                               description='$description',
							   item='$item',
							   path='$path',
							   dbtable='$dbtable',
							   global_mod='$global_mod',
							   add_del='$add_del',
							   public='$public',
							   cat_p='$cat_p',
							   cat_name='$cat_name',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("Module modify error: ". mysql_error());
       if ($result == 1) {
           $result = "Module successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function module_delete($id) {
    // Check and see if the modules item exists.
    if ($id != "") {
       $result = db_query("select id
                             from modules
                            where id=$id")
                           or die("Module check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Module does not exists.";
       }

       // If not, delete modules item from table.
       $sql = "DELETE FROM modules
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("Module delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Module succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing Module.";
    }
}

?>