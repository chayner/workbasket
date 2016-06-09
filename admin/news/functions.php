<? // News Module

function news_add($title, $date, $body, $url, $image_id, $caption, $category, $owner, $author) {
	global $cur_module;
    //Confirm that all required variables are present
    if (!$date) {
        return "You must enter information in date.";
    }

	$datestring = strtotime($date);
	$newdate = date('Y-m-d',$datestring);

	if ($url && strpos($url,"http") === false) {
		$url = "http://".$url;
	}
	$sql = "INSERT INTO news (title,
                                  date,
                                  body,
								  url,
								  image_id,
								  caption,
								  category,
								  owner,
								  created_on,
								  created_by)
                          VALUES ('$title',
                                  '$newdate',
                                  '$body',
								  '$url',
								  '$image_id', 
								  '$caption', 
								  '$category',
								  '$owner',
								  now(),
								  '$author')";
    $result = db_query($sql) or die ("News Item add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function news_edit($id, $title, $date, $body, $url, $image_id, $caption, $category, $owner, $author) {
 	global $cur_module;
   // Check to make sure all variables have been passed.
    if ($id) {
       // If valid, update user information according to user_id.
		$newdate = strtotime($date);
		$newdate = date('Y-m-d',$newdate);

		if ($url && strpos($url,"http") === false) {
			$url = "http://".$url;
		}

		  $sql = "update news set title='$title',
                               body='$body',
							   url='$url',
							   image_id='$image_id',
							   caption='$caption',
                               date='$newdate',
							   category='$category',
							   owner='$owner',
							   created_on=now(),
							   created_by='$author'
                         where id=$id";
       $result = db_query($sql) or die ("News modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function news_delete($id) {
 	global $cur_module;
   // Check and see if the news item exists.
    if ($id != "") {
       $result = db_query("select id
                             from news
                            where id=$id")
                           or die("news check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete news item from table.
       $sql = "DELETE FROM news
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("news delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}

?>