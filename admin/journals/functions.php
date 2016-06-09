<? // Journal Module

function journal_add($title, $author, $date, $body, $category, $owner) {
    //Confirm that all required variables are present
    if (!$title && !$date) {
        //return "You must enter information in Title and Date.";
    }
	
	if ($date) {
		$newdate = date('Y-m-d',strtotime($date));
	}
	
	$sql = "INSERT INTO journals (title,
						 		  author,
                                  date,
                                  body,
								  category,
								  owner,
								  created_on)
                          VALUES ('$title',
						  		  '$author',
                                  '$newdate',
                                  '$body',
								  '$category',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("journal Item add error: ". mysql_error());
    if ($result == 1) {
         $result = "Journal entry succesfully added.";
    }
    return $result;
}

function journal_edit($id, $title, $author, $date, $body, $image_id, $caption, $category, $owner) {
    // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
		if ($date) {
			$newdate = date('Y-m-d',strtotime($date));
		} 
		
		$sql = "update journals set title='$title',
								author='$author',
								image_id='$image_id',
								caption='$caption',
                               body='$body',
                               date='$newdate',
							   category='$category',
							   owner='$owner',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("journal modify error: ". mysql_error());
       if ($result == 1) {
           $result = "Journal entry successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function journal_delete($id) {
    // Check and see if the journal exists.
    if ($id != "") {
       $result = db_query("select id
                             from journals
                            where id=$id")
                           or die("journal check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return "Journal entry does not exists.";
       }

       // If not, delete journal from table.
       $sql = "DELETE FROM journals
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("journal delete error: ". mysql_error());
       if ($result == 1) {
           $result = "Journal entry succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing journal.";
    }
}

?>