<? // features Module

function features_add($title, $priority, $body, $image_id, $priority, $caption, $category, $owner, $author) {
	global $cur_module;
    //Confirm that all required variables are present
	
	$sql = "INSERT INTO features (title,
                                  priority,
                                  body,
								  image_id,
								  caption,
								  category,
								  owner,
								  created_on,
								  created_by)
                          VALUES ('$title',
                                  '$priority',
                                  '$body',
								  '$image_id',
								  '$caption',
								  '$category',
								  '$owner',
								  now(),
								  $author)";
    $result = db_query($sql) or die ("features Item add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function features_edit($id, $title, $priority, $body, $image_id, $priority, $caption, $category, $owner, $author) {
 	global $cur_module;
   // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
		
       $sql = "update features set title='$title',
                               body='$body',
							   image_id='$image_id',
							   caption='$caption',
                               priority='$priority',
							   category='$category',
							   owner='$owner',
							   created_on=now(),
							   created_by=$author
                         where id=$id";
       $result = db_query($sql) or die ("features modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function features_delete($id) {
 	global $cur_module;
   // Check and see if the features item exists.
    if ($id != "") {
       $result = db_query("select id
                             from features
                            where id=$id")
                           or die("features check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete features item from table.
       $sql = "DELETE FROM features
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("features delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

?>