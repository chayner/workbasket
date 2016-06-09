<?
$module=7;
// index.php
include($_SERVER['DOCUMENT_ROOT']."/includes/initiate.php");$maillists_query = sql_query("SELECT  * FROM maillists where deleted_p = 0 and id = $list_id $section_filter;"); 

header("Content-type: text/csv"); 
header("Content-disposition: attachment; filename=".$maillists_query[0][title] ." Mailing List (". date("Y-m-d") . ").txt"); 
header("Pragma: no-cache"); 
header("Expires: 0"); 

if (!$ord) $ord = "email";

$user_query = db_query("select fname, lname, email from maillist_users where maillist_id = $list_id order by $ord"); 
//echo "firstname,lastname,email\n";
while(list($fname, $lname, $email) = db_fetch_array($user_query)) {
	echo "$email,";
}

mysql_close();
?>