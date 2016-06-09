<? // link Module

function link_add($title, $summary, $url, $image_id, $caption, $category, $owner) {
	global $cur_module;
    //Confirm that all required variables are present
    if (!$title && !$url) {
        return "You must enter information in Title and URL.";
    }

	if ($url && strpos($url,"http") === false) {
		$url = "http://".$url;
	}
		
    $sql = "INSERT INTO links (title,
                                  summary,
                                  url,
								  image_id,
								  caption,
								  category,
								  owner,
								  created_on)
                          VALUES ('$title',
                                  '$summary',
                                  '$url',
								  '$image_id',
								  '$caption',
								  '$category',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("Link Item add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function link_edit($id, $title, $summary, $url, $image_id, $caption, $category, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}
		
       // If valid, update user information according to user_id.
       $sql = "update links set title='$title',
                               summary='$summary',
                               url='$url',
							   image_id='$iamge_id',
							   caption='$caption',
							   owner='$owner',
							   category='$category',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("Link modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function link_delete($id) {	
	global $cur_module;
    // Check and see if the link exists.
    if ($id != "") {
       $result = db_query("select id
                             from links
                            where id=$id")
                           or die("Link check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete link from table.
       $sql = "DELETE FROM links
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("Link delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}
?>