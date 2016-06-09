<? // faq Module

function faq_add($question, $answer, $priority, $category, $owner) {
	global $cur_module;
    //Confirm that all required variables are present
    
    $sql = "INSERT INTO faqs (question,
								  answer,
								  priority,
								  category,
								  owner,
								  created_on)
                          VALUES ('$question',
                                  '$answer',
								  '$priority',
                                  '$category',
								  '$owner',
								  now())";
    $result = db_query($sql) or die ("FAQ add error: ". mysql_error());
    if ($result == 1) {
         $result = $cur_module[0][item]." succesfully added.";
    }
    return $result;
}

function faq_edit($id, $question, $answer, $priority, $category, $owner) {
	global $cur_module;
    // Check to make sure all variables have been passed.
    if ($id) {

	   // If valid, update user information according to user_id.
       $sql = "update faqs set question='$question',
                               answer='$answer',
							   priority='$priority',
                               owner='$owner',
							   category='$category',
							   created_on=now()
                         where id=$id";
       $result = db_query($sql) or die ("FAQ modify error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." successfully modified.";
       }
       return $result;

    } else {
        return "Error with modify.  Please try again.";
    }
}

function faq_delete($id) {	
	global $cur_module;
    // Check and see if the faq exists.
    if ($id != "") {
       $result = db_query("select id
                             from faqs
                            where id=$id")
                           or die("faq check error: ". mysql_error());
       if (db_numrows($result) == 0) {
           return $cur_module[0][item]." does not exists.";
       }

       // If not, delete faq from table.
       $sql = "DELETE FROM faqs
                     WHERE id=$id
                     LIMIT 1";
       $result = db_query($sql) or die ("faq delete error: ". mysql_error());
       if ($result == 1) {
           $result = $cur_module[0][item]." succesfully deleted.";
       }
       return $result;
    } else {
       return "You must select an existing ".$cur_module[0][item].".";
    }
}
?>